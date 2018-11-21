<?php
class M_dokumentasi extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get($params)
	{
		$this->db->select("
			SDS.ROW_ID,
			SDS.NAMA_DOKUMEN,
			SDS.JENIS_DOKUMEN,
			SDS.TAHUN,
			SDS.DATE_CREATED,	
			SMU.ID_SATKER,
			SMU.NAMA_SATKER,
			SDOK.*
			");
		$this->db->join("SAKIP_DOKUMEN_SATKER SDS","SMU.ID_SATKER = SDS.ID_SATKER AND SDS.TAHUN = '".$params["TAHUN"]."'","LEFT");
		$this->db->join("SAKIP_DOKUMEN SDOK","SDOK.PARENT_UID = SDS.ROW_ID","LEFT");
		$this->db->like("SMU.ID_SATKER",$params["ID_SATKER"],"AFTER");
		$this->db->order_by("LEN(SMU.ID_SATKER)","ASC");		
		$res = $this->db->get('SAKIP_MST_UNITKERJA SMU'); 
		return $res;
	}

	function add($params = array())
	{
		$res = $this->db->insert("SAKIP_DOKUMEN_SATKER",$params);
		return $res;
	}

	function upd($params = array())
	{
		$this->db->where("ROW_ID",$params["ROW_ID"]);
		unset($params["ROW_ID"]);
		$res = $this->db->update("SAKIP_DOKUMEN_SATKER",$params);
		return $res;
	}
}