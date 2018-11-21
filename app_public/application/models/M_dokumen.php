<?php
class M_dokumen extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function add($params)
	{
		$res = $this->db->insert('SAKIP_DOKUMEN', $params); 
		return $res;
	}

	function get($params)
	{
		$this->db->where('PARENT_UID',$params);
		$res = $this->db->get('SAKIP_DOKUMEN'); 
		return $res;
	}

	function del($params)
	{
		$this->db->where($params);
		$res = $this->db->delete('SAKIP_DOKUMEN'); 
		return $res;
	}
}