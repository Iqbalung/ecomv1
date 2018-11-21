<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		header("Access-Control-Allow-Origin: *");
		$this->load->model("M_transaction_forstok");
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/transaction/forstok/main', $data);
	}

	public function get()
	{
		header("Access-Control-Allow-Origin: *");
		$params =  array(			
			"start" => ifunsetempty($_GET,"m",0),
			"limit" => ifunsetempty($_GET,"limit",$this->config->item("pagesize")),
			"mos_id" => ifunsetempty($_GET,"f-mediasale",""),
			"f_search" => ifunsetempty($_GET,"f_search",""),
			"f_state" => ifunsetempty($_GET,"f_state",""),
			"f_date_from" => convert_format_date(ifunsetempty($_GET,"f_date_from","01/01/1970"),array("is_time"=>false)),
			"f_date_to" => convert_format_date(ifunsetempty($_GET,"f_date_to","01/01/2020"),array("is_time"=>false)),
		);
		

		$config_pagging = array(
			"per_page" => $this->config->item("pagesize")
		);

		$data = $this->M_transaction_forstok->get_trx($params,true);

		
		$data['paging'] = $this->set_pagination($data, site_url('/transaction/forstok/get'),$config_pagging);

		$out = $this->_respon($data,$data,"get");

		echo json_encode($out);			
	}

	public function get_detail_transaction()
	{
		$params =  array(
			"trx_id" => ifunsetempty($_POST,"id","")
		);

		$data = array();

		$res = $this->M_transaction_forstok->get_all_trx_by_id($params);

		if ($res->num_rows() > 0)
		{
			$data["data"] = $res->row_array();
			$res_items = $this->M_transaction_forstok->get_items($params);
			$data["data_items"] = $res_items->result_array();
			$res_cost = $this->M_transaction_forstok->get_cost($params);
			
			foreach ($res_cost->result_array() as $key => $value) {
				$value["id_gen"] = "id_gen_cost-".$value["trx_cost_id"].time();
				$data["data_cost"][] = $value;
			}
			$res_state = $this->M_transaction_forstok->get_state($params);
			$data["data_state"] = $res_state->result_array();
		}

		$out = $this->_respon($data,$data,"get");

		echo json_encode($out);			
	}


	public function get_page_detail_transaction()
	{
		$params =  array(
			"trx_id" => ifunsetempty($_POST,"id","")
		);

		$data = array();

		$res = $this->M_transaction_forstok->get_all_trx_by_id($params);

		if ($res->num_rows() > 0)
		{
			$data["data"] = $res->row_array();
			$res_items = $this->M_transaction_forstok->get_items($params);
			$data["data_items"] = $res_items->result_array();
			$res_cost = $this->M_transaction_forstok->get_cost($params);
			
			foreach ($res_cost->result_array() as $key => $value) {
				$value["id_gen"] = "id_gen_cost-".$value["trx_cost_id"].time();
				$data["data_cost"][] = $value;
			}
			$res_state = $this->M_transaction_forstok->get_state($params);
			$data["data_state"] = $res_state->result_array();
		}

		$out = $this->_respon($data,$data,"get");

		echo json_encode($out);			
	}


	public function process()
	{
		$params = array(
			"trx_id" => ifunsetempty($_POST,"trx_id",""),
			"waybill" => ifunsetempty($_POST,"waybill",""),
			"trx_notes" => ifunsetempty($_POST,"trx_notes",""),
		);

		$res_trx = $this->M_transaction_forstok->upd_trx($params);

		$data_items = json_decode(ifunsetempty($_POST,"data_items","[]"),true);
		$res_item = $this->_save_items($data_items,$params);

		$data_cost = json_decode(ifunsetempty($_POST,"data_cost","[]"),true);
		$res_cost = $this->_save_cost($data_cost,$params);

		$data_log = json_decode(ifunsetempty($_POST,"data_state","[]"),true);
		$res_log = $this->_save_log($data_log,$params);

		if (count($data_log) > 0) {
			$last_state = ifunsetempty($data_log,(count($data_log)-1),array());
			
			if (isset($last_state["name"]) && !empty($last_state["name"]))
			{
				$params_state = array(
					"trx_id" => ifunsetempty($_POST,"trx_id",""),
					"trx_state_id" => ifunsetempty($last_state,"name","")
				);

				$res_trx = $this->M_transaction_forstok->upd_trx($params_state);
			}
		}

		$out = $this->_respon(($res_trx && $res_item  && $res_cost && $res_log),false,"update");

		echo json_encode($out);
	}

	function proses_multi(){
		$params = array(
			"id" => json_decode(ifunsetempty($_POST,"id","")),
			"status" => ifunsetempty($_POST,"status",""),
		);
		foreach ($params['id'] as $key => $value) {
			$params_state = array(
					"trx_id" => $value,
					"trx_state_id" => $params['status']
			);

			$res_trx = $this->M_transaction_forstok->upd_trx($params_state);
		}
		$out = $this->_respon($res_trx,$params,"update");

		echo json_encode($out);	
	}

	function proses_multi_shipped(){
		$params = array(
			"id" => json_decode(ifunsetempty($_POST,"id","")),
			"status" => ifunsetempty($_POST,"status",""),
		);
		foreach ($params['id'] as $key => $value) {
			$params_state = array(
					"trx_id" => $value->trx_id,
					"waybill" => $value->waybill,
					"trx_state_id" => $params['status']
			);
			$res_trx = $this->M_transaction_forstok->upd_trx($params_state);
		}
		$out = $this->_respon($res_trx,$params,"update");

		echo json_encode($out);	
	}

	function _save_items($data,$args = array())
	{
		$this->load->model("master/M_product");
		$res = true;
		foreach ($data as $key => $value) {

			$params_check = array(
				"prod_id" => ifunsetempty($value,"prod_id",""),
				"prod_id_new" => ifunsetempty($value,"prod_id_new","")
			);

			$params = array(
				"item_id" => ifunsetempty($value,"item_id",""),
				"trxid" => ifunsetempty($args,"trx_id",""),
				"item_isflashsale" => ifunsetempty($value,"item_isflashsale",0)
			);

			if(!empty($params_check["prod_id_new"]) && $params_check["prod_id"] != $params_check["prod_id_new"])
			{
				$params_product = array(
					"prod_id" => ifunsetempty($params_check,"prod_id_new","")
				);

				$res_product = $this->M_product->get_by($params_product);

				if ($res_product->num_rows() > 0)
				{			
					$data_product = $res_product->row_array();
					$params["prod_id"] = ifunsetempty($data_product,"prod_id",ifunsetempty($value,"prod_id",""));
					$params["prod_code"] = ifunsetempty($data_product,"prod_code",ifunsetempty($value,"prod_code",""));
				}

			}


			if (!empty($params["item_id"])) {
				$res = $this->M_transaction_forstok->upd_item($params);
			}
		}

		return $res;
	}


	function _save_log($data,$args = array())
	{
		$res = true;
		$data_user = (array) $this->get_data_user();
		foreach ($data as $key => $value) {
				$params = array(
					'trx_log_id' => ifunsetempty($value,"trx_log_id",""),
					'order_date' => ifunsetempty($value,"order_date",date("Y-m-d H.i.s")),
					'trx_log_caption' => ifunsetempty($value,"name",""),
					'trx_id' => ifunsetempty($args,"trx_id",""),			
					'trx_log_datecreated' => date("Y-m-d H:i:s"),
					'user_userid' => ifunsetempty($data_user,"user_userid",""),			
				);

				if (empty($params["trx_log_id"])) {
					$params["trx_log_id"] = $this->get_uuid();
					$res = $this->M_transaction_forstok->add_log($params);
				}

		}

		return $res;
	}

	function _save_cost($data,$args = array())
	{
		$res = true;
		foreach ($data as $key => $value) {
			$params = array(
				"trx_cost_id" => ifunsetempty($value,"trx_cost_id",""),
				"trx_id" => ifunsetempty($args,"trx_id",""),
				"trx_cost_price" => ifunsetempty($value,"trx_cost_price",0),
				"trx_cost_type" => ifunsetempty($value,"trx_cost_type","")

			);

			if (empty($params["trx_cost_id"]))
			{
				$params["trx_cost_id"] = $this->get_uuid();
				$res = $this->M_transaction_forstok->add_cost($params);	
			}
			else
			{
				$res = $this->M_transaction_forstok->upd_cost($params);
			}
		}

		return $res;
	}

	function close_transaction()
	{
		$res = true;

		$data_user = (array) $this->get_data_user();

		$params = array(
			"trx_id" => ifunsetempty($_POST,"trx_id",""),
			"trx_state_id" => ifunsetempty($_POST,"flag",""),
		);

		$res = $this->M_transaction_forstok->upd_trx($params);

		$params_log = array(
			'trx_log_id' => $this->get_uuid(),			
			'trx_log_caption' => ifunsetempty($params,"trx_state_id",""),
			'trx_id' => ifunsetempty($params,"trx_id",""),			
			'trx_log_datecreated' => date("Y-m-d H:i:s"),			
			'trx_log_note' => ifunsetempty($_POST,"trx_log_notes",""),			
			'user_userid' => ifunsetempty($data_user,"user_userid","")
		);	

		$res_log = $this->M_transaction_forstok->add_log($params_log);
		
		$out = $this->_respon(($res && $res_log),false,"CREATE");

		echo json_encode($out);
	}

	public function status_workin()
	{
		$this->load->model("M_crud");
		$params = array(
			"is_workin" => ifunsetempty($_POST,"state",0),
			"where" => "trx_id",
			"where_value" => ifunsetempty($_POST,"id",""),
		);
		$res = false;
		$tables["table_name"] = "trx";

		if (!empty($params["where_value"]))
		{
			$res = $this->M_crud->upd($params,$tables);
		}		

		$out = $this->_respon($res,false,"update");

		echo json_encode($out);
	}

	public function cek_status_workin()
	{
		$this->load->model("M_crud");
		$params = array(			
			"where" => "trx_id",
			"where_value" => ifunsetempty($_POST,"id",""),
		);
		$res = true;
		$tables["table_name"] = "trx";
		$msg = array();
		if (!empty($params["where_value"]))
		{
			$res = $this->M_crud->get($params,$tables);

			if ($res->num_rows() > 0)
			{			
				if ($res->row()->is_workin == 1)
				{
					$msg = array(
						"message" => "Transaksi sedang dalam proses workin"
					);
				}
			}
		}		

		$out = $this->_respon($res,$msg,"get");

		echo json_encode($out);
	}


	public function check_product()
	{
		$params = array(						
			"prod_id" => ifunsetempty($_POST,"id",""),
		);
		$data = array(
			"data"=>array()
		);

		$res = true;

		$res = $this->M_transaction_forstok->check_product($params);

		if($res->num_rows() > 0)
		{
			$row_data = $res->row_array();			
			$row_data["prod_id_new"] = ifunsetempty($row_data,"prod_id",0);
			$row_data["stock_akhir"] = ifunsetempty($row_data,"stock_akhir",0);
			$data["data"] = $row_data;
		}
		
		$out = $this->_respon($res,$data,"get");

		echo json_encode($out);
	}

	
}

/* End of file App.php */
/* Location: ./application/controllers/transaction/forstok/App.php */