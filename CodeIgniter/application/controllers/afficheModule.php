<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/*
	*	Constructeur du contrôleur home
	* 	On vérifie que l'utilisateur est bien connecté.
	*	On vérifie que l'utilisateur est bien actif.
	*	Enfin, on charge le modèle.
	*/

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

	/**
	*	Fonction qui affiche la fiche associé a chaque module
	**/
	
	public function home($module)
	{
		$module = urldecode($module);
		$data['titre']='Liste des cours';
		$data['page_header']='Fiche Module';
		$data['responsable']=$this->affiche_module_model->getResponsable($module);
		$data['filiere']=$this->affiche_module_model->getFiliere($module);
		$data['Cours'] = $this->affiche_module_model->getCourses($module);
		$data['Modules'] = $this->affiche_module_model->getModule($module);
		$data['hCM'] = $this->affiche_module_model->getHeuresCM($module);
		$data['hTD'] = $this->affiche_module_model->getHeuresTD($module);
		$data['hTP'] = $this->affiche_module_model->getHeuresTP($module);
		$data['hProjets'] = $this->affiche_module_model->getHeuresProjet($module);
		$data['coursdispo'] = $this->affiche_module_model->getcoursdispo($module);
        $data['courspris'] = $this->affiche_module_model->getcourspris($module);
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
