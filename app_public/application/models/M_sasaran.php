<?php
class M_sasaran extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get($params)
	{
		$q = $this->db->query("
			
			SELECT CAPAIAN,
DATECREATED,
ID_SASARAN,
ID_SATKER,
KODE_SASARAN,
NAMA_SASARAN,
RKPDID,
STRATEGI_SASARAN,
TAHUN_SASARAN,
id_jenisanggaran,
tahun FROM SAKIP_MST_SASARAN
				where ID_SATKER = ?
				AND
				TAHUN_SASARAN	= ?
				GROUP BY DATECREATED,
ID_SASARAN,
ID_SATKER,
KODE_SASARAN,
NAMA_SASARAN,
RKPDID,
STRATEGI_SASARAN,
TAHUN_SASARAN,
id_jenisanggaran,
tahun
			",array($params['ID_SATKER'],$params['TAHUN_SASARAN']));
		return $q;	
	}

	function get_targetby($params)
	{
		$q = $this->db->query("
				SELECT 
				ISNULL(SUM(TARGET_PROGRAM),0)
				JUMLAH , ISNULL(AVG(TARGET_INDIKATOR),0) PERSEN FROM VW_SAKIP_PROGRAM_SATKER WHERE ID_SATKER = ? AND TAHUN_SASARAN = ?
			",array($params['ID_SATKER'],$params['TAHUN_SASARAN']));
		return $q;	
	}	

	function add($params)
	{
		$res = $this->db->insert('SAKIP_MST_SASARAN', $params); 
		return $res;
	}

	function add_mapsatker($params)
	{
		$res = $this->db->insert('SAKIP_MAP_SASARAN_SATKER', $params); 
		return $res;
	}

	function upd($params)
	{
		$this->db->where('ID_SASARAN',$params['ID_SASARAN']);
		unset($params['ID_SASARAN']);
		$res = $this->db->update("SAKIP_MST_SASARAN", $params);
		return $res;
	}

	function del($params)
	{
		$res = $this->db->query("
			DELETE FROM SAKIP_MST_UNITKERJA
			where ID_SATKER  = '".$params['ID_SATKER']."'
		");
		return $res;
	}

}