<?php
class M_category extends CI_Model{

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
			$this->db->like("category_name",$args["f_search"]);
		}
		$db2 = clone $this->db;
		$data = $this->db->get('m_category a', $limit, $start)->result_array();
		$count = $db2->get('m_category a')->num_rows();

		return array('data' => $data, 'count' => $count);		
	}

    
	function add($args = array())
	{
		$res = $this->db->insert("m_category",$args); 
		return $res;
	}

	function update($args = array())
	{
		$res = false;
		if (isset($args['category_id']) && !empty($args['category_id']))
		{
			$this->db->where("category_id",$args['category_id']);
			unset($args['category_id']);		
			$res = $this->db->update("m_category", $args);
		}
		return $res;
	}

	function delete ($args = array())
	{
		$res = false;
		if (isset($args['category_id']) && !empty($args['category_id']))
		{
			$this->db->where("category_id",$args['category_id']);
			unset($args['category_id']);		
			$res = $this->db->delete("m_category");
		}
		return $res;
	}
}