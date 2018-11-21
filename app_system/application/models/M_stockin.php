<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stockin extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($params)
	{
		$where = '';
		
		$res = $this->db->query("
			SELECT  prod_name, category_name, '' stock_awal, inv.prod_stock stock_masuk, pnj.prod_stock stock_penjualan,
		 pny.prod_stock stock_penyesuaian,
		trf.prod_stock stock_transfer, (inv.prod_stock-(pnj.prod_stock-pny.prod_stock)) stock_akhir
		from product p
		left join m_category cat on p.category_id = cat.category_id 
		left join (
			select sum(ifnull(prod_stock,0)) prod_stock , prod_id from product_stock where 
			prod_flag_source = 'inventory' 
		) inv on inv.prod_id = p.prod_id
		left join (
			select sum(ifnull(item_qty,0)) prod_stock , prod_id from trx_item 
		) pnj  on pnj.prod_id = p.prod_id
		left join (
			select sum(ifnull(prod_stock,0)) prod_stock , prod_id from product_stock where 
			prod_flag_source = 'transfer' 
		) trf on trf.prod_id = p.prod_id
		left join (
			select sum(ifnull(prod_stock,0)) prod_stock , prod_id from product_stock where 
			prod_flag_source = 'penyesuaian' 
		) pny on pny.prod_id = p.prod_id 

		");
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