<?php
class M_region extends CI_Model{

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
			$this->db->like("reg_name",$args["f_search"]);
		}
		$db2 = clone $this->db;
		$data = $this->db->get('m_region a', $limit, $start)->result_array();
		$count = $db2->get('m_region a')->num_rows();

		return array('data' => $data, 'count' => $count);		
	}

    
	function add($args = array())
	{
		$res = $this->db->insert("m_region",$args); 
		return $res;
	}

	function update($args = array())
	{
		$res = false;
		if (isset($args['reg_id']) && !empty($args['reg_id']))
		{
			$this->db->where("reg_id",$args['reg_id']);
			unset($args['reg_id']);		
			$res = $this->db->update("m_region", $args);
		}
		return $res;
	}

	function delete ($args = array())
	{
		$res = false;
		if (isset($args['reg_id']) && !empty($args['reg_id']))
		{
			$this->db->where("reg_id",$args['reg_id']);
			unset($args['reg_id']);		
			$res = $this->db->delete("m_region");
		}
		return $res;
	}
}