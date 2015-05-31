<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class loginVerification extends CI_Controller {
 
    function __construct(){
        parent::__construct();
        $this->load->model('utilisateur','',TRUE);
    }

    function index(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mdp', 'Password', 'trim|required|xss_clean|callback_verif_bdd');

        if($this->form_validation->run() == FALSE){
            $this->load->view('login_view');
        }
        else{
            redirect('home', 'refresh');
        }
    }
    
    function verif_bdd($mdp){
        $login = $this->input->post('login');
        $res = $this->utilisateur->verif_login_bdd($login, $mdp);

        if($res){
            $liste_resultats = array();
            foreach($res as $r){
                $liste_resultats =  array(
                                    'login' => $r->login,
                                    'nom' => $r->nom,
                                    'prenom' => $r->prenom,
                                    'statut' => $r->statut
                                    );
                $this->session->set_userdata('connecte', $liste_resultats);
            }
            return true;
        }
        else{
            $this->form_validation->set_message('verif_bdd', 'Nom utilisateur ou mot de passe incorrect');
            return false;
        }
    }
}
?>