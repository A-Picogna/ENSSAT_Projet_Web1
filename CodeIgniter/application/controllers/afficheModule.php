<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class afficheModule extends CI_Controller {

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
        
	}
	
	public function home($module)
	{
		//$this->load->model('admin_model');
		$data['titre']='Projet_php';
		$data['page_header']='Fiche Module';
		$data['ResponsablesETfiliere']=$this->affiche_module_model->getResponsableANDFiliere($module);
		$data['Cours'] = $this->affiche_module_model->getCourses($module);
		$data['Modules'] = $this->affiche_module_model->getModule($module);
		$data['hCM'] = $this->affiche_module_model->getHeuresCM($module);
		$data['hTD'] = $this->affiche_module_model->getHeuresTD($module);
		$data['hTP'] = $this->affiche_module_model->getHeuresTP($module);
		$data['hProjets'] = $this->affiche_module_model->getHeuresProjet($module);
		$this->load->view('header', $data);
		$this->load->view('affiche_module_vue', $data);
		$this->load->view('footer', $data);
	}
    
    public function module($module)
	{
		$this->home($module);
	}
	
	
}
 
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>