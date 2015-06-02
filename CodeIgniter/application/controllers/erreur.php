<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class erreur extends CI_Controller {

    function __construct(){
        parent::__construct();
    }
    
	public function index(){
        
        //On charge le titre dans la liste $data et on appelle les vues qui vont construire notre page de login
        $data['titre'] = "Erreur";
        $this->load->view('header', $data);  
        
        switch ($this->session->flashdata('type_erreur')) {
            case "inactif":
                $this->load->view('erreur_inactif');
                break;
            case "admin":
                $this->load->view('erreur_admin');
                break;
        }
        
        $this->load->view('footer');
        
	}
}