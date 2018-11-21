<?php
class M_indikatorsasaran extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get_indikatorsasaran($params){
		$q = $this->db->query("
			SELECT
			(TRIWULAN_1 + TRIWULAN_2 + TRIWULAN_3 + TRIWULAN_4) AS TOTAL,
			ID_SASARAN,
			KODE_INDIKATORSASARAN,
			NAMA_INDIKATOR,
			RKPDID,
			FORMULA_INDIKATOR,
			TARGET_INDIKATOR,
			TRIWULAN_4,
			TIPE,
			KODE_PROGRAM,
			REALISASI_INDIKATOR,
			TAHUN,
			RKPDID_SASARAN,
			SATUAN_INDIKATOR,
			TRIWULAN_1,
			TRIWULAN_2,
			TRIWULAN_3,
			ID_INDIKATOR
			FROM
				SAKIP_INDIKATOR_SASARAN 
			WHERE ID_SASARAN = ? AND TAHUN = ? AND TIPE = ?
		",array($params['ID_SASARAN'],$params['TAHUN'],$params['TIPE']));

		return $q;

	}

	function get_indikatorsasaranbysatker($params){
		$q = $this->db->query("
			SELECT CAST(SIS.TRIWULAN_1 AS INT),
			CAST(SIS.TRIWULAN_2 AS INT) + CAST(SIS.TRIWULAN_3 AS INT) + CAST(SIS.TRIWULAN_4 AS INT) AS TOTAL,
			SIS.ID_SASARAN,
			SIS.KODE_INDIKATORSASARAN,
			SIS.NAMA_INDIKATOR,
			SIS.RKPDID,
			SIS.FORMULA_INDIKATOR,
			SIS.TARGET_INDIKATOR,
			SIS.TRIWULAN_4,
			SIS.TIPE,
			SIS.KODE_PROGRAM,
			SIS.REALISASI_INDIKATOR,
			SIS.TAHUN,
			SIS.RKPDID_SASARAN,
			SIS.SATUAN_INDIKATOR,
			SIS.TRIWULAN_1,
			SIS.TRIWULAN_2,
			SIS.TRIWULAN_3,
			SIS.ID_INDIKATOR,
			SMS.ID_SATKER
			FROM
					SAKIP_INDIKATOR_SASARAN SIS
					LEFT JOIN SAKIP_MST_SASARAN SMS
			ON SIS.ID_SASARAN = SMS.ID_SASARAN
			LEFT JOIN SAKIP_MST_UNITKERJA SMU
			ON SMS.ID_SATKER = SMU.ID_SATKER
			WHERE SMS.ID_SATKER = ? AND SIS.TAHUN = ? AND SIS.TIPE = ?
		",array($params['ID_SATKER'],$params['TAHUN'],$params['TIPE']));
		return $q;
	}

	function get_avgindikatorsasaran($params){
		$q = $this->db->query("
			SELECT
					 ISNULL(AVG(TARGET_INDIKATOR),0) AS AVG
			FROM
				SAKIP_INDIKATOR_SASARAN 
			WHERE ID_SASARAN = ? AND TAHUN = ? AND TIPE = ?
		",array($params['ID_SASARAN'],$params['TAHUN'],$params['TIPE']));

		return $q;

	}

	function get_avgrealisasiindikatorsasaranbysatker($params){
		$q = $this->db->query("
			SELECT
					ISNULL(AVG(REALISASI_INDIKATOR),0) AS AVG
			FROM
				SAKIP_INDIKATOR_SASARAN 
			WHERE ID_SASARAN = ? AND TAHUN = ? AND TIPE = ?

		",array($params['ID_SATKER'],$params['TAHUN'],$params['TIPE']));

		return $q;

	}

	function get_avgrealisasiindikatorsasaran($params){
		$q = $this->db->query("
			SELECT
					ISNULL(AVG(REALISASI_INDIKATOR),0) AS AVG
			FROM
				SAKIP_INDIKATOR_SASARAN 
			WHERE ID_SASARAN = ? AND TAHUN = ? AND TIPE = ?

		",array($params['ID_SASARAN'],$params['TAHUN'],$params['TIPE']));

		return $q;

	}

	function get_avgindikatorsasaranbysatker($params){
		$q = $this->db->query("
			SELECT
			 	ISNULL(AVG(TARGET_INDIKATOR),0) AS AVG
			FROM
					SAKIP_INDIKATOR_SASARAN SIS
					LEFT JOIN SAKIP_MST_SASARAN SMS
			ON SIS.ID_SASARAN = SMS.ID_SASARAN
			LEFT JOIN SAKIP_MST_UNITKERJA SMU
			ON SMS.ID_SATKER = SMU.ID_SATKER
			WHERE SMS.ID_SATKER = ? AND SIS.TAHUN = ? AND SIS.TIPE = ?
		",array($params['ID_SATKER'],$params['TAHUN'],$params['TIPE']));

		return $q;

	}


	function get_indikatorsasaranbyid($params){
		$q = $this->db->query("
			SELECT
					*
			FROM
				SAKIP_INDIKATOR_SASARAN 
			WHERE ID_INDIKATOR = ? 

		",array($params['ID_INDIKATOR']));
		return $q;
	}

	function get_programbyid($params){
		$q = $this->db->query("
			SELECT
					*
			FROM
				SAKIP_PROGRAM
			WHERE ID_PROGRAM = '$params'
		");
		return $q;
	}

	function get_indikatorprogrambyid($params){
		$q = $this->db->query("
			SELECT
					*
			FROM
				SAKIP_INDIKATOR_SASARAN 
			WHERE ID_INDIKATOR = ? AND TIPE = 2
		",array($params['ID_INDIKATOR']));
		return $q;
	}

	function add($params)
	{
		$res = $this->db->insert('SAKIP_INDIKATOR_SASARAN', $params); 
		return $res;
	}

	function upd($params)
	{
		$this->db->where('ID_INDIKATOR',$params['ID_INDIKATOR']);
		unset($params['ID_INDIKATOR']);
		$res = $this->db->update("SAKIP_INDIKATOR_SASARAN", $params);
		return $res;
	}

}