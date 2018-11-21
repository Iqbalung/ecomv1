<?php
class M_courier extends CI_Model{

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
			$this->db->like("courier_name",$args["f_search"]);
		}
		$db2 = clone $this->db;
		$data = $this->db->get('m_courier a', $limit, $start)->result_array();
		$count = $db2->get('m_courier a')->num_rows();

		return array('data' => $data, 'count' => $count);		
	}

	function get_all($args =  array())
	{	
		$res = $this->db->get('m_courier');		
		return $res;		
	}

    
	function add($args = array())
	{
		$res = $this->db->insert("m_courier",$args); 
		return $res;
	}

	function update($args = array())
	{
		$res = false;
		if (isset($args['courier_id']) && !empty($args['courier_id']))
		{
			$this->db->where("courier_id",$args['courier_id']);
			unset($args['courier_id']);		
			$res = $this->db->update("m_courier", $args);
		}
		return $res;
	}

	function delete ($args = array())
	{
		$res = false;
		if (isset($args['courier_id']) && !empty($args['courier_id']))
		{
			$this->db->where("courier_id",$args['courier_id']);
			unset($args['courier_id']);		
			$res = $this->db->delete("m_courier");
		}
		return $res;
	}
}