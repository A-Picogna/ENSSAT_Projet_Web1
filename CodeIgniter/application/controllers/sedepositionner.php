<?php

class sedepositionner extends CI_Controller {

	public function __construct(){
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
        $data['message_validation'] = "La partie ".$partie." du module ".$module." a été supprimée avec succès";
		$this->load->view('header', $data);
		$this->load->view('affiche_message_confirmation', $data);
		$this->load->view('footer', $data);
	}

}
?>