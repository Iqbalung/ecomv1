<?php
class M_dokumen extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function add($params)
	{
		$res = $this->db->insert('document', $params); 
		return $res;
	}

	function get_where($args)
	{
		$this->db->where($args);
		$res = $this->db->get('document'); 
		return $res;
	}

	function del($params)
	{
		$this->db->where($params);
		$res = $this->db->delete('document'); 
		return $res;
	}
}