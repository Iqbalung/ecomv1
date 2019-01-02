<?php

class M_authentication extends CI_Model{
	function __construct(){
		$this->load->database();
	}


	function do_login($user,$pass)
	{
		error_reporting(0);	
		$password = md5($pass);
		$this->db->select('a.*,b.user_usergroup');		
		$this->db->where('a.user_username', $user );		
		$this->db->where('a.user_password', $password);
		$this->db->from('m_user_pelanggan a');
		$this->db->join("user_usergroup b","a.user_userid = b.user_userid","LEFT");
		$res = $this->db->get();
		return $res;
	}

	function do_register($params)
	{
		
		$params['user_password'] = md5($params['user_password']);
		$res = $this->db->insert("m_user_pelanggan",$params);
		return $res;
	}


	public function menu($grup)
	{
		$res = $this->db->query("
		SELECT * from ( 
			SELECT DISTINCT
				usergroupid, 
				menu,
				nourut, 
				link,
				icon
			FROM usermng_hakakses
			LEFT JOIN usermng_fitur on usermng_hakakses.fiturid = usermng_fitur.fiturid
			LEFT JOIN usermng_menu on usermng_fitur.menuid = usermng_menu.menuid  
			WHERE usermng_hakakses.usergroupid = ? and usermng_fitur.ismenu = 1) a order by a.nourut ASC
		", array($grup) );
		return array('menu' => $res->result_array());
	}

	public function fitur($grup)
	{

		$res = $this->db->query("
			SELECT DISTINCT
				usergroupid, usermng_fitur.fiturid fiturid, is_group, access, usermng_fitur.link
			FROM usermng_hakakses
			LEFT JOIN usermng_fitur on usermng_fitur.fiturid = usermng_hakakses.fiturid  
			WHERE usermng_hakakses.usergroupid = ? and usermng_fitur.is_menu <> '1' and usermng_hakakses.access = 'access'
		", array($grup) );

		return array('fitur' => $res->result_array());

	}


	public function fitur_user($grup,$userid)
	{
		
		$this->db->select("
				ha_user.usergroupid id,
				fitur.*,
				ha_usergroup.usergroupid,
				CASE WHEN ha_user.access IS NULL THEN
						ha_usergroup.access
					ELSE
						ha_user.access
				END as access
			",FALSE);
		$this->db->join('usermng_hakakses ha_user',"ha_usergroup.fiturid = ha_user.fiturid AND ha_user.usergroupid = '".$userid."'",'left');
		$this->db->join('usermng_fitur fitur',"ha_usergroup.fiturid = fitur.fiturid",'left');
		$this->db->where("ha_usergroup.usergroupid",$grup);
		$this->db->where("ha_usergroup.access","access");		
		$this->db->order_by('fitur.fiturid','ASC');
		
		$data = $this->db->get('usermng_hakakses ha_usergroup')->result_array();
		

		return array('fitur' => $data);
	}

	

}