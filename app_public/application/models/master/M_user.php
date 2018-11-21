<?php
class M_user extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get($args =  array())
	{	

		$start = ifunsetempty($args,'start',0);
		$limit = ifunsetempty($args,'limit',10);

		$this->db->select("
				a.*,
				mu.urg_name,
				mu.urg_id,
				mu.urg_id user_usergroup,
				uug.user_usergroupid
			");

		if (isset($args["f_search"])) 
		{
			$this->db->like("user_username",$args["f_search"]);
		}
		$this->db->join("user_usergroup uug","a.user_userid = uug.user_userid","LEFT");
		$this->db->join("m_usergroup mu","uug.user_usergroup = mu.urg_id","LEFT");
		$db2 = clone $this->db;
		$data = $this->db->get('m_user a', $limit, $start)->result_array();
		$count = $db2->get('m_user a')->num_rows();

		return array('data' => $data, 'count' => $count);		
	}

    
	function add($args = array())
	{
		$res = $this->db->insert("m_user",$args); 
		return $res;
	}

	function update($args = array())
	{
		$res = false;
		if (isset($args['user_userid']) && !empty($args['user_userid']))
		{
			$this->db->where("user_userid",$args['user_userid']);
			unset($args['user_userid']);		
			$res = $this->db->update("m_user", $args);
		}
		return $res;
	}

	function delete ($args = array())
	{
		$res = false;
		if (isset($args['user_userid']) && !empty($args['user_userid']))
		{
			$this->db->where("user_userid",$args['user_userid']);
			unset($args['user_userid']);		
			$res = $this->db->delete("m_user");
		}
		return $res;
	}

	function get_usergroup($args = array())
	{
		$res = $this->db->get("m_usergroup"); 
		return $res;
	}

	public function add_user_usergroup($args = array())
	{
		return $this->db->insert("user_usergroup",$args);
	}

	public function update_user_usergroup($args = array())
	{
		$res = false;
		if (isset($args["user_usergroupid"]) && !empty($args["user_usergroupid"]))
		{
			$this->db->where("user_usergroupid",$args["user_usergroupid"]);
			unset($args["user_usergroupid"]);
			$res = $this->db->update("user_usergroup",$args);
		}
		
		return $res;
	}

	public function delete_user_usergroup($args = array())
	{
		$res = true;
		if (isset($args["user_usergroupid"]) && !empty($args["user_usergroupid"]))
		{
			$this->db->where("user_usergroupid",$args["user_usergroupid"]);
			unset($args["user_usergroupid"]);
			$res = $this->db->delete("user_usergroup");
		}
		
		return $res;
	}
}