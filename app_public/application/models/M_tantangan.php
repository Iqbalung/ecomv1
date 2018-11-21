<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tantangan extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($params)
	{
		$this->db->where($params);
		$res = $this->db->get('SAKIP_MST_TANTANGAN');

		return array('data' => $res->result_array());
	}

	public function add($params)
	{
		$res = $this->db->insert('SAKIP_MST_TANTANGAN', $params);

		return $res;
	}

	public function upd($params)
	{
		$this->db->where('ID_TANTANGAN', $params['ID_TANTANGAN']);
		$res = $this->db->update('SAKIP_MST_TANTANGAN', $params);

		return $res;
	}

	public function del($params)
	{
		$res = $this->db->delete('SAKIP_MST_TANTANGAN', $params);

		return $res;
	}

}

/* End of file M_tantangan.php */
/* Location: ./application/models/M_tantangan.php */