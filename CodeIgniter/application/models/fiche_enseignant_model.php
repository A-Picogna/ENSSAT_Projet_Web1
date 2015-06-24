<?php
class Fiche_Enseignant_model extends CI_Model {

	/**
	*	Constructeur du modèle Fiche_Enseignant_model
	* 	On charge la base de données.
	**/
	public function __construct()
	{
		$this->load->database();
	}

	/**
	*	Fonction permettant de récupérer les données d'un enseignant selon son login
	**/
	public function get_enseignant($login)
	{
		$query = $this->db->query('Select login, nom, prenom, statut from enseignant where login="'. $login .'"');
		return $query->result_array();
	}

	/**
	*	Fonction permettant de récupérer les cours d'un enseignant selon son login
	**/
	public function get_cours($login)
	{
		$query = $this->db->query('Select module, partie, hed, type, public, libelle from contenu, module where module=ident and enseignant="'. $login .'" order by module, partie');
		return $query->result_array();
	}

	/**
	*	Fonction permettant de récupérer le total des heures CM
	**/
	public function get_heuresCM($login)
	{
		$query = $this->db->query('Select sum(hed) from contenu, module where module=ident and enseignant="'. $login .'" and type="CM" order by hed');
		return $query->result_array();
	}

	/**
	*	Fonction permettant de récupérer le total des heures TD
	**/
	public function get_heuresTD($login)
	{
		$query = $this->db->query('Select sum(hed) from contenu, module where module=ident and enseignant="'. $login .'" and type="TD" order by hed');
		return $query->result_array();
	}

	/**
	*	Fonction permettant de récupérer le total des heures TP
	**/
	public function get_heuresTP($login)
	{
		$query = $this->db->query('Select sum(hed) from contenu, module where module=ident and enseignant="'. $login .'" and type="TP" order by hed');
		return $query->result_array();
	}

	/**
	*	Fonction permettant de récupérer le total des heures Projet
	**/
	public function get_heuresProjet($login)
	{
		$query = $this->db->query('Select sum(hed) from contenu, module where module=ident and enseignant="'. $login .'" and type="projet" order by hed');
		return $query->result_array();
	}

}
?>
