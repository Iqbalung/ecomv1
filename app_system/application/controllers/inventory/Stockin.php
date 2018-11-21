<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stockin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_inventory");
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/inventory/stockin/main', $data);
	}

	public function get($args = array(), $is_pagging = false)
	{
		$params =  array(
			"start" => ifunsetempty($_GET,"m",0),
			"start" => ifunsetempty($_GET,"m",0),
			"f_search" => ifunsetempty($_GET,"f_search",""),
			"f_state" => ifunsetempty($_GET,"f_state",""),
			"f_date_from" => convert_format_date(ifunsetempty($_GET,"f_date_from","01/01/1970"),array("is_time"=>false)),
			"f_date_to" => convert_format_date(ifunsetempty($_GET,"f_date_to","01/01/2020"),array("is_time"=>false)),

			"limit" => ifunsetempty($_GET,"limit",$this->config->item("pagesize"))
		);

		$config_pagging = array(
			"per_page" => $this->config->item("pagesize")
		);

		$data = $this->M_inventory->get($params,true);
		
		$data['paging'] = $this->set_pagination($data, site_url('/transaction/forstok/get'),$config_pagging);

		$out = $this->_respon($data,$data,"get");

		echo json_encode($out);			
	}

	public function get_detail_transaction()
	{
		$params =  array(
			"buy_id" => ifunsetempty($_POST,"id","")
		);
		$data = array();
		$res = $this->M_inventory->get_trx_by_id($params);
		if ($res->num_rows() > 0)
		{
			$data["data"] = $res->row_array();
			$res_items = $this->M_inventory->get_items($params);
			$data["data_items"] = $res_items->result_array();
			$res_cost = $this->M_inventory->get_cost($params);
			foreach ($res_cost->result_array() as $key => $value) {
				$value["id_gen"] = "id_gen_cost-".$value["trx_cost_id"].time();
				$data["data_cost"][] = $value;
			}
			$res_state = $this->M_inventory->get_state($params);
			$data["data_state"] = $res_state->result_array();
		}

		$out = $this->_respon($data,$data,"get");
		echo json_encode($out);			
	}

	

	public function save()
	{
		$res = false;
		$method = $_POST;
		

		$params = array(
			"category_id" => ifunsetempty($method,"category_id",''),
			"category_name" => ifunsetempty($method,"category_name",''),
			"category_datecreated" => ifunsetempty($method,"category_datecreated",date("Y-m-d")),
			"category_dateupdated" => ifunsetempty($method,"category_dateupdated",date("Y-m-d"))
		);

		if (empty($params["category_id"]))
		{
			$params["category_id"] = $this->get_uuid();
			unset($params["category_dateupdated"]);
			$res = $this->M_category->add($params);
		}
		else
		{			
			unset($params["category_datecreated"]);
			$res = $this->M_category->update($params);
		}

		$out = $this->_respon($res,array());

		echo json_encode($out);
	}

	public function delete()
	{
		$res = false;
		$method = $_POST;		

		$params = array(
			"category_id" => ifunsetempty($method,"id",0)
		);

		$res = $this->M_category->delete($params);

		$out = $this->_respon($res,array(),"delete");

		echo json_encode($out);
	}
	
}

/* End of file App.php */
/* Location: ./application/controllers/master/Category.php */