<?php

class sedepositionner extends CI_Controller {

	/*
	*	Constructeur du contrôleur depositionnement
	* 	On vérifie que l'utilisateur est bien connecté.
	*	On vérifie que l'utilisateur est bien actif.
	*	Enfin, on charge le modèle.
	*/

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

	/**
	*	Fonction qui permet de se depositionner d'une partie d'un module
	**/

	public function depositionnement($partie, $module)
	{
		$partie = urldecode($partie);
		$module = urldecode($module);
     	$login = $this->session->userdata('info_user')['login'];
		//$this->load->model('admin_model');
		//$data['module']=$module;
		$data['titre']='Dépositionnement';
		$data['page_header']='Dépositionnement';

		$this->choisir_cours_model->supprimerEnseignantDePartie($partie ,$module);
        $data['message_validation'] = "Vous vous êtes bien dépositionné du cours ".$partie." du module ".$module.".";
		$this->load->view('header', $data);
		$this->load->view('affiche_message_confirmation', $data);
		$this->load->view('footer', $data);
        header("Refresh:2;url=".base_url()."index.php/home");
	}

}
?>
