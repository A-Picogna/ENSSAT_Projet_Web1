<?php
class ajoutModule extends CI_Controller {

	public function __construct()
	{
		session_start();
		parent::__construct();
        if($this->session->userdata('info_user')){
            if (!$this->session->userdata('info_user')['actif']){
                $this->session->set_flashdata('type_erreur', 'inactif');
                redirect('erreur', 'refresh');
            }                    
        }
        else{
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
		$this->load->model('ajout_module_model');
	}

	public function index()
	{
		$data["titre"] = "Le module";
		$this->load->view('header', $data);
		$this->load->view('ajout_module_view', $data);
		$this->load->view('footer', $data);
	}

	public function ajoutPremierCours() {
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_rules('ident', 'Identifiant', 'callback_identifiant_module_check');
		$this->form_validation->set_rules('libelle', 'Libellé', 'required');
		$this->form_validation->set_rules('nomResponsable', 'Nom et Prénom du responsable', 'callback_responsable_check');

		if ($this->form_validation->run() == FALSE)
		{
			$data["titre"] = "Le module";
			$this->load->view('header', $data);
			$this->load->view('ajout_module_view', $data);
			$this->load->view('footer', $data);
		}
		else
		{
			$data["titre"] = "Le module";
			$this->session->unset_userdata('moduleCours');
			if (isset($_POST["libelle"])) {
				$module = array (
					"ident" => $_POST["ident"],
					"libelle" => $_POST["libelle"],
					"public" => $_POST["public"],
					"semestre" => $_POST["semestre"],
					"nomResponsable" => $_POST["nomResponsable"],
					"prenomResponsable" => $_POST["prenomResponsable"]
				);
				$this->session->set_userdata('module', $module);
			} 
			$this->load->view('header', $data);
			$this->load->view('recap_module_view', $data);
			$this->load->view('ajout_cours_view', $data);
			$this->load->view('footer', $data);
		}
	}

	public function ajoutCours() {
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_rules('partie', 'Partie', 'required');
		$this->form_validation->set_rules('hed', 'Hed', 'required');
		$this->form_validation->set_rules('nomEnseignant', 'Nom et Prénom de l\'enseignant', 'callback_enseignant_check');

		if ($this->form_validation->run() == FALSE)
		{
			$data["titre"] = "Le module";
			$this->load->view('header', $data);
			$this->load->view('recap_module_view', $data);
			$this->load->view('ajout_cours_view', $data);
			$this->load->view('footer', $data);
		}
		else
		{
			$data["titre"] = "Le module";
			if ($this->session->userdata('moduleCours') == null) {
				$this->session->set_userdata('moduleCours', array (array(
					"partie" => $_POST["partie"],
					"type" => $_POST["type"],
					"hed" => $_POST["hed"],
					"nomEnseignant" => $_POST["nomEnseignant"],
					"prenomEnseignant" => $_POST["prenomEnseignant"]
				)));
			}
			else {
				$cours = $this->session->userdata('moduleCours');
				array_push($cours, array(
					"partie" => $_POST["partie"],
					"type" => $_POST["type"],
					"hed" => $_POST["hed"],
					"nomEnseignant" => $_POST["nomEnseignant"],
					"prenomEnseignant" => $_POST["prenomEnseignant"]
				));
				$this->session->set_userdata('moduleCours', $cours);
			}

			$this->load->view('header', $data);
			$this->load->view('recap_module_view', $data);
			$this->load->view('ajout_cours_view', $data);
			$this->load->view('bouton_validation_creation_module_view', $data);
			$this->load->view('footer', $data);
		}
	}

	public function creationModule() {
		$res=$this->ajout_module_model->creer_module();
		if ($res)
			echo "youpi";
		else
			echo "oups";
	}

	public function responsable_check($str) {
		if ($str=='' && $_POST["prenomResponsable"]=='')
			return true;
		else {
			$res=$this->ajout_module_model->verif_existence_enseignant($str, $_POST["prenomResponsable"]);
			if (empty($res)) {
				$this->form_validation->set_message('responsable_check', 'Cet enseignant n\'est pas répertorié.');
				return false;
			}
			else {
				return true;
			}
		}
	}

	public function enseignant_check($str) {
		if ($str=='' && $_POST["prenomEnseignant"]=='')
			return true;
		else {
			$res=$this->ajout_module_model->verif_existence_enseignant($str, $_POST["prenomEnseignant"]);
			if (empty($res)) {
				$this->form_validation->set_message('enseignant_check', 'Cet enseignant n\'est pas répertorié.');
				return false;
			}
			else {
				return true;
			}
		}
	}

	public function identifiant_module_check($str) {
		if ($str=='') {
			$this->form_validation->set_message('identifiant_module_check', 'Le champ Identifiant est obligatoire.');
				return false;
		}
		else {
			$res=$this->ajout_module_model->verif_existence_ident($str);
			if (!empty($res)) {
				$this->form_validation->set_message('identifiant_module_check', 'Cet identifiant est déjà utilisé. Vérifiez que ce module n\'existe pas déjà.');
				return false;
			}
			else {
				return true;
			}
		}
	}

}
?>
