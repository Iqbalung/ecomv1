<?php
class M_transaction_forstok extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_trx($args = array(), $is_pagging = false)
	{		
		$start = ifunsetempty($args,'start',0);
		$limit = ifunsetempty($args,'limit',$this->config->item("pagesize"));

		$this->db->select("
			trx.*,
			'' item,
			m_mos.mos_name,
			m_cr.courier_name,
			m_st.trx_state_flag,
			m_us.user_username
			");
		$this->db->join("m_mediasale m_mos","trx.trx_mos = m_mos.mos_id","LEFT");		
		$this->db->join("m_courier m_cr","trx.trx_courier = m_cr.courier_id","LEFT");
		$this->db->join("m_state_trx m_st","trx.trx_state_id = m_st.trx_state_id","LEFT");
		$this->db->join("trx_log t_lg","trx.trx_id = t_lg.trx_id AND trx.trx_state_id = t_lg.trx_log_caption","LEFT");
		$this->db->join("m_user m_us","t_lg.user_userid = m_us.user_userid","LEFT");

		if (isset($args["f_search"]) && !empty($args["f_search"]))
		{			
			$this->db->group_start();
			$this->db->or_like("m_mos.mos_name",$args["f_search"]);
			$this->db->or_like("trx.trx_id",$args["f_search"]);			
			$this->db->group_end();
		}

		if (isset($args["f_state"]) && !empty($args["f_state"]))
		{			
			$this->db->where("trx.trx_state_id",$args["f_state"]);			
		}

		if (isset($args["mos_id"]) && !empty($args["mos_id"]))
		{			
			$this->db->where("trx.trx_mos",$args["mos_id"]);			
		}

		if (isset($args["f_date_from"]) && !empty($args["f_date_from"]) && isset($args["f_date_to"]) && !empty($args["f_date_to"]))
		{			
			$this->db->group_start();
			$this->db->where("trx_date >= ",$args["f_date_from"]);
			$this->db->where("trx_date <= ",$args["f_date_to"]);
			$this->db->group_end();
		}

		if ($is_pagging)
		{
			$db2 = clone $this->db;
			$this->db->order_by('trx.trx_date', 'ASC');
			$data = $this->db->get("trx",$limit,$start)->result_array();
			$arr = array();
			foreach ($data as $key => $value) {
				$value['item'] =  $this->get_items($value)->result_array();
				$arr[] = $value;
			}		
			$count = $db2->get("trx")->num_rows();						

			return array('data' => $arr, 'count' => $count);			
		}
		else
		{
			$res = $this->db->get("trx");
			foreach ($res as $key => $value) {
				$value['item'] =  $this->get_items($value);
				$arr[] = $value;
			}	

			return $arr;
		}
	}

	function get_product($params){

		$where = '';
		if($params['prod_name']!=""){
			$where = "where prod_name = ? or prod_barcode = ?";		
		}
		$query = $this->db->query("
				SELECT *, concat(prod_name,'-',prod_barcode) prod_name FROM product $where
		",$params['prod_name'],$params['prod_name']);
		return $query;
	}

	function get_trx_all($args = array(), $is_pagging = false)
	{
		
		$start = ifunsetempty($args,'start',0);
		$limit = ifunsetempty($args,'limit',$this->config->item("pagesize"));

		$this->db->select("
			trx.*,
			'' item,
			ifnull(m_mos.mos_name,trx_type) mos_name,
			m_cr.courier_name,
			m_st.trx_state_flag,
			m_us.user_username
			");
		$this->db->join("m_mediasale m_mos","trx.trx_mos = m_mos.mos_id","LEFT");		
		$this->db->join("m_courier m_cr","trx.trx_courier = m_cr.courier_id","LEFT");
		$this->db->join("m_state_trx m_st","trx.trx_state_id = m_st.trx_state_id","LEFT");
		$this->db->join("trx_log t_lg","trx.trx_id = t_lg.trx_id AND trx.trx_state_id = t_lg.trx_log_caption","LEFT");
		$this->db->join("m_user m_us","t_lg.user_userid = m_us.user_userid","LEFT");

		if (isset($args["f_search"]) && !empty($args["f_search"]))
		{			
			$this->db->group_start();
			//$this->db->or_like("m_mos.mos_name",$args["f_search"]);
			$this->db->or_like("trx.trx_invoice",$args["f_search"]);			
			$this->db->group_end();
		}

		if (isset($args["f_type"]) && !empty($args["f_type"]))
		{			
			$this->db->where("trx.trx_type",$args["f_type"]);			
		}

		if (isset($args["f_date_from"]) && !empty($args["f_date_from"]) && isset($args["f_date_to"]) && !empty($args["f_date_to"]))
		{			
			$this->db->group_start();
			$this->db->where("trx_date >= ",$args["f_date_from"]);
			$this->db->where("trx_date <= ",$args["f_date_to"]);
			$this->db->group_end();
		}

		if ($is_pagging)
		{
			$db2 = clone $this->db;			
			
			$data = $this->db->get("trx",$limit,$start)->result_array();

			$arr = array();
			foreach ($data as $key => $value) {
				$value['item'] =  $this->get_items($value);
				$arr[] = $value;
			}
			$count = $db2->get("trx")->num_rows();						

			return array('data' => $arr, 'count' => $count);			
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

		if (isset($args["trx_id"]) && !empty($args["trx_id"]))
		{
			$this->db->where("trx.trx_id",$args["trx_id"]);	
			$this->db->select("
				trx.*,
				m_mos.mos_name,
				m_cr.courier_name,
				m_us.user_username

				");
			$this->db->join("m_mediasale m_mos","trx.trx_mos = m_mos.mos_id","LEFT");
			$this->db->join("m_courier m_cr","trx.trx_courier = m_cr.courier_id","LEFT");
			$this->db->join("m_user m_us","mus.user_userid = trx.user_userid","LEFT");
			//$this->db->where("trx.trx_type","auto");
			
			$res = $this->db->get("trx");
		}
		return $res;
	}

	function get_all_trx_by_id($args = array())
	{
		$res = false;

		if (isset($args["trx_id"]) && !empty($args["trx_id"]))
		{
			$this->db->where("trx.trx_id",$args["trx_id"]);	
			$this->db->select("
				trx.*,
				m_mos.mos_name,
				m_cr.courier_name,
				m_us.user_username
				");
			$this->db->join("m_mediasale m_mos","trx.trx_mos = m_mos.mos_id","LEFT");
			$this->db->join("m_courier m_cr","trx.trx_courier = m_cr.courier_id","LEFT");
			$this->db->join("m_user m_us","m_us.user_userid = trx.user_userid","LEFT");
			
			$res = $this->db->get("trx");
		}
		return $res;
	}

	function add_trx($args = array())
	{
		$res = $this->db->insert('trx', $args); 
		return $res;
	}

	function upd_trx($args = array())
	{
		$res = false;
		if (isset($args["trx_id"]) && !empty($args["trx_id"]))
		{
			$this->db->where("trx_id",$args["trx_id"]);	
			$res = $this->db->update('trx', $args); 
		}
		return $res;
	}

	function add_log($args = array())
	{
		$res = $this->db->insert('trx_log', $args); 
		return $res;
	}

	function get_items($args = array())
	{
		$res = false;

		if (isset($args["trx_id"]) && !empty($args["trx_id"]))
		{
			$this->db->where("ti.trxid",$args["trx_id"]);	
			$this->db->select("
				ti.*,
				prd.prod_name,
				prd.prod_total_gross_weight,
				(ti.prod_price * ti.item_qty) as sub_total
				");
			$this->db->join("product prd","ti.prod_id = prd.prod_id","LEFT");
			$this->db->join("m_category m_cat","ti.prod_category = m_cat.category_id","LEFT");
			$res = $this->db->get("trx_item ti");
		}
		return $res;
	}

	function add_item($args = array())
	{
		$res = $this->db->insert('trx_item', $args); 
		return $res;
	}

	function upd_item($args = array())
	{
		$res = false;
		if (isset($args["item_id"]) && !empty($args["item_id"]))
		{
			$this->db->where("item_id",$args["item_id"]);				
			$res = $this->db->update('trx_item', $args); 
		}
		return $res;
	}

	function get($params)
	{
		$this->db->where('PARENT_UID',$params);
		$res = $this->db->get('SAKIP_DOKUMEN'); 
		return $res;
	}

	function del($params)
	{
		$this->db->where($params);
		$res = $this->db->delete('SAKIP_DOKUMEN'); 
		return $res;
	}

	function get_cost($args = array())
	{
		$res = false;

		if (isset($args["trx_id"]) && !empty($args["trx_id"]))
		{
			$this->db->where("tc.trx_id",$args["trx_id"]);	
			$this->db->select("
				tc.*				
				");			
			$res = $this->db->get("trx_cost tc");
		}
		return $res;
	}

	function add_cost($args = array())
	{
		$res = $this->db->insert('trx_cost', $args); 
		return $res;
	}

	function upd_cost($args = array())
	{
		$res = false;
		if (isset($args["trx_cost_id"]) && !empty($args["trx_cost_id"]))
		{
			$this->db->where("trx_cost_id",$args["trx_cost_id"]);				
			$res = $this->db->update('trx_cost', $args); 
		}
		return $res;
	}

	function get_state($args = array())
	{
		$res = false;

		if (isset($args["trx_id"]) && !empty($args["trx_id"]))
		{
			$this->db->where("tl.trx_id",$args["trx_id"]);	
			$this->db->select("
				tl.*,
				mst.trx_state_caption
				");			
			$this->db->join("m_state_trx mst","tl.trx_log_caption = mst.trx_state_id","LEFT");
			$res = $this->db->get("trx_log tl");
		}
		return $res;
	}

	function check_product($args = array())
	{

		$where = " 1 = 1 ";
		$params = array();
		if(isset($args["prod_id"]) && !empty($args["prod_id"]))
		{
			$where .= " AND p.prod_id = ? ";			
			$params[] = $args["prod_id"];
		}

		$res = $this->db->query("
					select   p.prod_id,prod_name, category_name, '5' stock_awal, ifnull(inv.prod_stock,0) stock_masuk, ifnull(pnj.prod_stock,0) stock_penjualan,
					 ifnull(pny.prod_stock,0) stock_penyesuaian,
					ifnull(trf.prod_stock,0) stock_transfer, ifnull(((5+inv.prod_stock)-pnj.prod_stock),0) stock_akhir
					from product p
					left join m_category cat on p.category_id = cat.category_id 
					left join (
						select sum(ifnull(prod_stock,0)) prod_stock , prod_id from product_stock where 
						prod_flag_source = 'inventory' GROUP BY prod_id
					) inv on inv.prod_id = p.prod_id
					left join (
						select sum(ifnull(item_qty,0)) prod_stock , prod_id from trx_item  GROUP BY prod_id
					) pnj  on pnj.prod_id = p.prod_id
					left join (
						select sum(ifnull(prod_stock,0)) prod_stock , prod_id from product_stock where 
						prod_flag_source = 'transfer' 
					) trf on trf.prod_id = p.prod_id
					left join (
						select sum(ifnull(prod_stock,0)) prod_stock , prod_id from product_stock where 
						prod_flag_source = 'STOCKOPNAME' 
					) pny on pny.prod_id = p.prod_id
					WHERE $where
			",$params);

		return $res;
	}
}