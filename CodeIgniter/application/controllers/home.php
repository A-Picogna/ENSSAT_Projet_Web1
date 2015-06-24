<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

    /*
    * charge les modeles et interdit l'accès aux non-droits
    */
    function __construct(){
        parent::__construct();
        session_start();
        if(!$this->session->userdata('info_user')){ 
            //If no session, redirect to login page
            redirect('login', 'refresh');                   
        }
        else{
            if (!$this->session->userdata('info_user')['actif']){
                $this->session->set_flashdata('type_erreur', 'inactif');
                redirect('erreur', 'refresh');
            }
        }            
        $this->load->model('utilisateur','',TRUE);
        $this->load->model('fiche_enseignant_model');
    }

    /* 
    * Recupère les données de l'utilisateur en cours et les charges
    * en variable de session
    * Charge les données d'affichage du dashboard et appelle les vues
    * en somme : initalise la page d'accueil
    */
    function index(){ 

        $data['titre'] = "Service de gestion des cours pour les enseignants";            
        $this->load->view('header', $data);

        $session_data = $this->session->userdata('info_user');
        $login = $this->session->userdata('info_user')['login'];
        $data['login'] = $session_data['login'];
        $data['nom'] = $session_data['nom'];
        $data['prenom'] = $session_data['prenom'];
        $data['statut'] = $session_data['statut'];
        $data['administrateur'] = $session_data['administrateur'];
        $data['actif'] = $session_data['actif'];
        $data['info_user'] = $this->utilisateur->get_info_utilisateur($session_data['login']);
        $data['decharge'] = $this->utilisateur->get_decharge($session_data['login']);
        $data['heureslogin'] = $this->utilisateur->getheureslogin($session_data['login']);

        $data['infosEnseignant'] = $this->fiche_enseignant_model->get_enseignant($login);
        $data['coursEnseignant'] = $this->fiche_enseignant_model->get_cours($login);
        $heuresCMEnseignant = $this->fiche_enseignant_model->get_heuresCM($login);
        $heuresTDEnseignant = $this->fiche_enseignant_model->get_heuresTD($login);
        $heuresTPEnseignant = $this->fiche_enseignant_model->get_heuresTP($login);
        $heuresProjetEnseignant = $this->fiche_enseignant_model->get_heuresProjet($login);
        $data['totalHeuresEnseignant'] = $heuresCMEnseignant[0]['sum(hed)'] + $heuresTDEnseignant[0]['sum(hed)'] + $heuresTPEnseignant[0]['sum(hed)'] + $heuresProjetEnseignant[0]['sum(hed)'];

        $this->load->view('fiche_enseignant_view', $data);
        $this->load->view('home_view', $data);
        $this->load->view('footer');
    }

    /*
    * unsset les variables de session
    * détruit la session
    * et racompagne l'utilisateur à la porte
    */
    function logout(){
        $this->session->unset_userdata('info_user');
        session_destroy();
        redirect('login', 'refresh');
    }

    /*
    * recupere la liste des utilisateur et appelle la vue correspondante
    */
    function listeUtilisateurs(){           
        $data['titre'] = "Liste des utilisateurs";
        $data['liste_utilisateurs'] = $this->utilisateur->getServiceUtilisateurs();
        $data['enseignant'] = $this->utilisateur->getheuresEnseignant();

        $this->load->view('header', $data);
        $this->load->view('affiche_liste_utilisateurs', $data);
        $this->load->view('footer');
    }

    /*
    * recupere un login utilisateur et affiche la page de modification
    * de cet utilisateur
    */
    function modifier_utilisateur($login){
        $login = urldecode($login);
        if ($this->session->userdata('info_user')['login']){
            $data['titre'] = "Modifier informations";
            $data['info_user'] = $this->utilisateur->get_info_utilisateur($login);
            $data['decharge'] = $this->utilisateur->get_decharge($login);
        if ($this->session->userdata('info_user')['administrateur']){
            $this->load->view('header_admin', $data);
        }
        else{
            $this->load->view('header', $data);
        }
            $this->load->view('edit_utilisateur', $data);
            $this->load->view('footer');
        }
        else{
            if (!$this->session->userdata('info_user')['actif']){
                $this->session->set_flashdata('type_erreur', 'admin');
                redirect('erreur', 'refresh');
            }
        } 
    }

    /*
    * recupere le choix, et recupere un jeu de données correspondant
    * réencode le resultat pour etre compatible avec un tableur excel
    */
    public function exportCSV($choix){
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->model('csv_export');
        $query = $this->csv_export->get_data($choix);
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        $data = mb_convert_encoding($data, 'UTF-16LE', 'UTF-8');
        force_download('CSV_Report.csv', $data);            
    }
}

?>
