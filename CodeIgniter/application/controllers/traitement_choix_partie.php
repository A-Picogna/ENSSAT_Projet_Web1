<?php

class traitement_choix_partie extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('choisir_cours_model');
		
	}

	
	public function index()
	{
		$module = $this->input->post('ident');
		print_r($module);
		$login = $this->session->userdata('info_user')['login'];
		print_r($login);
		$this->traitement($module, $login);
		
	}
	
	public function traitement($module,$login)
	{

		$module = $this->input->post('ident');


		$sommeHeuresCMChoisies=0;
		$sommeHeuresTDChoisies=0;  /* initialisation à 0 ? */
		$sommeHeuresTPChoisies=0;
		$sommeHeuresProjetChoisies=0;
		$TotalHeuresEnseignantAvant=0;


		$PartieCMchecked = $this->input->post('CM');
		if($PartieCMchecked != null)
		{
			foreach ($PartieCMchecked as $CM)
			{
				$data['heuresCM'][]=$this->choisir_cours_model->getheureCMPartie($module, $CM);
			}
		}
		else { $data['heuresCM']=null;}


		$PartieTDchecked = $this->input->post('TD');
		if($PartieTDchecked != null)
		{
			foreach ($PartieTDchecked as $TD) 
			{	
				$data['heuresTD'][]=$this->choisir_cours_model->getheureTDPartie($module, $TD);
			}
		}
		else { $data['heuresTD']=null;}


		$PartieTPchecked = $this->input->post('TP');
		if($PartieTPchecked != null)
		{
			foreach ($PartieTPchecked as $TP)
			{	

				$data['heuresTP'][]=$this->choisir_cours_model->getheureTPPartie($module, $TP);	
			}
		}
		else { $data['heuresTP']=null;}


		$PartieProjetchecked = $this->input->post('Projet');
		if($PartieProjetchecked != null)
		{
			foreach ($PartieProjetchecked as $Projet)
			{
				$data['heuresProjet'][]=$this->choisir_cours_model->getheureProjetPartie($module, $Projet);
			}
		}
		else { $data['heuresProjet']=null;}


		
		$data['statutaireEnseignant']=$this->choisir_cours_model->getStatutaire($login);
		$data['dechargeEnseignant']=$this->choisir_cours_model->getDecharge($login);


		if($data['heuresCM'] != null){

			foreach ( $data['heuresCM'] as $key) 
			{
				$sommeHeuresCMChoisies += $key;
			}
		}

		if($data['heuresTD'] != null){

			foreach ( $data['heuresTD'] as $key) 
			{
				$sommeHeuresTDChoisies += $key;
			}
		}

		if($data['heuresTP'] != null){

			foreach ( $data['heuresTP'] as $key) 
			{
				$sommeHeuresTPChoisies += $key;
			}
		}

		if($data['heuresProjet'] != null){

			foreach ( $data['heuresProjet'] as $key) 
			{
				$sommeHeuresProjetChoisies += $key;

			}
		}

			$totalHeuresPartiesChoisies = ($sommeHeuresCMChoisies + 
										$sommeHeuresTDChoisies + 
										$sommeHeuresTPChoisies + 
										$sommeHeuresProjetChoisies);

			$HeuresEnseignantAvant = $this->choisir_cours_model->getHeuresEnseignant($login);

			
			if($HeuresEnseignantAvant != null) /* heures qu'avait deja l'enseignant avant son choix */
			{
				foreach ($HeuresEnseignantAvant as $h) {
					$TotalHeuresEnseignantAvant += $h['hed'];
				}
			}

			$totalHeuresEnseignant = $TotalHeuresEnseignantAvant + $totalHeuresPartiesChoisies;
			$totalHeuresPermises = $data['statutaireEnseignant'] - $data['dechargeEnseignant'];

		$this->load->view('header', $data);
		if (!isset($data['dechargeEnseignant']) || ($totalHeuresEnseignant < $totalHeuresPermises))
		{


			if($PartieCMchecked != null){
				foreach ($PartieCMchecked as $key) 
				{
					$this->choisir_cours_model->updateContenuEnseignantPartie($login, $module ,$key);
				}
			}

			if($PartieTDchecked != null){
				foreach ($PartieTDchecked as $key) 
				{
					$this->choisir_cours_model->updateContenuEnseignantPartie($login, $module ,$key);
				}
			}

			if($PartieTPchecked != null){
				foreach ($PartieTPchecked as $key) 
				{
					$this->choisir_cours_model->updateContenuEnseignantPartie($login, $module ,$key);
				}
			}

			if($PartieProjetchecked != null){
				foreach ($PartieProjetchecked as $key) 
				{
					$this->choisir_cours_model->updateContenuEnseignantPartie($login, $module ,$key);
				}
			}

				
			$this->load->view('confirmation_choix_partie', $data);
		
		

		}
		else if ($totalHeuresEnseignant > $totalHeuresPermises)
		{
	
			$this->load->view('refus_choix_partie', $data);
			
		}


		$this->load->view('footer', $data);


	}


}

?>
