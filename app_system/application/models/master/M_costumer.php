<?php
class M_costumer extends CI_Model{

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
				a.*				
			");

		if (isset($args["f_search"])) 
		{
			$this->db->like("user_username",$args["f_search"]);
		}
		
		$db2 = clone $this->db;
		$data = $this->db->get('m_user_pelanggan a', $limit, $start)->result_array();
		$count = $db2->get('m_user_pelanggan a')->num_rows();

		return array('data' => $data, 'count' => $count);		
	}

    	
}