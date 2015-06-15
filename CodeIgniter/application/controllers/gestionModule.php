<?php
class gestionModule extends CI_Controller {

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
            else{
                if(!$this->session->userdata('info_user')['administrateur']){
                    $this->session->set_flashdata('type_erreur', 'admin');
                    redirect('erreur', 'refresh');
                }            
            }
        }
		$this->load->model('gestion_module_model');
	}

	public function index()
	{
		$data["titre"] = "Liste des modules";
		$data["liste_modules"] = $this->gestion_module_model->get_modules();
		$this->load->view('header_admin', $data);
		$this->load->view('liste_modules_admin_view', $data);
		$this->load->view('footer', $data);
	}

	public function supprimeModule($ident) {
		$data["titre"] = "Suppression module";
		$data["message_validation"] = $ident."et tous ses cours ont bien été supprimés.";
		$this->gestion_module_model->supprime_module($ident);
		$this->load->view('header_admin', $data);
		$this->load->view('supprime_module_view', $data);
		$this->load->view('footer', $data);
	}
}
?>
