<?php
class M_cetak extends CI_Model{

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
		$this->db->where("trx.trx_type","auto");
		if ($is_pagging)
		{
			$db2 = clone $this->db;			
			$data = $this->db->get("trx",$limit,$start)->result_array();			
			$count = $db2->get("trx")->num_rows();						

			return array('data' => $data, 'count' => $count);			
		}
		else
		{
			$res = $this->db->get("trx");

			return $res;
		}
	}

	function get_trx_all($args = array(), $is_pagging = false)
	{
		$start = ifunsetempty($args,'start',0);
		$limit = ifunsetempty($args,'limit',$this->config->item("pagesize"));


		$this->db->select("
			trx.*,
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
		if ($is_pagging)
		{
			$db2 = clone $this->db;			
			$data = $this->db->get("trx",$limit,$start)->result_array();			
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

		if (isset($args["trx_id"]) && !empty($args["trx_id"]))
		{
			$this->db->where("trx.trx_id",$args["trx_id"]);	
			$this->db->select("
				trx.*,
				m_mos.mos_name,
				m_cr.courier_name
				");
			$this->db->join("m_mediasale m_mos","trx.trx_mos = m_mos.mos_id","LEFT");
			$this->db->join("m_courier m_cr","trx.trx_courier = m_cr.courier_id","LEFT");
			// $this->db->where("trx.trx_type","auto");
			
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
				prd.prod_desc,
				(ti.prod_price * ti.item_qty) as sub_total
				");
			$this->db->join("product prd","ti.prod_code = prd.prod_code","LEFT");
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
}