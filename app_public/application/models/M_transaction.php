<?php 
/**
 * 
 */
class M_transaction extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_transaction_by($args = array())
	{
		$this->db->select("
			trx.*,
			mc.courier_name,
			mc.courier_flag
			");

		$this->db->join("m_courier mc","trx.trx_courier = mc.courier_id","LEFT");

		if (isset($args["trx_state_id"]) && !empty($args["trx_state_id"])) {
			if (is_array($args["trx_state_id"]) && count($args["trx_state_id"]) > 0)
			{
				$this->db->where_in("trx.trx_state_id",$args["trx_state_id"]);
			}
			else
			{
				$this->db->where("trx.trx_state_id",$args["trx_state_id"]);
			}
		}

		if (isset($args["is_shipping"]) && $args["is_shipping"])
		{
			$this->db->where("trx.trx_shipping_code is NOT NULL", NULL, FALSE);
		}

		$res = $this->db->get("trx");
		return $res;
	}
}