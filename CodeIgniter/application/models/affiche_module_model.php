<?php

class affiche_module_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	} 

	public function getModule($module)
	{
		$query = $this->db->query('SELECT libelle FROM module where ident="'. $module .'"');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}

	public function getCourses($module)
	{
		$query = $this->db->query('SELECT nom, prenom, partie, hed, type from contenu left join enseignant on login=enseignant where module="'. $module .'" order by partie');
	
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}

	public function getResponsableANDFiliere($module)
	{
		$query = $this->db->query('SELECT nom, prenom, public from enseignant, module where login=responsable and ident="'. $module .'"');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}


	public function getHeuresCM($module)
	{
		$query = $this->db->query('SELECT sum(hed) from contenu, module where module=ident and module="'. $module .'" and type="CM" order by hed');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}

	public function getHeuresTD($module)
	{
		$query = $this->db->query('SELECT sum(hed) from contenu, module where module=ident and module="'. $module .'" and type="TD" order by hed');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}

	public function getHeuresTP($module)
	{
		$query = $this->db->query('SELECT sum(hed) from contenu, module where module=ident and module="'. $module .'" and type="TP" order by hed');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}

	public function getHeuresProjet($module)
	{
		$query = $this->db->query('SELECT sum(hed) from contenu, module where module=ident and module="'. $module .'" and type="projet" order by hed');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}	
	}

	public function getListeModules()
	{
		$query = $this->db->query('SELECT ident,libelle FROM module order by libelle');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}

}

?>