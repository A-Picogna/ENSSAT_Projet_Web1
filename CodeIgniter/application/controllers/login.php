<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

    function __construct(){
        parent::__construct();
    }
    
	public function index(){
        
        if (!isset($this->session->userdata('info_user')['login'])) {
            //On charge le titre dans la liste $data et on appelle les vues qui vont construire notre page de login
            $data['titre'] = "Connexion au service de gestion des cours";
            $this->load->view('header_login', $data);        
            $this->load->view('login_view');           
            $this->load->view('footer');
        }
        else{
            //On charge le titre dans la liste $data et on appelle les vues qui vont construire notre page de login
            redirect('home', 'refresh');
        }
            
        
	}
}
