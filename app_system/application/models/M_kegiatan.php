<?php
class M_kegiatan extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_indikatorkegiatan(){
		$res = 	$this->db->query("
			SELECT * from SAKIP_INDIKATOR_SASARAN where ID_SASARAN in (
				select id_kegiatan from SAKIP_KEGIATAN where ID_PROGRAM in (
				select id_program  
			from sakip_program p 
				left join SAKIP_MST_SASARAN s on p.ID_SASARAN = s.ID_SASARAN 
				where s.ID_SATKER = ?
				))
			",$params['ID_SATKER']);
		return $res;
	}	

	function get_kegiatanatasan(){
		$res = 	$this->db->query("
					SELECT * FROM VW_SAKIP_PROGRAM_SATKER VS
					LEFT JOIN SAKIP_KEGIATAN SK ON VS.ID_PROGRAM = SAKIP_KEGIATAN.ID_PROGRAM
				");
		return $res;
	}


	function get_kegiatanbyprogram($params){
		$res = 	$this->db->query("
					SELECT * FROM SAKIP_KEGIATAN
					WHERE ID_PROGRAM = '$params'
				");
		return $res;
	}

	function add($params)
	{
		$res = $this->db->insert("SAKIP_KEGIATAN", $params);
		return $res;
	}

	function get_kegiatanbyid($params){
		$res = 	$this->db->query("
					SELECT * FROM SAKIP_KEGIATAN
					WHERE ID_KEGIATAN = '$params'
				");
		return $res;
	}

	
}