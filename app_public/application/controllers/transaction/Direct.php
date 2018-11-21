<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Direct extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
			$this->load->model(array('M_crud','M_transaction_forstok'));
	}

	
	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/transaction/direct/direct', $data);
	}


	public function get_product_by_name()
	{
		$res = false;
		$method = $_GET;
		$records = array();
		$count = 0;
		$no = 1;

		$params = array(
			"prod_name" => ifunsetempty($method,"prod_name",""),
		);
		
		$res =  $this->M_transaction_forstok->get_product($params)->result_array();
		$arr = array();
		foreach ($res as $key => $value) {
			$value['text'] = $value['prod_name'];
			$value['value'] = $value['prod_name'];
			$value['id'] = $value['prod_id'];
			$arr[] = $value;
		}
		$data = array('data' => $arr );
		echo json_encode($data);
	}

	public function save(){

		$res = false;
		$method = $_POST;
		$records = array();
		$trx['table_name'] = "trx";
		$trxitem['table_name'] = "trx_item";
		$count = 0;

		$params = array(
			"trx_id" => ifunsetempty($method,"invoice_number",""),
			"trx_invoice" => ifunsetempty($method,"invoice_number",""),
			"province" => ifunsetempty($method,"province",""),
			"city" => ifunsetempty($method,"city",""),
			"distric" => ifunsetempty($method,"distric",""),
			"province_text" => ifunsetempty($method,"province_text",""),
			"city_text" => ifunsetempty($method,"city_text",""),
			"distric_text" => ifunsetempty($method,"distric_text",""),
			"trx_notes" => ifunsetempty($method,"trx_notes",""),
			"trx_state_id" => "pending",
			"trx_type" => "direct",
			"trx_shipping_address_1" => ifunsetempty($method,"distric_text",""),
			"trx_shipping_code" => ifunsetempty($method,"trx_shipping_code",""),
			"trx_shipping_phone" => ifunsetempty($method,"trx_shipping_phone",""),
			"trx_payment_method" => ifunsetempty($method,"trx_payment_method",""),
			"trx_payment_term" => ifunsetempty($method,"trx_payment_term",""),
			"trx_customer_email" => ifunsetempty($method,"trx_customer_email",""),
			"trx_customer" => ifunsetempty($method,"trx_customer",""),
			"trx_invoice_mos" => ifunsetempty($method,"trx_invoice_mos",""),
			"trx_date" =>   date('Y-m-d', strtotime(str_replace('/', '-', ifunsetempty($method, 'trx_date', '')))),
			"trx_total" => ifunsetempty($method,"total",''),
			"trx_mos" => ifunsetempty($method,"trx_mos",''),
			"user_userid" => ifunsetempty($method,"total",''),
			"bank" => ifunsetempty($method,"bank",''),
			"trx_card_number" => ifunsetempty($method,"trx_card_number",''),
		);

		$item = array(
			"prod_id" => ifunsetempty($method,"prod_id",""),
		);

		$res =  $this->M_crud->add($params,$trx);		

		$this->load->model("M_product");

		foreach ($item['prod_id'] as $key => $value) {

			$params_product = array(
				"prod_id" => $value
			);

			$params_item = array(
				"item_id" => $this->get_uuid(),
				"prod_code" => "",
				"prod_price" => ifunsetempty($method["prod_price"],$key,""),
				"item_qty" => ifunsetempty($method["qty"],$key,""),
				"item_created" => date("Y-m-d"),
				"prod_id" => $value,
				"trxid" => $params["trx_id"],
				"item_unit" => ifunsetempty($method["unit"],$key,"")
			);

			$data_product = array();
			$res_product = $this->M_product->get_by($params_product);

			if ($res_product->num_rows() > 0)
			{
				$data_product = $res_product->row_array();
				$params_item["prod_code"] = ifunsetempty($data_product,"prod_code","");
			}

			$res_item =  $this->M_crud->add($params_item,$trxitem);			
		};
		
		
		echo json_encode(array('success' => true,'msg'=>'Transaction Success'));


	}

	public function get_product_by_sku($params){
		$table['table_name'] = "product";
		$params = array(
			'where' => "prod_id",
			'where_value' => $params,
		);
		$res =  $this->M_crud->get($params,$table)->row_array();
	}

	public function get_product_by_code()
	{
		$data = $this->input->post();
		$table['table_name'] = "product";
		
		
		if(!isset($data['code'])){
			$params = array();
		}else{
			$params = $data['code'];
			$params = array(
			'where' => "prod_barcode",
			'where_value' => $params,
			);
		}
		$res =  $this->M_crud->get($params,$table)->result_array();
		echo json_encode($res);
	}
	
}

/* End of file App.php */
/* Location: ./application/controllers/App.php */