<?php

class Choisir_cours_model extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}

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

	public function updateContenuEnseignantPartie($login, $module, $partie)
	{
		$query = $this->db->query('UPDATE contenu set enseignant = "'. $login .'" where module ="'. $module .'" and partie = "'. $partie .'" ');
	
	}

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

	public function supprimerEnseignantDePartie($partie, $module)
	{

		print_r('UPDATE contenu set enseignant = NULL where module ="'. $module .'" and partie = "'. $partie .'" ');
		$query = $this->db->query('UPDATE contenu set enseignant = NULL where module ="'. $module .'" and partie = "'. $partie .'" ');
	
	}
}

?>