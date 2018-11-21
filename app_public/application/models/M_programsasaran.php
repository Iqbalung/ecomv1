<?php
class M_programsasaran extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get_programsasaran($params){
		$q = $this->db->query("
			SELECT
					*
			FROM
				SAKIP_PROGRAM 
			WHERE ID_SASARAN = ? AND TAHUN = ?
		",array($params['ID_SASARAN'],$params['TAHUN']));

		return $q;
	}

	function get_programsasaranbysatker($params){
		$q = $this->db->query("
			SELECT * FROM SAKIP_PROGRAM SP
			LEFT JOIN SAKIP_MST_SASARAN SMS
			ON SMS.ID_SASARAN = SP.ID_SASARAN
			WHERE SMS.ID_SATKER = ? AND SP.TAHUN = ?
		",array($params['ID_SATKER'],$params['TAHUN']));

		return $q;
	}



 function get_programsasaranbyid($params){
		$q = $this->db->query("
			SELECT
					*
			FROM
				SAKIP_PROGRAM 
			WHERE ID_PROGRAM = ? 
		",array($params['ID_PROGRAM']));
		return $q;
	}

	

	function add($params)
	{
		$res = $this->db->insert('SAKIP_INDIKATOR_SASARAN', $params); 
		return $res;
	}

	function upd($params)
	{
		$this->db->where('ID_PROGRAM',$params['ID_PROGRAM']);
		unset($params['ID_PROGRAM']);
		$res = $this->db->update("SAKIP_PROGRAM", $params);
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