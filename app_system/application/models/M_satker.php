<?php
class M_satker extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get($params)
	{

		$q = $this->db->query("

			SELECT * FROM SAKIP_MST_UNITKERJA where 
			ID_SATKER LIKE ?
			AND LEN(ID_SATKER) - LEN(REPLACE(ID_SATKER, '.', '')) = LEN(?) - LEN(REPLACE(?, '.', '')) + 1 
			",array($params['ID_SATKER'].'%',$params['ID_SATKER'],$params['ID_SATKER']));
		return $q;	
	}

	function get_byid($params)
	{

		$q = $this->db->query("

			SELECT * FROM SAKIP_MST_UNITKERJA where 
			ID_SATKER LIKE ?			
			",array($params['ID_SATKER']));
		return $q;	
	}

	function get_parent($params)
	{

		$q = $this->db->query("SELECT *
		from SAKIP_MST_UNITKERJA
		where SUBSTRING ( ? , 1, len(  ID_SATKER ) ) = ID_SATKER
		AND (LEN( ? ) - LEN(REPLACE ( ? , '.', '')) ) - (  LEN(ID_SATKER) - LEN( REPLACE(ID_SATKER, '.', '') ) ) = 1 
		",array($params['ID_SATKER'],$params['ID_SATKER'],$params['ID_SATKER']));
		return $q;	
	}

		/*
			SELECT * FROM SAKIP_MST_UNITKERJA WHERE 
			ID_SATKER LIKE '1.%' 
			AND len(ID_SATKER) - len(REPLACE(ID_SATKER, '.', '')) = len('1.') - len(REPLACE('1.', '.', '')) + 1

		*/
	function get_id($params){
		$res = $this->db->query("
			SELECT
				ISNULL (
					MAX (
						CAST (
							REPLACE(
								SUBSTRING (ID_SATKER, LEN(?) + 1, LEN(ID_SATKER)),
								'.',
								''
							)
						AS INTEGER) 
					),
					0
				) + 1 AS NEW
			FROM
				SAKIP_MST_UNITKERJA
			WHERE
				ID_SATKER LIKE ?
			AND LEN(ID_SATKER) - LEN(REPLACE(ID_SATKER, '.', '')) = (LEN(?) - LEN(REPLACE(?, '.', '')))+1
			AND RIGHT (ID_SATKER, 1) = '.'
		",array($params['ID_SATKER'],$params['ID_SATKER']."%",$params['ID_SATKER'],$params['ID_SATKER']));
		return $res;
	}

	function add($params)
	{
		$res = $this->db->query("
			INSERT INTO SAKIP_MST_UNITKERJA(NAMA_SATKER, ID_SATKER,DATECREATED,PK,RKPDID,NAMAJABATAN_SATKER,NAMA_PEJABAT_SATKER,NIP_PEJABAT_SATKER,PANGKAT_PEJABAT_SATKER) 
			VALUES ( '".$params['NAMA_SATKER']."', '".$params['ID_SATKER']."','".date('Y-m-d')."',0,0,'".$params["NAMAJABATAN_SATKER"]."','".$params["NAMA_PEJABAT_SATKER"]."','".$params["NIP_PEJABAT_SATKER"]."','".$params["PANGKAT_PEJABAT_SATKER"]."')
		");
		return $res;
	}

	function upd($params)
	{
		$res = $this->db->query("
			UPDATE SAKIP_MST_UNITKERJA 
			SET 
				NAMA_SATKER = '".$params['NAMA_SATKER']."',
				NAMAJABATAN_SATKER = '".$params['NAMAJABATAN_SATKER']."',
				NAMA_PEJABAT_SATKER = '".$params['NAMA_PEJABAT_SATKER']."',
				NIP_PEJABAT_SATKER = '".$params['NIP_PEJABAT_SATKER']."',
				PANGKAT_PEJABAT_SATKER = '".$params['PANGKAT_PEJABAT_SATKER']."'
			where ID_SATKER = '".$params['ID_SATKER']."'
		");
		return $res;
	}

	function del($params)
	{
		$res = $this->db->query("
			DELETE FROM SAKIP_MST_UNITKERJA
			where ID_SATKER  LIKE '".$params['ID_SATKER']."%'
		");
		return $res;
	}
}