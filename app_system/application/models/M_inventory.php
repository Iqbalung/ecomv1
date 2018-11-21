<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_inventory extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($args = array(), $is_pagging = false)
	{
		$start = ifunsetempty($args,'start',0);
		$limit = ifunsetempty($args,'limit',$this->config->item("pagesize"));
		$where = '';
		if(strlen($args['f_search'])>0){
			$where = "$where and ( suplier_name like '%".$args['f_search']."%') or ( buy_id like '%".$args['f_search']."%') ";
		}
		if(strlen($args['f_date_from'])>0){
			$where = "$where and buy_datecreated >= '".$args['f_date_from']."'";
		}

		if(strlen($args['f_date_to'])>0){
			$where = "$where and buy_datecreated <= '".$args['f_date_to']."'";
		}

		$res = $this->db->query("
			select * from product_buy pb
			left join m_suplier s on pb.suplier_id = s.suplier_id
			$where

		");
		if ($is_pagging)
		{
			$db2 = clone $this->db;			
			$data =$res = $this->db->query("
			select *, ifnull(suplier_name,buy_id) suplier_name from product_buy pb
			left join m_suplier s on pb.suplier_id = s.suplier_id
			where buy_id is not null
			$where
			LIMIT $start,$limit

		")->result_array();			
			$count = $db2->get("trx")->num_rows();						

			return array('data' => $data, 'count' => $count);			
		}
		else
		{
			$res = $this->db->get("trx");

			return $res;
		}
	}

	function get_trx_by_id($args = array())
	{
		$res = false;
		if (isset($args["buy_id"]) && !empty($args["buy_id"]))
		{
			$this->db->where("product_buy.buy_id",$args["buy_id"]);	
			$this->db->select("
					product_buy.*,
					ms.suplier_name,
				");
			$this->db->join("m_suplier ms","product_buy.suplier_id = ms.suplier_id","LEFT");
			$res = $this->db->get("product_buy");
		}
		return $res;
	}

	function get_items($args = array())
	{
		$res = false;

		if (isset($args["buy_id"]) && !empty($args["buy_id"]))
		{
			$this->db->where("ti.buy_id",$args["buy_id"]);	
			$this->db->select("
				ti.*,
				prd.prod_name,
				ti.buy_price,
				(ti.buy_price * ti.prod_stock) as sub_total
				");
			$this->db->join("product prd","ti.prod_id = prd.prod_id","LEFT");
			$this->db->join("m_category m_cat","prd.category_id = m_cat.category_id","LEFT");
			$res = $this->db->get("product_stock ti");
		}
		return $res;
	}

	function get_cost($args = array())
	{
		$res = false;

		if (isset($args["buy_id"]) && !empty($args["buy_id"]))
		{
			$this->db->where("tc.trx_id",$args["buy_id"]);	
			$this->db->select("
				tc.*				
				");			
			$res = $this->db->get("trx_cost tc");
		}
		return $res;
	}

	function get_state($args = array())
	{
		$res = false;

		if (isset($args["buy_id"]) && !empty($args["buy_id"]))
		{
			$this->db->where("tl.trx_id",$args["buy_id"]);	
			$this->db->select("
				tl.*,
				mst.trx_state_caption
				");			
			$this->db->join("m_state_trx mst","tl.trx_log_caption = mst.trx_state_id","LEFT");
			$res = $this->db->get("buy_log tl");
		}
		return $res;
	}

	public function add($params)
	{
		$res = $this->db->insert('SAKIP_MST_TANTANGAN', $params);

		return $res;
	}

	public function upd($params)
	{
		$this->db->where('ID_TANTANGAN', $params['ID_TANTANGAN']);
		$res = $this->db->update('SAKIP_MST_TANTANGAN', $params);

		return $res;
	}

	public function del($params)
	{
		$res = $this->db->delete('SAKIP_MST_TANTANGAN', $params);

		return $res;
	}

}

/* End of file M_tantangan.php */
/* Location: ./application/models/M_tantangan.php */