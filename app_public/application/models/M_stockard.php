<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stockard extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($params)
	{
		$where = '';
		if(strlen($params['f_search'])>2){
			$where = "where p.prod_name  like ? ";
		}
		$res = $this->db->query("
			select  prod_name, category_name, p.prod_stock_start stock_awal, ifnull(inv.prod_stock,0) stock_masuk, ifnull(pnj.prod_stock,0) stock_penjualan,
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

		$where

		",array("%".$params['f_search']."%"));
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