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
		$data["titre"] = "Suppression module";
		$data["message_validation"] = "Le module " .$ident."et tous ses cours ont bien été supprimés.";
		$this->gestion_module_model->supprime_module($ident);
		$this->load->view('header_admin', $data);
		$this->load->view('affiche_message_confirmation', $data);
		$this->load->view('footer', $data);
	}

	public function modifierModule($ident) {
		$data["titre"] = "Modifier module";
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

			$this->gestion_module_model->modif_module($_POST["ident"], $_POST["libelle"], $publique, $_POST["semestre"], $_POST["idResponsable"]);

			$this->load->view('header_admin', $data);
			$this->load->view('affiche_message_confirmation', $data);
			$this->load->view('footer', $data);
		}
	}

	public function supprimeCours($ident, $partie) {
		$data["titre"] = "Suppression module";
		$data["message_validation"] = "Le cours " .urldecode($partie)." du module ".$ident." a bien été supprimé";
		$this->gestion_module_model->supprime_cours($ident, urldecode($partie));
		$this->load->view('header_admin', $data);
		$this->load->view('affiche_message_confirmation', $data);
		$this->load->view('footer', $data);
	}

	public function modifierCours($ident, $partie) {

	}

	public function modificationCours($ident, $partie) {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('partie', 'Partie', 'required');
		$this->form_validation->set_rules('hed', 'Hed', 'required');
		$this->form_validation->set_rules('idEnseignant', 'Identifiant de l\'enseignant', 'callback_enseignant_check');

		if ($this->form_validation->run() == FALSE)
		{
			$data["titre"] = "Le module";
			$this->load->view('header_admin', $data);
			$this->load->view('recap_module_view', $data);
			$this->load->view('ajout_cours_view', $data);
			$this->load->view('footer', $data);
		}
		else
		{

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
}
?>
