<?php
class M_warehouse extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get($args =  array(),$is_pagging = false)
	{	

		$start = ifunsetempty($args,'start',0);
		$limit = ifunsetempty($args,'limit',10);
		if (isset($args["f_search"])) {
			$this->db->like("wr_name",$args["f_search"]);
		}

		if ($is_pagging) {			
			$db2 = clone $this->db;
			$data = $this->db->get('m_warehouse a', $limit, $start)->result_array();
			$count = $db2->get('m_warehouse a')->num_rows();

			return array('data' => $data, 'count' => $count);		
		}
		else
		{
			$res = $this->db->get("m_warehouse");
			return $res;
		}
	}

	function get_all($args =  array())
	{	
		$res = $this->db->get('m_warehouse');		
		return $res;		
	}

    
	function add($args = array())
	{
		$res = $this->db->insert("m_warehouse",$args); 
		return $res;
	}

	function update($args = array())
	{
		$res = false;
		if (isset($args['wr_id']) && !empty($args['wr_id']))
		{
			$this->db->where("wr_id",$args['wr_id']);
			unset($args['wr_id']);		
			$res = $this->db->update("m_warehouse", $args);
		}
		return $res;
	}

	function delete ($args = array())
	{
		$res = false;
		if (isset($args['wr_id']) && !empty($args['wr_id']))
		{
			$this->db->where("wr_id",$args['wr_id']);
			unset($args['wr_id']);		
			$res = $this->db->delete("m_warehouse");
		}
		return $res;
	}
}