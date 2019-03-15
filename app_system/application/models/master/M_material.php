<?php
class M_material extends CI_Model{

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
			$this->db->like("material_name",$args["f_search"]);
		}
		$db2 = clone $this->db;
		$data = $this->db->get('m_material a', $limit, $start)->result_array();
		$count = $db2->get('m_material a')->num_rows();

		return array('data' => $data, 'count' => $count);		
	}

    
	function add($args = array())
	{
		$res = $this->db->insert("m_material",$args); 
		return $res;
	}

	function update($args = array())
	{
		$res = false;
		if (isset($args['material_id']) && !empty($args['material_id']))
		{
			$this->db->where("material_id",$args['material_id']);
			unset($args['material_id']);		
			$res = $this->db->update("m_material", $args);
		}
		return $res;
	}

	function delete ($args = array())
	{
		$res = false;
		if (isset($args['material_id']) && !empty($args['material_id']))
		{
			$this->db->where("material_id",$args['material_id']);
			unset($args['material_id']);		
			$res = $this->db->delete("m_material");
		}
		return $res;
	}
}