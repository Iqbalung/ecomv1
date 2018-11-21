<?php
class M_suplier extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get($args =  array())
	{	

		$start = ifunsetempty($args,'start',0);
		$limit = ifunsetempty($args,'limit',10);
		if (isset($args["f_search"])) {
			$this->db->or_like("suplier_name",$args["f_search"]);
			$this->db->or_like("suplier_phone",$args["f_search"]);
			$this->db->or_like("suplier_address",$args["f_search"]);
		}
		$db2 = clone $this->db;
		$data = $this->db->get('m_suplier a', $limit, $start)->result_array();
		$count = $db2->get('m_suplier a')->num_rows();

		return array('data' => $data, 'count' => $count);		
	}

    
	function add($args = array())
	{
		$res = $this->db->insert("m_suplier",$args); 
		return $res;
	}

	function update($args = array())
	{
		$res = false;
		if (isset($args['suplier_id']) && !empty($args['suplier_id']))
		{
			$this->db->where("suplier_id",$args['suplier_id']);
			unset($args['suplier_id']);		
			$res = $this->db->update("m_suplier", $args);
		}
		return $res;
	}

	function delete ($args = array())
	{
		$res = false;
		if (isset($args['suplier_id']) && !empty($args['suplier_id']))
		{
			$this->db->where("suplier_id",$args['suplier_id']);
			unset($args['suplier_id']);		
			$res = $this->db->delete("m_suplier");
		}
		return $res;
	}
}