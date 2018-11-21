<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stockopname extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($args = array(),$is_pagging = false)
	{
		$start = ifunsetempty($args,'start',0);
		$limit = ifunsetempty($args,'limit',$this->config->item("pagesize"));

		$this->db->select("
			prd.*,
			m_wr.wr_id,
			m_wr.wr_name,
			sum(prd_stk.prod_stock) total_stock
			");
		$this->db->join("product_stock prd_stk","prd.prod_id = prd_stk.prod_id","LEFT");		
		$this->db->join("m_warehouse m_wr","prd_stk.wr_id = m_wr.wr_id","LEFT");
		$this->db->group_by("
			prd.prod_id,
			prd_stk.wr_id
			");
		if ($is_pagging)
		{
			$db2 = clone $this->db;
									
			$data = $this->db->get("product prd",$limit,$start)->result_array();			
			$count = $db2->get("product prd")->num_rows();						

			return array('data' => $data, 'count' => $count);			
		}
		else
		{
			$res = $this->db->get("product prd");

			return $res;
		}
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