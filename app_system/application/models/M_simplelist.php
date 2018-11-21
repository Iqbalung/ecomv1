<?php
class M_simplelist extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function get($args = array())
	{
		$res = false;
		if (isset($args["flag"]) && !empty($args["flag"]))
		{
			if(is_array($args["flag"]) && count($args["flag"]) > 0)
			{
				$this->db->where_in("list_flag",$args["flag"]);
			}
			else
			{
				$this->db->where("list_flag",$args["flag"]);
			}
			$res = $this->db->get("simplelist");
		}
		return $res;
	}

	function get_state_trx($args = array())
	{
		
		$res = $this->db->get("m_state_trx");		
		return $res;
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