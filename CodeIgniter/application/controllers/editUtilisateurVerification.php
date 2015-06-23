<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class editUtilisateurVerification extends CI_Controller {
 
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
    }

    function index(){
        $this->load->library('form_validation');
        
        //On définie les règles des données du formulaire et on appelle la fonction verif_bdd avec un callback
        $this->form_validation->set_rules('login', 'Login', 'trim');
        $this->form_validation->set_rules('decharge', 'Volume horaire', 'trim|xss_clean');
        $this->form_validation->set_rules('nom', 'Nom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('prenom', 'Prénom', 'trim|required|xss_clean');
        $this->form_validation->set_rules('statutaire', 'Statutaire', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mdp', 'Mot de passe', 'trim|xss_clean');
        $this->form_validation->set_rules('Vmdp', 'Vérification du mot de passe', 'trim|xss_clean|callback_update_bdd');
        
        if($this->form_validation->run() == FALSE){
            $data['titre'] = "Modifier informations";
            $data['info_user'] = $this->utilisateur->get_info_utilisateur($this->input->post('login'));
            $data['decharge'] = $this->utilisateur->get_decharge($this->input->post('login'));
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
        $decharge = $this->input->post('decharge');
        
        $this->utilisateur->set_decharge($login, $decharge);
        
        if (strcmp($mdp, $Vmdp)){
            $this->form_validation->set_message('update_bdd', 'Les mots de passe ne sont pas identiques');
            return false;
        }
        else{
            if ($this->session->userdata('info_user')['administrateur'] && !$admin && strcmp($login, $this->session->userdata('info_user')['login']) == 0){                
                $this->form_validation->set_message('update_bdd', 'Vous ne pouvez pas révoquer vos propres droits administrateur');
                return false;
            }
            else{
                $this->utilisateur->update_utilisateur($login, $mdp, $nom, $prenom, $statut, $statutaire, $admin);
            }
        }       
    }
}
?>
