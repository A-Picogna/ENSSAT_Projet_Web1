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
		$data["liste_modules"] = $this->gestion_module_model->get_liste_modules();
		$this->load->view('header_admin', $data);
		$this->load->view('admin_liste_modules_view', $data);
		$this->load->view('footer', $data);
	}

	public function supprimeModule($ident) {
		$ident = urldecode($ident);
		$data["titre"] = "Suppression module";
		$data["message_validation"] = "Le module " .$ident."et tous ses cours ont bien été supprimés.";

		$this->gestion_module_model->supprime_module($ident);
		$this->load->view('header_admin', $data);
		$this->load->view('affiche_message_confirmation', $data);
		$this->load->view('footer', $data);
	}

	public function modifierModule($ident) {
		$data["titre"] = "Modifier module";
		$ident = urldecode($ident);
		$data["ident"] = $ident;
		$data["module"] = $this->gestion_module_model->get_module($ident)[0];
		$data["liste_cours"] = $this->gestion_module_model->get_liste_cours($ident);

		$this->load->view('header_admin', $data);
		$this->load->view('modif_module_view', $data);
		$this->load->view('admin_liste_cours_view', $data);
		$this->load->view('footer', $data);
	}

	public function modificationModule() {
		$data["titre"] = "Modifier module";
		$data["message_validation"] = "Le module " .$_POST["ident"]." a bien été modifié.";
		$data["ident"] = $_POST["ident"];

		$this->load->library('form_validation');
		$this->form_validation->set_rules('libelle', 'Libellé', 'required');
		$this->form_validation->set_rules('public[]', 'Public', 'required');
		$this->form_validation->set_rules('idResponsable', 'Identifiant du responsable', 'callback_enseignant_check');

		if ($this->form_validation->run() == FALSE)
		{
			$data["module"] = $this->gestion_module_model->get_module($_POST["ident"])[0];
			$data["liste_cours"] = $this->gestion_module_model->get_liste_cours($_POST["ident"]);
			$this->load->view('header_admin', $data);
			$this->load->view('modif_module_view', $data);
			$this->load->view('admin_liste_cours_view', $data);
			$this->load->view('footer', $data);
		}
		else
		{
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

			$data["titre"] = "Modifier module";
			$data["ident"] = $_POST["ident"];

			$this->gestion_module_model->modif_module($_POST["ident"], $_POST["libelle"], $publique, $_POST["semestre"], $_POST["idResponsable"]);

			$data["module"] = $this->gestion_module_model->get_module($_POST["ident"])[0];
			$data["liste_cours"] = $this->gestion_module_model->get_liste_cours($_POST["ident"]);

			$this->load->view('header_admin', $data);
			$this->load->view('affiche_message_confirmation', $data);
			$this->load->view('modif_module_view', $data);
			$this->load->view('admin_liste_cours_view', $data);
			$this->load->view('footer', $data);
		}
	}

	public function ajoutCours($ident) {
		$ident = urldecode($ident);
		$cours = array (
			"partie" => $this->input->post('partie'),
			"type" => $this->input->post('type'),
			"hed" => $this->input->post('hed'),
			"idEnseignant" => $this->input->post('idEnseignant')
		);
		$this->gestion_module_model->ajout_cours($ident, $cours);

		redirect('gestionModule/modifierModule/'.$ident, 'refresh');
	}

	public function supprimeCours($ident, $partie) {
		$ident = urldecode($ident);
		$partie = urldecode($partie);
		if ($this->gestion_module_model->verif_count_cours($ident)["count(*)"] > 1) {
			$data["titre"] = "Suppression module";
			$data["message_validation"] = "Le cours " .$partie." du module ".$ident." a bien été supprimé";
			$this->gestion_module_model->supprime_cours($ident, $partie);
			$this->load->view('header_admin', $data);
			$this->load->view('affiche_message_confirmation', $data);
			$this->load->view('footer', $data);
		}
		else {
			$data["message_erreur"] = "Vous ne pouvez pas supprimer l'unique cours d'un module.";
			$this->load->view('header_admin', $data);
			$this->load->view('affiche_erreur', $data);
			$this->load->view('footer', $data);
		}
	}

	public function modifierCours($ident, $partie) {
		$ident = urldecode($ident);
		$partie = urldecode($partie);
		$data["titre"] = "Modifier un cours";
		$data["ident"] = $ident;

		$data["cours"] = $this->gestion_module_model->get_cours($ident, $partie)[0];

		$this->load->view('header_admin', $data);
		$this->load->view('modif_cours_view', $data);
		$this->load->view('footer', $data);
	}

	public function modificationCours($ident, $partie) {
		$ident = urldecode($ident);
		$partie = urldecode($partie);
		$data["titre"] = "Modifier cours";
		$data["message_validation"] = "Le cours " .$_POST["partie"]." a bien été modifié.";
		$data["ident"] = $ident;
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('partie', 'Partie', 'required');
		$this->form_validation->set_rules('hed', 'Hed', 'required');
		$this->form_validation->set_rules('idEnseignant', 'Identifiant de l\'enseignant', 'callback_enseignant_check');

		$data["cours"] = array (
			"partie" => $this->input->post('partie'),
			"type" => $this->input->post('type'),
			"hed" => $this->input->post('hed'),
			"enseignant" => $this->input->post('idEnseignant')
		);
		if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->view('header_admin', $data);
			$this->load->view('modif_cours_view', $data);
			$this->load->view('footer', $data);
		}
		else
		{
			$data["titre"] = "Modifier module";
			$data["ident"] = $ident;

			$this->gestion_module_model->modif_cours($ident, $data["cours"]);

			$data["module"] = $this->gestion_module_model->get_module($ident)[0];
			$data["liste_cours"] = $this->gestion_module_model->get_liste_cours($ident);

			$this->load->view('header_admin', $data);
			$this->load->view('affiche_message_confirmation', $data);
			$this->load->view('modif_module_view', $data);
			$this->load->view('admin_liste_cours_view', $data);
			$this->load->view('footer', $data);
		}
	}


	public function enseignant_check($str) {
		if ($str=='')
			return true;
		else {
			$res=$this->gestion_module_model->verif_existence_enseignant($str);
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
			$res=$this->gestion_module_model->verif_existence_ident($str);
			if (!empty($res)) {
				$this->form_validation->set_message('identifiant_module_check', 'Cet identifiant est déjà utilisé. Vérifiez que ce module n\'existe pas déjà.');
				return false;
			}
			else {
				return true;
			}
		}
	}

	public function partie_cours_check1($str, $ident) {
		if ($str=='') {
			$this->form_validation->set_message('partie_cours_check', 'Le champ Partie est obligatoire.');
				return false;
		}
		else {
			$res=$this->gestion_module_model->verif_redondance_partie($ident, $str);
			if (!empty($res)) {
				$this->form_validation->set_message('partie_cours_check', 'Ce nom de partie est déjà utilisé dans ce module.');
				return false;
			}
			else {
				return true;
			}
		}
	}
}
?>
