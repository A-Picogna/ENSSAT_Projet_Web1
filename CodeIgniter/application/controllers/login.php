<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

    function __construct(){
        parent::__construct();
    }
    
	public function index(){
        
        $data['title'] = "Service de gestion des cours pour les enseignants";
        $this->load->view('header', $data);        
        $this->load->view('login_view');           
        $this->load->view('footer');
        
	}
}
