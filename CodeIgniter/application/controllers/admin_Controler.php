<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_Controler extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$this->home("ALGOC2");
	}
	
	public function home($module)
	{
		//$this->load->model('admin_model');
		$data['title']='Projet_php';
		$data['page_header']='Fiche Module';
		$data['Responsables']=$this->admin_model->getResponsable($module);
		
		$data['Enseignants']=$this->admin_model->getEnseignant($module);
		$data['Cours'] = $this->admin_model->getCourses($module);
		$data['publics'] = $this->admin_model->getFiliere($module);
		$data['Modules'] = $this->admin_model->getModule($module);
		$data['hCM'] = $this->admin_model->getHeuresCM($module);
		$data['hTD'] = $this->admin_model->getHeuresTD($module);
		$data['hTP'] = $this->admin_model->getHeuresTP($module);
		$data['hProjets'] = $this->admin_model->getHeuresProjet($module);
		$this->load->view('admin_Vue', $data);
	}
	
}
 
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>