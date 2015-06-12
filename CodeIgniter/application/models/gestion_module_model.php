<?php
class Gestion_Module_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_modules()
	{
		$query = $this->db->query('Select * from module');
		return $query->result_array();
	}

	public function supprime_module($ident) {
		$this->db->query('Delete from contenu where module="'.$ident.'"');
		$this->db->query('Delete from module where ident="'.$ident.'"');
	}
}
?>
