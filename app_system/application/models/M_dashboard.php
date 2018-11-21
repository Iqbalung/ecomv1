<?php
class M_dashboard extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_grafik_penjualan_harian($date1, $date2) {
		return $this->db->query("
			SELECT selected_date, IFNULL (  SUM(a.total), 0) total_transaksi_harian FROM 
			(SELECT ADDDATE('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date FROM
			 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t0,
			 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1,
			 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2,
			 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3,
			 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4) v
			LEFT JOIN (
				
				SELECT trx.trx_id, trx.trx_date,IFNULL(SUM(prod_price*item_qty) + IFNULL(MAX(trx_cost_estimation_price),0) ,0) total 
				FROM trx
				LEFT JOIN trx_item ON trx_item.trxid = trx.trx_id
				LEFT JOIN trx_cost ON trx_cost.trx_id = trx.trx_id AND trx_cost_type = 'shipping'
				WHERE trx.trx_state_id = 'completed'
				GROUP BY trx.trx_id,trx.trx_date
				
			) a ON a.trx_date =  selected_date
			WHERE selected_date BETWEEN ? AND ?
			GROUP BY selected_date
			ORDER BY selected_date
		", array($date1,$date2));
	}


	function get_total_uang_masuk($date1,$date2) {
		return $this->db->query("
		SELECT SUM(a.total_transaksi_harian) jml FROM (		
		SELECT selected_date, IFNULL (  SUM(a.total), 0) total_transaksi_harian FROM 
			(SELECT ADDDATE('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date FROM
			 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t0,
			 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t1,
			 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t2,
			 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t3,
			 (SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) t4) v
			LEFT JOIN (
				
				SELECT trx.trx_id, trx.trx_date,IFNULL(SUM(prod_price*item_qty ) + IFNULL(MAX(trx_cost_estimation_price),0) ,0) total 
				FROM trx
				LEFT JOIN trx_item ON trx_item.trxid = trx.trx_id
				LEFT JOIN trx_cost ON trx_cost.trx_id = trx.trx_id AND trx_cost_type = 'shipping'
				WHERE trx.trx_state_id = 'completed'
				GROUP BY trx.trx_id,trx.trx_date
				
			) a ON a.trx_date =  selected_date
			WHERE selected_date BETWEEN ? AND ?
			GROUP BY selected_date) a
		", array ($date1,$date2));
	}

	function get_total_pengeluaran($date1,$date2) {
		return $this->db->query("
		SELECT (SUM(trx_cost.trx_cost_price) + SUM( trx_item.buy_price*trx_item.item_qty )) jml 
		FROM trx
		left JOIN trx_item ON trx_item.trxid = trx.trx_id
		left join trx_cost on trx_cost.trx_id =  trx.trx_id
		where trx.trx_date BETWEEN ? AND ?
		", array ($date1,$date2));
	}


	function get_jumlahtransaksi ($date) {
		return $this->db->query("
			SELECT COUNT(*) jml FROM TRX where    trx_date = ? ", array($date));
	}

	function get_jumlahtransaksi_range ($date1, $date2) {
		return $this->db->query("
			SELECT COUNT(*) jml FROM TRX where    trx_date BETWEEN ? AND ? ", array($date1,$date2));
	}

	function get_produk_tertinggi ($date1, $date2) {

		return $this->db->query("
			SELECT SUM(item_qty) jml_trx, product.prod_name_short FROM product
			JOIN trx_item ON trx_item.prod_code = product.prod_code  
			JOIN trx ON trx.trx_id = trx_item.trxid
			WHERE  trx.`trx_state_id` = 'completed' and  trx.`trx_date` BETWEEN ? AND ?
			GROUP BY product.prod_name_short
			ORDER BY SUM(item_qty) DESC
		", array ($date1, $date2));
	}

	function get_kategori_tertinggi ($date1, $date2) {

		return $this->db->query("
			SELECT SUM(item_qty) jml_trx, m_category.category_name , m_category.category_id
			FROM product
			JOIN trx_item ON trx_item.prod_code = product.prod_code  
			JOIN trx ON trx.trx_id = trx_item.trxid  
			LEFT JOIN m_category ON m_category.`category_id` = product.`category_id` 
			WHERE trx.`trx_state_id` = 'completed' and trx.`trx_date` BETWEEN ? AND ?
			GROUP BY m_category.category_name, m_category.category_id
			ORDER BY SUM(item_qty) DESC
		", array ($date1, $date2));
	}

	function get_mediasale($date1, $date2) {

		return $this->db->query("
			SELECT IFNULL (m_mediasale.`mos_name`, 'Transaksi Langsung') nama ,SUM(trx_item.`item_qty`) jml FROM trx 
			LEFT JOIN trx_item ON  trx_item.`trxid` = trx.`trx_id`
			LEFT JOIN m_mediasale ON m_mediasale.`mos_id` = trx.`trx_invoice_mos` 
			WHERE trx.`trx_state_id` = 'completed' and  trx.`trx_date` BETWEEN ? AND ?
			GROUP BY   m_mediasale.`mos_name`
			ORDER BY SUM(trx_item.`item_qty`) DESC
		", array ($date1, $date2));
	}

}