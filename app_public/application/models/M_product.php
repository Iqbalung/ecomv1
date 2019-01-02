<?php
class M_product extends CI_Model{

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
			$this->db->like("prod_name",$args["f_search"]);
		}
		$db2 = clone $this->db;
		$data = $this->db->get('product a', $limit, $start)->result_array();
		$count = $db2->get('product a')->num_rows();

		return array('data' => $data, 'count' => $count);		
	}

	function get_by($args =  array())
	{	
		
		if (is_array($args) && count($args) > 0)
		{
			$this->db->where($args);
		}	
		else
		{
			$this->db->where("1 = 2");
		}	

		$res = $this->db->get('product');

		return $res;		
	}

    
	function add($args = array())
	{
		$res = $this->db->insert("product",$args); 
		return $res;
	}

	function add_variant($args = array())
	{
		$res = $this->db->insert("product_varian",$args); 
		return $res;
	}

	function get_variant($args = array())
	{
		$this->db->where("prod_id",$args['prod_id']);
		$this->db->select("*,varian_value as text, varian_value as id");
		$res['data'] = $this->db->get("product_varian")->result_array(); 
		return $res;
	}

	function update_variant($args = array())
	{
		$this->db->where("varian_id",$args['varian_id']);
		unset($args['varian_id']);
		$res['data'] = $this->db->update("product_varian",$args); 
		return $res;
	}

	function delete_variant($args = array())
	{
		$this->db->where("varian_id",$args['varian_id']);
		$res['data'] = $this->db->delete("product_varian"); 
		return $res;
	}

	function update($args = array())
	{
		$res = false;
		if (isset($args['prod_id']) && !empty($args['prod_id']))
		{
			$this->db->where("prod_id",$args['prod_id']);
			unset($args['prod_id']);		
			$res = $this->db->update("product", $args);
		}
		return $res;
	}

	function delete ($args = array())
	{
		$res = false;
		if (isset($args['prod_id']) && !empty($args['prod_id']))
		{
			$this->db->where("prod_id",$args['prod_id']);
			unset($args['prod_id']);		
			$res = $this->db->delete("product");
		}
		return $res;
	}
}