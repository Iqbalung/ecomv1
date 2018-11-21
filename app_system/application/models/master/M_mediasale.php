<?php
class M_mediasale extends CI_Model{

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
			$this->db->like("mos_name",$args["f_search"]);
		}
		$db2 = clone $this->db;
		$data = $this->db->get('m_mediasale a', $limit, $start)->result_array();
		$count = $db2->get('m_mediasale a')->num_rows();

		return array('data' => $data, 'count' => $count);		
	}

	function get_all($args =  array())
	{	
		$res = $this->db->get('m_mediasale');		
		return $res;		
	}
    
	function add($args = array())
	{
		$res = $this->db->insert("m_mediasale",$args); 
		return $res;
	}

	function update($args = array())
	{
		$res = false;
		if (isset($args['mos_id']) && !empty($args['mos_id']))
		{
			$this->db->where("mos_id",$args['mos_id']);
			unset($args['mos_id']);		
			$res = $this->db->update("m_mediasale", $args);
		}
		return $res;
	}

	function delete ($args = array())
	{
		$res = false;
		if (isset($args['mos_id']) && !empty($args['mos_id']))
		{
			$this->db->where("mos_id",$args['mos_id']);
			unset($args['mos_id']);		
			$res = $this->db->delete("m_mediasale");
		}
		return $res;
	}
}