<?php
class ajoutModule extends CI_Controller {

	/**
	*	Constructeur du contrôleur ajoutModule
	* 	On vérifie que l'utilisateur est bien connecté.
	*	On vérifie que l'utilisateur est bien actif.
	*	Comme il s'agit d'un contrôleur spécifique à l'administration, on vérifie que l'utilisateur est bien administrateur.
	*	Enfin, on charge le modèle.
	**/
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

	/**
	*	Page principale du contrôleur
	*	On affiche la formulaire pour ajouter un module.
	**/
	public function index()
	{
		$data["titre"] = "Le module";
		$this->load->view('header_admin', $data);
		$this->load->view('ajout_module_view', $data);
		$this->load->view('footer', $data);
	}

	/**
	*	Page de création du premier cours
	*	On vérifie que les données pour la création du module sont valides.
	*	Si ce n'est pas le cas, on réaffiche le formulaire de création du module en affichant les erreurs.
	*	Sinon, on stocke les données du module et on affiche le formulaire de création de cours.
	**/
	public function ajoutPremierCours() {
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_rules('ident', 'Identifiant', 'callback_identifiant_module_check');
		$this->form_validation->set_rules('libelle', 'Libellé', 'required');
		$this->form_validation->set_rules('public[]', 'Public', 'required');
		$this->form_validation->set_rules('idResponsable', 'Identifiant du responsable', 'callback_enseignant_check');

		if ($this->form_validation->run() == FALSE)
		{
			if (isset($_POST["public"]))
				$data["public"] = $_POST["public"];
			$data["titre"] = "Le module";
			$this->load->view('header_admin', $data);
			$this->load->view('ajout_module_view', $data);
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
			$this->load->view('header_admin', $data);
			$this->load->view('recap_module_view', $data);
			$this->load->view('ajout_cours_view', $data);
			$this->load->view('footer', $data);
		}
	}

	/**
	*	Page de création des cours
	*	On vérifie que les données pour la création du cours sont valides.
	*	Si ce n'est pas le cas, on réaffiche le formulaire de création du cours en affichant les erreurs.
	*	Sinon, on stocke les données du cours et on affiche le formulaire de création de cours ainsi que le bouton pour créer le module.
	**/
	public function ajoutCours() {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('partie', 'Partie', 'callback_partie_cours_check');
		$this->form_validation->set_rules('hed', 'Hed', 'required|integer');
		$this->form_validation->set_rules('idEnseignant', 'Identifiant de l\'enseignant', 'callback_enseignant_check');

		if ($this->form_validation->run() == FALSE)
		{
			$data["titre"] = "Le module";
			$this->load->view('header_admin', $data);
			$this->load->view('recap_module_view', $data);
			$this->load->view('ajout_cours_view', $data);
			if ($this->session->userdata('moduleCours') != null)
				$this->load->view('bouton_validation_creation_module_view', $data);
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
					"idEnseignant" => $_POST["idEnseignant"]
				)));
			}
			else {
				$cours = $this->session->userdata('moduleCours');
				array_push($cours, array(
					"partie" => $_POST["partie"],
					"type" => $_POST["type"],
					"hed" => $_POST["hed"],
					"idEnseignant" => $_POST["idEnseignant"]
				));
				$this->session->set_userdata('moduleCours', $cours);
			}

			$this->load->view('header_admin', $data);
			$this->load->view('recap_module_view', $data);
			$this->load->view('ajout_cours_view', $data);
			$this->load->view('bouton_validation_creation_module_view', $data);
			$this->load->view('footer', $data);
		}
	}

	/**
	*	Page de création du module dans la base de données
	*	Les données stockées ont déjà toutes été vérifiées.
	*	On crée le module en faisant appel au modèle et on affiche le message de confirmation.
	**/
	public function creationModule() {
		$data["titre"] = "Le module";
        $data["message_validation"] = $this->session->userdata('module')["libelle"]." à bien été créé.";
		$res=$this->gestion_module_model->creer_module();
		if ($res) {
			$this->load->view('header_admin', $data);
			$this->load->view('affiche_message_confirmation', $data);
			$this->load->view('recap_module_view', $data);
			$this->load->view('footer', $data);
			$this->session->unset_userdata('module');
			$this->session->unset_userdata('moduleCours');
		}
	}

	/**
	*	On vérifie que le login de l'enseignant renseigné est bien dans la base de données.
	**/
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

	/**
	*	On vérifie que l'identifiant du module renseigné n'existe pas déjà dans la base de données.
	**/
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

	/**
	*	On vérifie que le nom de la partie du cours n'existe pas déjà pour ce module.
	**/
	public function partie_cours_check($str) {
		if ($str=='') {
			$this->form_validation->set_message('partie_cours_check', 'Le champ Partie est obligatoire.');
				return false;
		}
		else {
			$res = false;
			if ($this->session->userdata('moduleCours') != null) {
				foreach($this->session->userdata('moduleCours') as $cours) {
					if ($str == $cours["partie"])
						$res = true;
				}
			}
			if ($res) {
				$this->form_validation->set_message('partie_cours_check', 'Ce nom de partie est déjà utilisé.');
				return false;
			}
			else {
				return true;
			}
		}
	}

}
?>
