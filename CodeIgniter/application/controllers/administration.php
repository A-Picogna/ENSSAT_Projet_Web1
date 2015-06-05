<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class erreur extends CI_Controller {

    function __construct(){
        parent::__construct();
        session_start();
    }
    
	public function index(){
        
        $data['titre'] = "Administration du service de gestion des cours pour les enseignants";
        $this->load->view('header', $data);
        // METTRE DES TRUC ICI HEIN !
        $this->load->view('footer');
        
	}
}