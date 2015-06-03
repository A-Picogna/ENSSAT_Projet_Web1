<?php
class Ajout_Module_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function creer_module()
	{
		$resp = "";
		if ($this->session->userdata('module')["nomResponsable"] != "") {
			$resp = $this->verif_existence_enseignant($this->session->userdata('module')["nomResponsable"], $this->session->userdata('module')["prenomResponsable"]);
			$query = $this->db->query('Insert into module values ("'.$this->session->userdata('module')["ident"].'", "'.$this->session->userdata('module')["public"].'", "'.$this->session->userdata('module')["semestre"].'", "'.$this->session->userdata('module')["libelle"].'", "'.$resp[0]["login"].'")');
		}
		else {
			$query = $this->db->query('Insert into module values ("'.$this->session->userdata('module')["ident"].'", "'.$this->session->userdata('module')["public"].'", "'.$this->session->userdata('module')["semestre"].'", "'.$this->session->userdata('module')["libelle"].'", null)');
		}
		if (!empty($query)) {
			foreach($this->session->userdata('moduleCours') as $cours) {
				$ens = "";
				if ($cours["nomEnseignant"] != "") {
					$ens = $this->verif_existence_enseignant($cours["nomEnseignant"], $cours["prenomEnseignant"]);
					$query = $this->db->query('Insert into contenu values ("'.$this->session->userdata('module')["ident"].'", "'.$cours["partie"].'", "'.$cours["type"].'", "'.$cours["hed"].'", "'.$ens[0]["login"].'")');
				}
				else {
					$query = $this->db->query('Insert into contenu values ("'.$this->session->userdata('module')["ident"].'", "'.$cours["partie"].'", "'.$cours["type"].'", "'.$cours["hed"].'", null)');
				}
			}
		}	
		return $query;
	}

	public function verif_existence_enseignant($nom, $prenom) {
		$query = $this->db->query('Select login from enseignant where nom="'.$nom.'" and prenom="'.$prenom.'"');
		return $query->result_array();
	}

	public function verif_existence_ident($ident) {
		$query = $this->db->query('Select ident from module where ident="'.$ident.'"');
		return $query->result_array();
	}

}
?>
