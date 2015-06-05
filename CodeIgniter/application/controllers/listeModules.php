<?php	

class listeModules extends CI_Controller {

	public function __construct()
	{
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
		$this->load->model('affiche_module_model');
	}

	public function index()
	{
		$this->home();
	}

	public function home()
	{
		$data['titre']='Liste des modules';
		$data['page_header']='liste des modules';
		$data['liste'] = $this->affiche_module_model->getListeModules();
		$this->load->view('header', $data);
		$this->load->view('liste_modules_vue', $data);
		$this->load->view('footer', $data);
	}
 }
?>