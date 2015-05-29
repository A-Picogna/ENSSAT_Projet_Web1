<?php
class Fiche_Enseignant_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_enseignant($login)
	{
		$query = $this->db->query('Select nom, prenom, statut from enseignant where login="'. $login .'"');
		return $query->result_array();
	}

	public function get_cours($login)
	{
		$query = $this->db->query('Select module, partie, hed, type, public, libelle from contenu, module where module=ident and enseignant="'. $login .'" order by module');
		return $query->result_array();
	}

	public function get_heuresCM($login)
	{
		$query = $this->db->query('Select sum(hed) from contenu, module where module=ident and enseignant="'. $login .'" and type="CM" order by hed');
		return $query->result_array();
	}

	public function get_heuresTD($login)
	{
		$query = $this->db->query('Select sum(hed) from contenu, module where module=ident and enseignant="'. $login .'" and type="TD" order by hed');
		return $query->result_array();
	}

	public function get_heuresTP($login)
	{
		$query = $this->db->query('Select sum(hed) from contenu, module where module=ident and enseignant="'. $login .'" and type="TP" order by hed');
		return $query->result_array();
	}

	public function get_heuresProjet($login)
	{
		$query = $this->db->query('Select sum(hed) from contenu, module where module=ident and enseignant="'. $login .'" and type="projet" order by hed');
		return $query->result_array();
	}

}
?>
