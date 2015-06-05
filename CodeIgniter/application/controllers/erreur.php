<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class erreur extends CI_Controller {

    function __construct(){
        parent::__construct();
        session_start();
    }
    
	public function index(){
        
        //On charge le titre dans la liste $data et on appelle les vues qui vont construire notre page de login
        $data['titre'] = "Erreur"; 
        
        switch ($this->session->flashdata('type_erreur')) {
            case "inactif":
                $this->load->view('header_login', $data); 
                $this->load->view('erreur_inactif');
                $this->logout();
                break;
            case "admin":
                $this->load->view('header', $data); 
                $this->load->view('erreur_admin');
                break;
        }
        
        $this->load->view('footer');
        
	}
    
    function logout(){
        $this->session->unset_userdata('info_user');
        session_destroy();
    }
}