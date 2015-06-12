<?php
class ajoutModule extends CI_Controller {

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
		$this->load->model('ajout_module_model');
	}

	public function index()
	{
		$data["titre"] = "Le module";
		$this->load->view('header', $data);
		$this->load->view('supprime_module_view', $data);
		$this->load->view('footer', $data);
	}

	public function ajoutPremierCours() {
		

/*
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_rules('ident', 'Identifiant', 'callback_identifiant_module_check');
		$this->form_validation->set_rules('libelle', 'Libellé', 'required');
		$this->form_validation->set_rules('public[]', 'Public', 'required');
		$this->form_validation->set_rules('idResponsable', 'Identifiant du responsable', 'callback_enseignant_check');

		if ($this->form_validation->run() == FALSE)
		{
			$data["titre"] = "Le module";
			$this->load->view('header', $data);
			$this->load->view('supprime_module_view', $data);
			$this->load->view('footer', $data);
		}
		else
		{
			$data["titre"] = "Le module";
			$this->session->unset_userdata('moduleCours');
			if (isset($_POST["libelle"])) {
				$publique = '';
				if (count($_POST["public"]) >1) {
					foreach($_POST["public"] as $val) {
						if ($val == $_POST["public"][0])
							$publique = "commun ".$val;
						else
							$publique = $publique." et ".$val;
					}
				}
				else {
					$publique = $_POST["public"][0];
				}
				$module = array (
					"ident" => $_POST["ident"],
					"libelle" => $_POST["libelle"],
					"public" => $publique,
					"semestre" => $_POST["semestre"],
					"idResponsable" => $_POST["idResponsable"]
				);
				$this->session->set_userdata('module', $module);
			} 
			$this->load->view('header', $data);
			$this->load->view('supprime_module_view', $data);
			$this->load->view('footer', $data);
		}
*/
	}
}
?>
