<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hukumpedia extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($params=array()){
		$this->db->select('hukumpedia.*,produk_hukum.nama,produk_hukum.kode_warna');
		if(isset($params['id'])){
			$this->db->where('hukumpedia.id',$params['id']);
		}
		if(isset($params['urusan_id'])){
			$this->db->like('hukumpedia.urusan_id','|'.$params['urusan_id'].'|');
		}
		if(isset($params['produk_hukum_id'])){
			$this->db->where('hukumpedia.produk_hukum_id',$params['produk_hukum_id']);
		}
		if(isset($params['cari'])){
			$this->db->group_start();
			$this->db->like('hukumpedia.tentang',$params['cari']);
			$this->db->or_like('hukumpedia.deskripsi',$params['cari']);
			$this->db->group_end();
		}
		$this->db->join('produk_hukum','hukumpedia.produk_hukum_id=produk_hukum.id');
		$this->db->where('publikasi',1);
		$res = $this->db->get('hukumpedia');
		return $res;
	}

	public function get_produk_hukum_count($params=array()){
		$this->db->select('produk_hukum.*,count(hukumpedia.id) jml');
		$this->db->join('produk_hukum','hukumpedia.produk_hukum_id=produk_hukum.id');
		$this->db->group_by('produk_hukum.id');
		$this->db->where('publikasi',1);
		$res = $this->db->get('hukumpedia');
		return $res;
	}
	
	function get_urusan_count($params=array()){
		$this->db->select('urusan.*,count(hukumpedia.id) jml');
		$this->db->join('urusan',"urusan_id LIKE CONCAT('%|', urusan.id, '|%')");
		$this->db->group_by('urusan.id');
		$this->db->where('publikasi',1);
		$res = $this->db->get('hukumpedia');
		return $res;
	}
	
	function get_urusan_by_id($id){
		$res = $this->db->query("SELECT urusan.* FROM hukumpedia
			 join urusan
			 where
			 hukumpedia.id = ?
			 AND hukumpedia.urusan_id LIKE CONCAT('%|', urusan.id, '|%') ",array($id));
		return $res;
	}
}

/* End of file M_hukumpedia.php */
/* Location: ./application/models/M_hukumpedia.php */