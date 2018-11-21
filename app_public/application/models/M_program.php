<?php
class M_program extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get_sasaraneslon2($params){
		$q = $this->db->query("
				SELECT MS.ID_SASARAN, MS.ID_SATKER, MS.TAHUN_SASARAN FROM 
					SAKIP_MST_SASARAN MS
					WHERE MS.ID_SATKER = ? AND MS.TAHUN_SASARAN = ?
		",array($params['ID_SATKER'],$params['TAHUN']));

		return $q;
	}

	function get_sasaraneslon3($params){
		$q = $this->db->query("
				SELECT MS.ID_SASARAN, MS.ID_SATKER, MS.TAHUN_SASARAN FROM 
					SAKIP_MST_SASARAN MS
					WHERE MS.ID_SATKER = ? AND MS.TAHUN_SASARAN = ?
		",array($params['ID_SATKER'],$params['TAHUN']));

		return $q;
	}


	function get_indikatorprogram($params){
		$q = $this->db->query("
			SELECT DISTINCT 
				SIS.[ID_SASARAN],
				SIS.[ID_INDIKATOR],
				SIS.[NAMA_INDIKATOR],
				SIS.[FORMULA_INDIKATOR],
				SIS.[TAHUN],
				SIS.[TIPE],
				SIS.[KODE_PROGRAM],
				SIS.[REALISASI_INDIKATOR],
				SP.[KODE_PROGRAM],
				SP.[TAHUN],
				SP.[TARGET],
				SP.[RKPDID],
				SP.[TOTAL],
				SP.[SATUAN],
				SP.[DATECREATED],
				SP.[ID_SASARAN],
				SP.[IDJENISANGGARAN],
				SP.[NAMA_PROGRAM],
				SP.[KETERANGAN_PROGRAM],
				SP.[TIPE],
				SMS.[ID_SASARAN],
				SMS.[KODE_SASARAN],
				SMS.[TAHUN_SASARAN],
				SMS.[DATECREATED],
				SMS.[STRATEGI_SASARAN],
				SMS.[ID_SATKER]
				   from SAKIP_MST_SASARAN SMS
				 LEFT JOIN SAKIP_PROGRAM SP ON SP.ID_SASARAN = SMS.ID_SASARAN
				 LEFT JOIN SAKIP_INDIKATOR_SASARAN SIS ON SP.ID_PROGRAM = SIS.ID_SASARAN
				 where SMS.ID_SATKER = ? AND SIS.TIPE = '2' AND SIS.TAHUN = ?

 			",array($params['ID_SATKER'],$params['TAHUN']));
		return $q;

	}

	function get_indikatorprogrambyid($params){
		$q = $this->db->query("
			SELECT DISTINCT 
				SIS.[ID_SASARAN],
				SIS.[NAMA_INDIKATOR],
				SIS.[FORMULA_INDIKATOR],
				SIS.[TAHUN],
				SIS.[TIPE],
				SIS.[KODE_PROGRAM],
				SIS.[REALISASI_INDIKATOR],
				SP.[KODE_PROGRAM],
				SP.[TAHUN],
				SP.[TARGET],
				SP.[RKPDID],
				SP.[TOTAL],
				SP.[SATUAN],
				SP.[DATECREATED],
				SP.[ID_SASARAN],
				SP.[IDJENISANGGARAN],
				SP.[NAMA_PROGRAM],
				SP.[KETERANGAN_PROGRAM],
				SP.[TIPE],
				SMS.[ID_SASARAN],
				SMS.[KODE_SASARAN],
				SMS.[TAHUN_SASARAN],
				SMS.[DATECREATED],
				SMS.[STRATEGI_SASARAN],
				SMS.[ID_SATKER]
				   from SAKIP_MST_SASARAN SMS
				 LEFT JOIN SAKIP_PROGRAM SP ON SP.ID_SASARAN = SMS.ID_SASARAN
				 LEFT JOIN SAKIP_INDIKATOR_SASARAN SIS ON SP.ID_PROGRAM = SIS.ID_SASARAN
				 where SIS.TAHUN = ?

 			",array($params['ID_INDIKATOR']));
		return $q;

	}

	function get_program($params){
		$q = $this->db->query("
			SELECT ID_INDIKATOR, 	KODE_INDIKATORSASARAN,	NAMA_INDIKATOR,	RKPDID,	FORMULA_INDIKATOR,	TARGET_INDIKATOR,	TAHUN,	RKPDID_SASARAN,	SATUAN_INDIKATOR,	TRIWULAN_1,	TRIWULAN_2,	TRIWULAN_3,	TRIWULAN_4,	TIPE,	KODE_PROGRAM
				FROM SAKIP_INDIKATOR_SASARAN
				where kode_program IN ($params) and TIPE = 2 GROUP BY ID_INDIKATOR, 	KODE_INDIKATORSASARAN,	NAMA_INDIKATOR,	RKPDID,	FORMULA_INDIKATOR,	TARGET_INDIKATOR,	TAHUN,	RKPDID_SASARAN,	SATUAN_INDIKATOR,	TRIWULAN_1,	TRIWULAN_2,	TRIWULAN_3,	TRIWULAN_4,	TIPE,	KODE_PROGRAM
		",array($params));
		return $q;
	}

	function get_programbyid($params){
		$q = $this->db->query("
			SELECT * FROM SAKIP_PROGRAM WHERE ID_PROGRAM = ? ", $params['ID_PROGRAM']);
		return $q;
	}


	function get_programeselon3($params){
		$q = $this->db->query("
			SELECT ID_INDIKATOR, 	KODE_INDIKATORSASARAN,	NAMA_INDIKATOR,	RKPDID,	FORMULA_INDIKATOR,	TARGET_INDIKATOR,	TAHUN,	RKPDID_SASARAN,	SATUAN_INDIKATOR,	TRIWULAN_1,	TRIWULAN_2,	TRIWULAN_3,	TRIWULAN_4,	TIPE,	KODE_PROGRAM
				FROM SAKIP_INDIKATOR_SASARAN
				where kode_program IN ($params) and TIPE = 3 GROUP BY ID_INDIKATOR, 	KODE_INDIKATORSASARAN,	NAMA_INDIKATOR,	RKPDID,	FORMULA_INDIKATOR,	TARGET_INDIKATOR,	TAHUN,	RKPDID_SASARAN,	SATUAN_INDIKATOR,	TRIWULAN_1,	TRIWULAN_2,	TRIWULAN_3,	TRIWULAN_4,	TIPE,	KODE_PROGRAM
		",array($params));
		return $q;
	}

	function get_programbykode($params){
		$q = $this->db->query("
			SELECT
				*
			FROM
				SAKIP_PROGRAM 
			WHERE KODE_PROGRAM IN ($params)
		",array($params));
		return $q;
	}

	function get_programsasaran($params){
		$q = $this->db->query("
			SELECT
				*
			FROM
				SAKIP_PROGRAM 
			WHERE ID_SASARAN IN ($params)
		",array($params));
		return $q;
	}


	function add($params)
	{
		$res = $this->db->insert("SAKIP_PROGRAM", $params);
		return $res;
	}

	function upd($params)
	{
		$this->db->where('ID_PROGRAM',$params['ID_PROGRAM']);
		unset($params['ID_PROGRAM']);
		$res = $this->db->update("SAKIP_PROGRAM", $params);
		return $res;
	}

	function checkbysasaran($params)
	{

		$res = $this->db->query("SELECT ID_PROGRAM, NAMA_PROGRAM FROM SAKIP_PROGRAM WHERE NAMA_PROGRAM = '$params'");
		return $res;
	}


}