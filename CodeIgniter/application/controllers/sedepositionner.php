<?php

class sedepositionner extends CI_Controller {

	public function __construct()
	{
		session_start();
		parent::__construct();
		$this->load->model('choisir_cours_model');
	}

	
	public function index()
	{	
		redirect('home','refresh');
	}


	public function depositionnement($partie, $module)
	{

     	$login = $this->session->userdata('info_user')['login'];
		//$this->load->model('admin_model');
		//$data['module']=$module;
		$data['title']='Projet_php';
		$data['page_header']='Supression de la partie';
		$partie = str_replace("%20"," ",$partie);

		$this->choisir_cours_model->supprimerEnseignantDePartie($partie ,$module);
	
		$this->load->view('header', $data);
		$this->load->view('sedepositionner_vue', $data);

		$this->load->view('footer', $data);
	}

}
?>