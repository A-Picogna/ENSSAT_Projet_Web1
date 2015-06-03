<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class afficheModule extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('affiche_module_model');
	}

	public function index()
	{
		$this->home("ALGOC1");
	}
	
	public function home($module)
	{
		//$this->load->model('admin_model');
		$data['title']='Projet_php';
		$data['page_header']='Fiche Module';
		$data['Responsables']=$this->affiche_module_model->getResponsable($module);
		
		$data['Enseignants']=$this->affiche_module_model->getEnseignant($module);
		$data['Cours'] = $this->affiche_module_model->getCourses($module);
		$data['publics'] = $this->affiche_module_model->getFiliere($module);
		$data['Modules'] = $this->affiche_module_model->getModule($module);
		$data['hCM'] = $this->affiche_module_model->getHeuresCM($module);
		$data['hTD'] = $this->affiche_module_model->getHeuresTD($module);
		$data['hTP'] = $this->affiche_module_model->getHeuresTP($module);
		$data['hProjets'] = $this->affiche_module_model->getHeuresProjet($module);
		$this->load->view('header', $data);
		$this->load->view('affiche_module_vue', $data);
		$this->load->view('footer', $data);
	}
	
}
 
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>