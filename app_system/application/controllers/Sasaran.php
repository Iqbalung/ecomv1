<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sasaran extends MY_Controller{
	function __construct()
    {
		parent::__construct();
		$this->load->model(array('M_sasaran','M_log','M_indikatorsasaran','M_programsasaran'));
	}
	
	function get_sasasranbysatker()
	{
		$params = array(
			'ID_SATKER' => ifunsetempty($_POST,'ID_SATKER',''),
			'TAHUN_SASARAN' => $this->session->userdata('tahun'),
			'TIPE' => $this->session->userdata('tahun'),
		);

		$res = $this->M_sasaran->get($params)->result_array();
		echo json_encode($res);
	}

	function get_targetby(){
		$params = array(
			'ID_SATKER' => ifunsetempty($_POST,'ID_SATKER',''),
			'TAHUN_SASARAN' => $this->session->userdata('tahun'),
		);
		$res = $this->M_sasaran->get_targetby($params)->result_array();
		$data = array();
		foreach ($res as $key => $value) {
			$value['JUMLAH'] =  number_format($value['JUMLAH'], 0 , '' , '.' );
			$data[] = $value;
		}
		echo json_encode($data);
	}

	function get_indikatorsasaran(){
		$params = array(
			'ID_SASARAN' => ifunsetempty($_POST,'ID_SASARAN',''),
			'TAHUN' => $this->session->userdata('tahun'),
			'TIPE' => ifunsetempty($_POST,'TIPE','')
		);
		
		$res = $this->M_indikatorsasaran->get_indikatorsasaran($params)->result_array();
		/*$avg_target 	= $this->M_indikatorsasaran->get_avgindikatorsasaran($params)->row();
		$avg_realisasi	= $this->M_indikatorsasaran->get_avgindikatorsasaran($params)->row();
		$avg_tantangan	= $this->M_indikatorsasaran->get_avgindikatorsasaran($params)->row();*/
		$data = array(
			'data' => $res,
			'avg_target' => $this->M_indikatorsasaran->get_avgindikatorsasaran($params)->row('AVG'),
			'avg_realisasi' => $this->M_indikatorsasaran->get_avgrealisasiindikatorsasaran($params)->row('AVG'),
			'avg_tantangan' => "",
		);
		echo json_encode($data);
	}

	function get_indikatorsasaranbysatker(){
		$params = array(
			'ID_SATKER' => ifunsetempty($_POST,'ID_SATKER',''),
			'TAHUN' => $this->session->userdata('tahun'),
			'TIPE' => ifunsetempty($_POST,'TIPE','')
		);
		$res = $this->M_indikatorsasaran->get_indikatorsasaranbysatker($params)->result_array();
		/*$avg_target 	= $this->M_indikatorsasaran->get_avgindikatorsasaran($params)->row();
		$avg_realisasi	= $this->M_indikatorsasaran->get_avgindikatorsasaran($params)->row();
		$avg_tantangan	= $this->M_indikatorsasaran->get_avgindikatorsasaran($params)->row();*/
		$data = array(
			'data' => $res,
			'avg_target' => $this->M_indikatorsasaran->get_avgindikatorsasaranbysatker($params)->row('AVG'),
			'avg_realisasi' => $this->M_indikatorsasaran->get_avgrealisasiindikatorsasaranbysatker($params)->row('AVG'),
			'avg_tantangan' => "",
		);
		echo json_encode($data);
	}

	function save(){
		$uid = $this->gen_uuid();
		$master = array(
			'ID_SASARAN' => ifunsetempty($_POST, 'id',''),
			'NAMA_SASARAN' => ifunsetempty($_POST, 'sasaran',''),
			'STRATEGI_SASARAN' => ifunsetempty($_POST,'strategi',''),
			'ID_SATKER' => ifunsetempty($_POST, 'ID_SATKER',''),
		);
		$log = "save sasaran manual";
		if($master['ID_SASARAN']==""){
			$master['ID_SASARAN'] = $uid;
			$master['TAHUN_SASARAN'] = $this->session->userdata('tahun');
			$map = array(
				'ID_SASARAN' => $uid,
				'ID_SATKER' => ifunsetempty($_POST, 'ID_SATKER',''),
			);
			$log = $this->M_log->insertlog($log);
			$res = $this->M_sasaran->add($master);
			
		}else{
			$res = $this->M_sasaran->upd($master);
		}
		if($res){
			$out = array(
						'success' => true,
						'msg' => 'Berhasil Memperbaharui',
			);
		}
		echo json_encode($out);
	}


	function del(){
		$params = array(
			'ID_SATKER' => ifunsetempty($_POST,'ID_SATKER',''),
		);
		$params['ID_SATKER'] = str_replace('_anchor', '', $params['ID_SATKER']);
		$res = $this->M_satker->del($params);
		if($res){
					$out = array(
						'success' => true,
						'msg' => 'Berhasil Menghapus' 
					);
				}
		echo json_encode($out);
	}

	function gen_uuid() {
	    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
	        // 32 bits for "time_low"
	        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

	        // 16 bits for "time_mid"
	        mt_rand( 0, 0xffff ),

	        // 16 bits for "time_hi_and_version",
	        // four most significant bits holds version number 4
	        mt_rand( 0, 0x0fff ) | 0x4000,

	        // 16 bits, 8 bits for "clk_seq_hi_res",
	        // 8 bits for "clk_seq_low",
	        // two most significant bits holds zero and one for variant DCE1.1
	        mt_rand( 0, 0x3fff ) | 0x8000,

	        // 48 bits for "node"
	        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
	    );
	}
}
