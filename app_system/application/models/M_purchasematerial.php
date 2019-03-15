<?php
class M_purchasematerial extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	function search_material($args =  array())
	{
		if(isset($args['f_search']) && !empty($args['f_search']) && isset($args['where_search']) && 
				is_array($args['where_search']) && count($args['where_search']) > 0){
			$this->db->group_start();
			foreach ($args['where_search'] as $field) {
				$this->db->or_like($field,$args['f_search']);				
			}			
			$this->db->group_end();
		}
		$q = $this->db->get("m_material");
		return $q;	
	}
	
	function get($params,$table)
	{
		if(isset($params['where'])){
			$this->db->where($params['where'],$params['where_value']);
		}
		$q = $this->db->get($table['table_name']);
		return $q;	
	}

	function get_like($params,$table)
	{
		if(isset($params['where'])){
			$this->db->like($params['where'],$params['where_value']);
		}
		$q = $this->db->get($table['table_name']);
		return $q;	
	}

    function get_route()
	{
		$query = $this->db->query("
				SELECT * 
				FROM  `route` 
				LEFT JOIN (

				SELECT name NAME_START, cityid ID_START,CODE CODE_START
				FROM city
				)a ON route.start = a.id_start
				LEFT JOIN (
				SELECT name NAME_DEST, cityid ID_DEST
				FROM city
				)b ON route.dest = b.ID_DEST
				LEFT JOIN SHIP ON route.SHIPID = ship.SHIPID

			");
		return $query;
	}

	function get_route_search($params)
	{
		$query = $this->db->query("
				SELECT * 
				FROM  `route` 
				LEFT JOIN (

				SELECT name NAME_START, cityid ID_START,CODE CODE_START
				FROM city
				)a ON route.start = a.id_start
				LEFT JOIN (
				SELECT name NAME_DEST, cityid ID_DEST
				FROM city
				)b ON route.dest = b.ID_DEST
				LEFT JOIN SHIP ON route.SHIPID = ship.SHIPID
				WHERE ID_START = ? AND ID_DEST = ?
			",array($params['START'],$params['DEST']));
		return $query;
	}


	function get_route_detail($params)
	{
		$query = $this->db->query("
				SELECT * 
				FROM  `route` 
				LEFT JOIN (

				SELECT name NAME_START, cityid ID_START, CODE_START
				FROM city
				)a ON route.start = a.id_start
				LEFT JOIN (
				SELECT name NAME_DEST, cityid ID_DEST
				FROM city
				)b ON route.dest = b.ID_DEST
				LEFT JOIN SHIP ON route.SHIPID = ship.SHIPID
				WHERE ROUTEID = ?
			",array($params['routeid']));
		return $query;
	}

	function get_riwayat(){
		$query = $this->db->query("
			SELECT * FROM `route` LEFT JOIN ( SELECT name NAME_START, cityid ID_START FROM city )a ON route.start = a.id_start LEFT JOIN ( SELECT name NAME_DEST, cityid ID_DEST FROM city )b ON route.dest = b.ID_DEST LEFT JOIN SHIP ON route.SHIPID = ship.SHIPID LEFT JOIN item ON route.ROUTEID = item.ROUTEID where ROUTE.ROUTEID in ( SELECT ROUTEID from item LEFT JOIN itenary on itenary.TRXID = item.TRXID WHERE itenary.MEMBERID = '1' ) GROUP BY route.ROUTEID");
		return $query;
	}

	function get_riwayat_byid($params){
		$query = $this->db->query("
			SELECT *, MEMBER.NAME AS MEMBER_NAME FROM itenary left join member on itenary.MEMBERID = member.ID WHERE TRXID = ?",$params['TRXID']);
		return $query;
	}

	function get_riwayat_byuser(	){
		$params['MEMBERID'] = $this->session->userdata('userid');
		$query = $this->db->query("
			SELECT * FROM itenary left join member on itenary.MEMBERID = member.ID
			where MEMBERID = ?
			",$params['MEMBERID']);
		return $query;
	}

	function get_order(){
		$query = $this->db->query("
			SELECT * FROM `route` LEFT JOIN ( SELECT name NAME_START, cityid ID_START FROM city )a ON route.start = a.id_start LEFT JOIN ( SELECT name NAME_DEST, cityid ID_DEST FROM city )b ON route.dest = b.ID_DEST LEFT JOIN SHIP ON route.SHIPID = ship.SHIPID LEFT JOIN item ON route.ROUTEID = item.ROUTEID GROUP BY route.ROUTEID");
		return $query;
	}


	function add($params,$table)
	{
		$res = $this->db->insert($table['table_name'],$params); 
		return $res;
	}

	function upd($params,$table)
	{
		$this->db->where($params['where'],$params['where_value']);
		unset($params['where']);
		unset($params['where_value']);
		$res = $this->db->update($table['table_name'], $params);
		return $res;
	}
}