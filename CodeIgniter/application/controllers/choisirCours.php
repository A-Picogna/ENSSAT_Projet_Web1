<?php



class choisirCours extends CI_Controller {

	/*
	*	Constructeur du contrôleur positionnement
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
	*	Fonction qui permet de se positionner sur un cours
	**/
	
	public function positionnement($module)
	{
        $login = $this->session->userdata('info_user')['login'];
		$module = urldecode($module);
		$data['module']=$module;
		$data['titre']='Choisir un cours';
		$data['page_header']='Choisir un cours';
		$data['libelle']=$this->choisir_cours_model->getModule($module);
		$data['PartiesCM']=$this->choisir_cours_model->getPartiesCM($module);
		$data['PartiesTD']=$this->choisir_cours_model->getPartiesTD($module);
		$data['PartiesTP']=$this->choisir_cours_model->getPartiesTP($module);
		$data['PartiesProjet']=$this->choisir_cours_model->getPartiesProjet($module);
		$data['statutaireEnseignant']=$this->choisir_cours_model->getStatutaire($login);
		$data['dechargeEnseignant']=$this->choisir_cours_model->getDecharge($login);
		
		$this->load->view('header', $data);
		$this->load->view('choisir_cours_vue', $data);

		$this->load->view('footer', $data);
	}

}
?>
