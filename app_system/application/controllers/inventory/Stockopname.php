<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stockopname extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
			$this->load->model(array('M_crud',"M_purchase"));
	}

	

	public function search_product()
	{
		$params = array(
			"f_search" => ifunsetempty($_GET,"f_search",""),
			"where_search" => array("prod_name","prod_barcode")
		);

		$data = array(
			"data" => array()
		);
		$res = true;

		if (!empty($params["f_search"])) {
			
			$res =  $this->M_purchase->search_product($params);
			$arr = array();
			foreach ($res->result_array() as $key => $value) {
				$value['text'] = $value['prod_name'];
				$value['value'] = $value['prod_name'];
				$value['id'] = $value['prod_id'];
				$arr[] = $value;
			}

			$data["data"] = $arr;
		}

		$out = $this->_respon($res,$data,"get");
		echo json_encode($out);
	}

	public function get_product_by_name()
	{
		$data = $this->input->get();
		$table['table_name'] = "product";
		
		
		if(!isset($params['name'])){
			$params = array();
		}else{
			$params = $data['name'];
			$params = array(
			'where' => "prod_name",
			'where_value' => $params,
			);
		}
		$res =  $this->M_crud->get_like($params,$table)->result_array();
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

	public function get_suplier_by_name()
	{
		$data = $this->input->get();
		$table['table_name'] = "m_suplier";
		
		
		if(!isset($params['name'])){
			$params = array();
		}else{
			$params = $data['name'];
			$params = array(
			'where' => "suplier_name",
			'where_value' => $params,
			);
		}
		$res =  $this->M_crud->get_like($params,$table)->result_array();
		$arr = array();
		foreach ($res as $key => $value) {
			$value['text'] = $value['suplier_name'];
			$value['value'] = $value['suplier_name'];
			$value['id'] = $value['suplier_id'];
			$arr[] = $value;
		}
		$data = array('data' => $arr );
		echo json_encode($data);
	}

	public function save(){

		$res = false;
		$method = $_POST;
		$records = array();
		$prod_buy['table_name'] = "product_buy";
		$prod_stock['table_name'] = "product_stock";
		$count = 0;

		$data_user = (array) $this->get_data_user();

		$params = array(
			"buy_id" => ifunsetempty($method,"invoice_number",""),
			"suplier_id" => ifunsetempty($method,"suplier",""),			
			'buy_date' 			=>  date('Y-m-d', strtotime(str_replace('/', '-', ifunsetempty($method, 'buy_date', '')))),
			"buy_payment_method" => ifunsetempty($method,"payment_method",''),			
			'user_userid' => ifunsetempty($data_user,"user_userid",""),
			'buy_source' => 'STOCKOPNAME'
		);

		/*'TGLLAHIR' 			=>  date('Y-m-d', strtotime(str_replace('/', '-', ifunsetempty($_POST, 'TGLLAHIR', '')))),*/

		$item = array(
			"prod_id" => ifunsetempty($method,"prod_id",""),			
			"prod_stock" => ifunsetempty($method,"prod_stock",""),
			"wr_id" => ifunsetempty($method,"wr_id",""),
			"buy_price" => ifunsetempty($method,"buy_price",""),
			
		);

		$count = count($item['prod_id']);
		
		$count = $count-1;
		for ($i = 0; $i <= $count; $i++) {
			$temp = array();			
			$temp['buy_id'] = $params['buy_id'];
			$temp['prod_id'] = ifunsetempty($item['prod_id'],$i,"");
			$temp['prod_stock'] = ifunsetempty($item['prod_stock'],$i,"");
			$temp['wr_id'] = ifunsetempty($item['wr_id'],$i,"");
			$temp['buy_price'] = ifunsetempty($item['buy_price'],$i,"");
			$temp["prod_flag_source"] = ifunsetempty($method,"prod_flag_source","inventory");
			$res =  $this->M_crud->add($temp,$prod_stock);
		}
	
		$res =  $this->M_crud->add($params,$prod_buy);
		
		$out = $this->_respon($res,false,"CREATE");

		echo json_encode($out);

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