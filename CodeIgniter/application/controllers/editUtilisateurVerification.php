<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class editUtilisateurVerification extends CI_Controller {
 
    function __construct(){
        parent::__construct();
        if (isset($this->session->userdata('info_user')['login'])){
            redirect('home', 'refresh');
        }
        else{
            //pré-chargement du modele (sinon ca ne marche pas)
            $this->load->model('utilisateur','',TRUE);
        }
    }

    function index(){
        $this->load->library('form_validation');
        
        //On définie les règles des données du formulaire et on appelle la fonction verif_bdd avec un callback
        $this->form_validation->set_rules('login', 'Login', 'callback_update_bdd');
        $this->form_validation->set_rules('mdp', 'Mot de passe', 'trim|required|xss_clean');
        $this->form_validation->set_rules('Vmdp', 'Verification du mot de passe', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nom', 'Nom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('prenom', 'Prenom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('statutaire', 'Statutaire', 'trim|required|xss_clean');
        
        if($this->form_validation->run() == FALSE){
            $data['titre'] = "Modifier informations";
            $data['info_user'] = $this->utilisateur->get_info_utilisateur($this->input->post('login'));
            $this->load->view('header', $data);        
            $this->load->view('edit_utilisateur');           
            $this->load->view('footer');
        }
        else{
            redirect('home', 'refresh');
        }
    }
    
    function update_bdd(){
        $login = $this->input->post('login');
        $mdp = $this->input->post('mdp');
        $Vmdp = $this->input->post('Vmdp');
        $nom = $this->input->post('nom');
        $prenom = $this->input->post('prenom');
        $statut = $this->input->post('statut');
        $statutaire = $this->input->post('statutaire');
        $admin = $this->input->post('admin');
        
        if ($admin != 1)
            $admin = 0;
        
        if (strcmp($mdp, $Vmdp)){
            $this->form_validation->set_message('update_bdd', 'Les mots de passe ne sont pas identiques');
            return false;
        }
        else{
            if ($this->session->userdata('info_user')['admin'] && !$admin){                
                $this->form_validation->set_message('update_bdd', 'Vous ne pouvez pas vous revoquer vos propres droits administrateur');
                return false;
            }
            else{
                $this->utilisateur->update_utilisateur($login, $mdp, $nom, $prenom, $statut, $statutaire, $admin);
            }
        }       
    }
}
?>