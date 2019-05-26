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
		$where = "";
		$sort = "";
		if (isset($args["f_search"]) && $args["f_search"]!="") {
			$where = "$where and prod_name like '%".$args["f_search"]."%'";
		}
		if (isset($args["f_type"]) && $args["f_type"]!="") {
			$where = " $where  and prod_kind = '".$args["f_type"]."'";
		}

		if (isset($args["f_category"]) && $args["f_category"]!="") {
			$where = " $where  and product.category_id = '".$args["f_category"]."'";
		}

		if(isset($args['f_sort']) && $args['f_sort']!=""){
			$sort = "ORDER BY ".$args['f_sort']." ".$args['f_sort_type'];
		}



		$db2 = clone $this->db;
		$data = $this->db->query("select *, replace(lower(product.prod_name),' ','-') as slug from product left join (select * from document ORDER BY sort asc ) as d on product.prod_id = d.doc_parentid where 1=1 $where group by product.prod_id $sort", $limit, $start)->result_array();
		$count = $db2->get('product a')->num_rows();

		return array('data' => $data, 'count' => $count);		
	}

	function get_variant($args = array())
	{
		$this->db->where("prod_id",$args['prod_id']);
		$this->db->select("*,varian_value as text, varian_value as id");
		$res['data'] = $this->db->get("product_varian")->result_array(); 
		return $res;
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

		$this->db->select("*,FORMAT(prod_price, 0) AS prod_price_text");
		$this->db->join('m_category', 'product.category_id = m_category.category_id', 'left');
		$this->db->join('(select * from document ORDER BY sort asc limit 1 ) as d', 'product.prod_id = d.doc_parentid', 'left');
		$res = $this->db->get('product');

		return $res;		
	}

	function get_by_slug($args =  array())
	{	

		
		if (is_array($args) && count($args) > 0)
		{
			$this->db->where("replace(lower(product.prod_name),' ','-') = '".$args['prod_name']."'");
		}	
		else
		{
			$this->db->where("1 = 2");
		}	

		$this->db->select("*,FORMAT(prod_price, 0) AS prod_price_text");
		$this->db->join('m_category', 'product.category_id = m_category.category_id', 'left');
		$this->db->join('(select * from document ORDER BY sort asc limit 1 ) as d', 'product.prod_id = d.doc_parentid', 'left');
		$res = $this->db->get('product');

		return $res;		
	}

    
	function add($args = array())
	{
		$res = $this->db->insert("product",$args); 
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