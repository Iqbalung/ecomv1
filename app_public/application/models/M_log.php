<?php
class M_log extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function insertlog($params)
	{
		$res = $this->db->query("
			INSERT INTO SAKIP_LOG (TRXCAPTION)
			VALUES ('$params')
		");
		return $res;
	}
}