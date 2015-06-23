<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class ajoutUtilisateurVerification extends CI_Controller {
 
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
            else{
                if(!$this->session->userdata('info_user')['administrateur']){
                    $this->session->set_flashdata('type_erreur', 'admin');
                    redirect('erreur', 'refresh');
                }            
            }
        }                        
        $this->load->model('utilisateur'); 
    }

    function index(){
        $this->load->library('form_validation');
        
        //On définie les règles des données du formulaire et on appelle la fonction verif_bdd avec un callback
        $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nom', 'Nom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mdp', 'Mot de passe', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Vmdp', 'Vérification du mot de passe', 'trim|required|xss_clean|callback_verif_bdd');
        
        if($this->form_validation->run() == FALSE){
            $data['titre'] = "Service de gestion des cours pour les enseignants";
            $this->load->view('header', $data);        
            $this->load->view('ajout_utilisateur');           
            $this->load->view('footer');
        }
        else{
            $this->session->set_flashdata('message', 'Création de l\'utilisateur réussie');
            redirect('home/message_confirmation', 'refresh');
        }
    }
    
    function verif_bdd($login){
        $login = $this->input->post('login');
        $mdp = $this->input->post('mdp');
        $Vmdp = $this->input->post('Vmdp');
        $nom = $this->input->post('nom');
        $prenom = $this->input->post('prenom');
        $statut = $this->input->post('statut');
        $admin = $this->input->post('admin');
        
        if ($admin != 1)
            $admin = 0;
        
        if (!empty($prenom) && !empty($nom)){        
            if (strcmp($mdp, $Vmdp)){
                $this->form_validation->set_message('verif_bdd', 'Les mots de passe ne sont pas identiques');
                return false;
            }
            else{
                if (!($this->utilisateur->dejaPris($login))){
                    $res = $this->utilisateur->inserer_utilisateur($login, $mdp, $nom, $prenom, $statut, $admin);
                    if($res){
                        return true;
                    }
                    else{
                        $this->form_validation->set_message('verif_bdd', 'Erreur inconnue');
                        return false;
                    }
                }
                else{
                        $this->form_validation->set_message('verif_bdd', 'Le login choisi est déjà utilisé');
                        return false;
                }
            }
        }
        else{
            return false;
        }
        
        
    }
}
?>
