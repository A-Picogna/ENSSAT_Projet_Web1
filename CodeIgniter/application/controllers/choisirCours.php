<?php

class choisirCours extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('choisir_cours_model');
	}

	
	public function index()
	{
		$this->home('opivert', 'ALGOC1');
	}
	
	public function positionnement($module)
	{
        $login = $this->session->userdata('info_user')['login'];
		//$this->load->model('admin_model');
		$data['module']=$module;
		$data['title']='Projet_php';
		$data['page_header']='Choisir un cours';
		$data['PartiesCM']=$this->choisir_cours_model->getPartiesCM($module);
		$data['PartiesTD']=$this->choisir_cours_model->getPartiesTD($module);
		$data['PartiesTP']=$this->choisir_cours_model->getPartiesTP($module);
		$data['PartiesProjet']=$this->choisir_cours_model->getPartiesProjet($module);
		//$data['heuresCMEnseignant'] = $this->choisir_cours_model->get_heuresCM($login);
		//$data['heuresTDEnseignant'] = $this->choisir_cours_model->get_heuresTD($login);
		//$data['heuresTPEnseignant'] = $this->choisir_cours_model->get_heuresTP($login);
		//$data['heuresProjetEnseignant'] = $this->choisir_cours_model->get_heuresProjet($login);
		$data['statutaireEnseignant']=$this->choisir_cours_model->getStatutaire($login);
		$data['dechargeEnseignant']=$this->choisir_cours_model->getDecharge($login);
		
		$this->load->view('header', $data);
		$this->load->view('choisir_cours_vue', $data);

		$this->load->view('footer', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>