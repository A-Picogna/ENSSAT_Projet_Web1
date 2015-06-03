<?php	

class listeModules extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('affiche_module_model');
	}

	public function index()
	{
		$this->home();
	}

	public function home()
	{

		$data['title']='Projet_php';
		$data['page_header']='liste des modules';
		$data['liste'] = $this->affiche_module_model->getListeModules();
		$this->load->view('header', $data);
		$this->load->view('liste_modules_vue', $data);
		$this->load->view('footer', $data);
	}
 }
?>