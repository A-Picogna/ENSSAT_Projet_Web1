<?php

class Choisir_cours_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}

	/**
	*	Fonction permettant de récupérer les parties de type CM, leurs heures et leurs type pour un module donné
	**/
	public function getPartiesCM($module)
	{
		$query = $this->db->query('SELECT partie, hed, type from contenu where type = "CM" and enseignant is NULL and module="'. $module .'" order by partie');
	
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}

	/**
	*	Fonction permettant de récupérer les parties de type TD, leurs heures pour un module donné
	**/
	public function getPartiesTD($module)
	{
		$query = $this->db->query('SELECT partie, hed, type from contenu where type = "TD" and enseignant is NULL and module="'. $module .'" order by partie');
	
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}

	/**
	*	Fonction permettant de récupérer les parties de type TP, leurs heures pour un module donné
	**/
	public function getPartiesTP($module)
	{
		$query = $this->db->query('SELECT partie, hed, type from contenu where type = "TP" and enseignant is NULL and module="'. $module .'" order by partie');
	
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}
	/**
	*	Fonction permettant de récupérer les parties de type Projet, leurs heures pour un module donné
	**/
	public function getPartiesProjet($module)
	{
		$query = $this->db->query('SELECT partie, hed, type from contenu where type = "Projet" and enseignant is NULL and module="'. $module .'" order by partie');
	
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}

	/**
	*	Fonction permettant de récupérer le statutaire du login
	**/
	public function getStatutaire($login)
	{
		$query = $this->db->query('Select statutaire from enseignant where login ="'. $login .'"');
	
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				return $row->statutaire;
			}
		}else{
			
			return NULL;
		}
	}

	/**
	*	Fonction permettant de récupérer la decharge du login
	**/
	public function getDecharge($login)
	{
		$query = $this->db->query('Select decharge from decharge where enseignant ="'. $login .'"');

		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				return $row->decharge;
			}
		}else{
			
			return NULL;
		}
	}

	/**
	*	Fonction permettant de récupérer les heures d'une partie donnée dans un module donné de type CM
	**/
	public function getheureCMPartie($module, $partie)
	{
		$query = $this->db->query('SELECT hed from contenu where type = "CM" and partie = "'. $partie .'" and module ="'. $module .'"');
	
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					return $row->hed;
				} 

			}else{
				
				return NULL;
			}
	}

	/**
	*	Fonction permettant de récupérer les heures d'une partie donnée dans un module donné de type TD
	**/
	public function getheureTDPartie($module, $partie)
	{
		$query = $this->db->query('SELECT hed from contenu where type = "TD" and partie = "'. $partie .'" and module ="'. $module .'"');
	
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				return $row->hed;
			}
		}else{
			
			return NULL;
		}
	}

	/**
	*	Fonction permettant de récupérer les heures d'une partie donnée dans un module donné de type TP
	**/
	public function getheureTPPartie($module, $partie)
	{
		$query = $this->db->query('SELECT hed from contenu where type = "TP" and partie = "'. $partie .'" and module ="'. $module .'"');
	
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				return $row->hed;
			} 

		}else{
			
			return NULL;
		}
	}

	/**
	*	Fonction permettant de récupérer les heures d'une partie donnée dans un module donné de type Projet
	**/
	public function getheureProjetPartie($module, $partie)
	{
		$query = $this->db->query('SELECT hed from contenu where type = "Projet" and partie = "'. $partie .'" and module ="'. $module .'"');
	
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					return $row->hed;
				} 

			}else{
				
				return NULL;
			}
	}

	/**
	*	Fonction permettant de mettre à jour la table contenu avec de nouvelles informations concernant le login, le module et la partie
	**/
	public function updateContenuEnseignantPartie($login, $module, $partie)
	{
		$query = $this->db->query('UPDATE contenu set enseignant = "'. $login .'" where module ="'. $module .'" and partie = "'. $partie .'" ');
	
	}

	/**
	*	Fonction permettant de récupérer les heures de cours du login
	**/
	public function getHeuresEnseignant($login)
	{
		$query = $this->db->query('SELECT hed from contenu where enseignant ="'. $login .'"');
	
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			
			return NULL;
		}
	}

	/**
	*	Fonction permettant de récupérer le libelle et l'indentifiant d'un module
	**/
	public function getModule($module)
	{
		$query = $this->db->query('SELECT libelle, ident FROM module where ident="'. $module .'"');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}

	/**
	*	Fonction permettant de supprimer un enseignant d'une partie et par conséquent se dépositionner du cours
	**/
	public function supprimerEnseignantDePartie($partie, $module)
	{

		$query = $this->db->query('UPDATE contenu set enseignant = NULL where module ="'. $module .'" and partie = "'. $partie .'" ');
	
	}
}

?>