<?php

class affiche_module_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	} 
    
    public function estComplet($module){
        $query = $this->db->query("SELECT enseignant 
                                    FROM contenu 
                                    WHERE module='$module' 
                                    AND enseignant is null");
		if ($query->num_rows() > 0)
		{
			return 0;

		}else{
			return 1;
		}
    }

	/**
	*	Fonction permettant de récupérer l'identifiant et le libelle d'un module
	**/
	public function getModule($module)
	{
		$query = $this->db->query('SELECT ident,libelle FROM module where ident="'. $module .'"');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}

	/**
	*	Fonction permettant de récupérer les cours(partie, heures, type) et nom et prénom d'un enseignant d'un module donné
	**/
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

	/**
	*	Fonction permettant de récupérer le nom et prénom du responsable d'un module
	**/
	public function getResponsable($module)
	{
		$query = $this->db->query('SELECT nom, prenom from enseignant, module where login=responsable and ident="'. $module .'"');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}
    
    /**
	*	Fonction permettant de récupérer la filière associée à un module donné
	**/
    public function getFiliere($module)
	{
		$query = $this->db->query('SELECT public from module where ident="'. $module .'"');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}

	/**
	*	Fonction permettant de récupérer la somme des heure d'un cours de type CM pour un module donné
	**/
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

	/**
	*	Fonction permettant de récupérer la somme des heure d'un cours de type TD pour un module donné
	**/
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

	/**
	*	Fonction permettant de récupérer la somme des heure d'un cours de type TP pour un module donné
	**/
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

	/**
	*	Fonction permettant de récupérer la somme des heure d'un cours de type Projet pour un module donné
	**/
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

	/**
	*	Fonction permettant de récupérer l'identifiant, le libellé, la filière, le semestre et le responsable de tout les modules
	**/
	public function getListeModules()
	{
		$query = $this->db->query('SELECT ident,libelle,public,semestre,responsable FROM module order by libelle');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();

		}else{
			return NULL;
		}
	}

	/**
	*	Fonction permettant de récupérer la somme des heures des cours disponibles pour un module donné
	**/
	public function getcoursdispo($module){
            $query = $this->db->query('SELECT sum(hed) from contenu where module = "'. $module .'" and enseignant is null');
            if ($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                return NULL;
            }
        }

    /**
	*	Fonction permettant de récupérer la somme des heures des cours pris pour un module donné
	**/
    public function getcourspris($module){
            $query = $this->db->query('SELECT sum(hed) from contenu where module = "'. $module .'" and enseignant is not null');
            if ($query->num_rows() > 0)
            {
                return $query->result_array();
            }
            else
            {
                return NULL;
            }
      
        }

}

?>
