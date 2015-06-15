<?php
class Gestion_Module_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
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
}
?>
