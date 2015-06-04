<?php
class afficheEnseignant extends CI_Controller {

	public function __construct()
	{
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
		$this->load->model('fiche_enseignant_model');
	}

	public function index()
	{
		$this->afficheEnseignant("fgoasdoue");
	}

	public function afficheEnseignant($login) {
		$data['infosEnseignant'] = $this->fiche_enseignant_model->get_enseignant($login);
		$data['coursEnseignant'] = $this->fiche_enseignant_model->get_cours($login);
		$data['heuresCMEnseignant'] = $this->fiche_enseignant_model->get_heuresCM($login);
		$data['heuresTDEnseignant'] = $this->fiche_enseignant_model->get_heuresTD($login);
		$data['heuresTPEnseignant'] = $this->fiche_enseignant_model->get_heuresTP($login);
		$data['heuresProjetEnseignant'] = $this->fiche_enseignant_model->get_heuresProjet($login);
        $data['titre'] = "Affichage Enseignant";
		$this->load->view('header', $data);
		$this->load->view('fiche_enseignant_view', $data);
		$this->load->view('footer', $data);
	}

}
?>
