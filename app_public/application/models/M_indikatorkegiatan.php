<?php
class M_indikatorkegiatan extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_indikatorkegiatan($params){
		$q = $this->db->query("		
			SELECT * FROM SAKIP_KEGIATAN K LEFT JOIN SAKIP_INDIKATOR_SASARAN I ON 
		K.ID_KEGIATAN = I.ID_SASARAN WHERE ID_SATKER = ?
		",array($params['ID_SATKER']));
		return $q;
	}

	function get_indikatorbyid($params){
		$q = $this->db->query("
			SELECT * FROM SAKIP_INDIKATOR_SASARAN WHERE ID_SASARAN = '$params'
		");
		return $q;
	}

	function add($params)
	{
		$res = $this->db->insert('SAKIP_INDIKATOR_SASARAN', $params); 
		return $res;
	}
}