<?php
class Gestion_Module_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function creer_module()
	{
		$resp = "";
		if ($this->session->userdata('module')["idResponsable"] != "") {
			$query = $this->db->query('Insert into module values ("'.$this->session->userdata('module')["ident"].'", "'.$this->session->userdata('module')["public"].'", "'.$this->session->userdata('module')["semestre"].'", "'.$this->session->userdata('module')["libelle"].'", "'.$this->session->userdata('module')["idResponsable"].'")');
		}
		else {
			$query = $this->db->query('Insert into module values ("'.$this->session->userdata('module')["ident"].'", "'.$this->session->userdata('module')["public"].'", "'.$this->session->userdata('module')["semestre"].'", "'.$this->session->userdata('module')["libelle"].'", null)');
		}
		if (!empty($query)) {
			foreach($this->session->userdata('moduleCours') as $cours) {
				$ens = "";
				if ($cours["idEnseignant"] != "") {
					$query = $this->db->query('Insert into contenu values ("'.$this->session->userdata('module')["ident"].'", "'.$cours["partie"].'", "'.$cours["type"].'", "'.$cours["hed"].'", "'.$cours["idEnseignant"].'")');
				}
				else {
					$query = $this->db->query('Insert into contenu values ("'.$this->session->userdata('module')["ident"].'", "'.$cours["partie"].'", "'.$cours["type"].'", "'.$cours["hed"].'", null)');
				}
			}
		}	
		return $query;
	}

	public function get_liste_modules()
	{
		$query = $this->db->query('Select * from module order by ident');
		return $query->result_array();
	}

	public function get_module($ident)
	{
		$query = $this->db->query('Select * from module where ident="'.$ident.'"');
		return $query->result_array();
	}

	public function supprime_module($ident) {
		$this->db->query('Delete from contenu where module="'.$ident.'"');
		$this->db->query('Delete from module where ident="'.$ident.'"');
	}

	public function modif_module($ident, $libelle, $public, $semestre, $resp="") {
		if ($resp!="")
			$this->db->query('Update module 
					set libelle="'.$libelle.'", public="'.$public.'", semestre="'.$semestre.'", responsable="'.$resp.'" 
					where ident="'.$ident.'"');
		else
			$this->db->query('Update module 
					set libelle="'.$libelle.'", public="'.$public.'", semestre="'.$semestre.'"  
					where ident="'.$ident.'"');
	}

	public function get_liste_cours($ident) {
		$query = $this->db->query('Select * from contenu where module="'.$ident.'"');
		return $query->result_array();
	}

	public function get_cours($ident, $partie)
	{
		$query = $this->db->query('Select * from contenu where module="'.$ident.'" and partie="'.$partie.'"');
		return $query->result_array();
	}

	public function supprime_cours($ident, $partie) {
		$this->db->query('Delete from contenu where module="'.$ident.'" and partie="'.$partie.'"');
	}

	public function ajout_cours($ident, $cours) {
		$ens = "";
		if ($cours["idEnseignant"] != "") {
			$query = $this->db->query('Insert into contenu values ("'.$ident.'", "'.$cours["partie"].'", "'.$cours["type"].'", "'.$cours["hed"].'", "'.$cours["idEnseignant"].'")');
		}
		else {
			$query = $this->db->query('Insert into contenu values ("'.$ident.'", "'.$cours["partie"].'", "'.$cours["type"].'", "'.$cours["hed"].'", null)');
		}
	}

	public function modif_cours($ident, $cours) {
		if ($cours["enseignant"]!="")
			$this->db->query('Update contenu 
					set type="'.$cours["type"].'", hed="'.$cours["hed"].'", enseignant="'.$cours["enseignant"].'" 
					where module="'.$ident.'" and partie="'.$cours["partie"].'"');
		else
			$this->db->query('Update contenu 
					set type="'.$cours["type"].'", hed="'.$cours["hed"].'"  
					where module="'.$ident.'" and partie="'.$cours["partie"].'"');
	}

	public function verif_existence_enseignant($id) {
		$query = $this->db->query('Select login from enseignant where login="'.$id.'"');
		return $query->result_array();
	}

	public function verif_existence_ident($ident) {
		$query = $this->db->query('Select ident from module where ident="'.$ident.'"');
		return $query->result_array();
	}

	public function verif_redondance_partie($ident, $str) {
		$query = $this->db->query('Select partie from contenu where module="'.$ident.'" and partie="'.$str.'"');
		return $query->result_array();
	}

	public function verif_count_cours($ident) {
		$query = $this->db->query('Select count(*) from contenu where module="'.$ident.'"');
		return $query->result_array()[0];
	}
}
?>
