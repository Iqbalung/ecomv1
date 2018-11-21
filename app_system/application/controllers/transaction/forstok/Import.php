<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->PhpExcel = null;
		$this->load->model(array("M_transaction_forstok"));
		$this->load->library('cetak_phpexcel');
	}

	function index()
	{
		$res = $this->_readFIle();
		if ($res["success"]) {
			$this->_initialize_template($res);
			$this->_processData();
		}
		else
		{			
			echo json_encode($res);
		}		
	}

	public function download_template()
	{
		$this->load->helper('download');
		$template = config_item('path_client_tpl')."/lapor_diri/Template Import Lapor Diri.xlsx";
		force_download($template, NULL);
	}

	private function _readFIle()
	{
		$time = time();

		$this->load->library('upload'); 

		$res = array('file' => '', 'error' => "File tidak ada");
		$out = false;
		if (isset($_FILES['data_forstok']['name']) && !empty($_FILES['data_forstok']['name']))
		{
			
			$filename = $time.$_FILES['data_forstok']['name'];
			$config['upload_path'] = config_item('path_client_upload_forstok');
			$config['allowed_types'] = 'xlsx|xls';
			$config['max_size'] = '4096';
			$config['overwrite'] = true;
			$config['file_name'] = $filename;

			$this->upload->initialize($config); 
			if($this->upload->do_upload('data_forstok')){ 
			    $res = array('file' => $this->upload->data(), 'error' => '');
			    $out = $this->_respon(true,$res);
			}else{
			    $res = array('file' => '', 'error' => $this->upload->display_errors());
			    $out = $this->_respon(false,$res);
			}		
		}

		return $out;               
	}

	public function _initialize_template($args = array())
	{
		$file = ifunsetempty($args,"file",array());
		if (isset($file["file_name"])) {
			$template = config_item("path_client_upload_forstok").$file["file_name"];			
			if (file_exists($template))
			{
				$this->PhpExcel = $this->cetak_phpexcel->loadTemplate($template);		

        		unlink($template);
			}
		}
	}

	private function _get_references_value($data,$ref_value,$ref_soucre)
	{

		$val = "";

		$type = $ref_soucre["type"];	
		$name_value = ifunsetempty($ref_soucre,"name_value","list_id");

		$index = strtolower(str_replace(" ", "_", $ref_soucre["source"])).'.'.
					strtolower(str_replace(" ", "_", $ref_value)).'.'.
					strtolower(str_replace(" ", "_", $type));

		// echo $index;
		// echo json_encode($data);					
		// exit;

		if(isset($data[$index])){			
			$val = ifunsetempty($data[$index],$name_value,"");
		}

		if(isset($ref_soucre["type_data"])){
			switch ($ref_soucre["type_data"]) {
				case 'int':
					$val = (int) $val;
					break;
				case 'null':
					if(empty($val)){
						$val = null;
					}					
					break;
				default:						
					break;
			}				
		}		
		return $val;
	}
	
	private function _get_ref_lis($type)
	{
		$this->load->model("M_simplelist");
		$args = array(
			"flag" => $type
		);
		$res = $this->M_simplelist->get($args);
		$data = array();
		foreach ($res->result_array() as $key => $value) {
			$index = "simple_list.".
					strtolower(str_replace(" ", "_", $value["list_caption"])).'.'.
					strtolower(str_replace(" ", "_", $value["list_flag"]));
			$data[$index] = $value;
		}

		return $data;
	}

	private function _get_state_trx()
	{
		$this->load->model("M_simplelist");
		$args = array(
			
		);
		$res = $this->M_simplelist->get_state_trx($args);
		$data = array();
		foreach ($res->result_array() as $key => $value) {
			$index = "m_state_trx.".strtolower(str_replace(" ", "_", $value["trx_state_id"])).".status_transaction";					
			$data[$index] = $value;
		}

		return $data;
	}

	private function _get_mediasale()
	{
		$this->load->model("master/M_mediasale");
		$args = array(
			
		);
		$res = $this->M_mediasale->get_all();
		$data = array();
		foreach ($res->result_array() as $key => $value) {
			$index = "m_mediasale.".strtolower(str_replace(" ", "_", $value["mos_name"])).".channel";					
			$data[$index] = $value;
		}

		return $data;
	}

	private function _get_courier()
	{
		$this->load->model("master/M_courier");
		$args = array(
			
		);
		$res = $this->M_courier->get_all();
		$data = array();
		foreach ($res->result_array() as $key => $value) {
			$index = "m_courier.".strtolower(str_replace(" ", "_", $value["courier_name"])).".courier";					
			$data[$index] = $value;
		}

		return $data;
	}

	private function _processData($is_save = true)
	{		
		if ($this->PhpExcel)
		{
			$count = 0;
			$data = $this->_get_data();

			$this->_add_transaction($data);

			foreach ($data as $key => $value)
			{
				$count++;
				$this->_add_item($value);				
			}
								
			echo json_encode(array('success'=>TRUE, 'msg'=>"Success import $count data","data"=>$data));
		}
		else
		{
			echo json_encode(array('success'=>false, 'msg'=>"Failed import"));	
		}
		
	}

	private function _get_data()
	{
		ini_set('memory_limit', '-1');
		$data = array();
		$count = 0;

		if ($this->PhpExcel)
		{
			
			$sheet = $this->PhpExcel->getActiveSheet();
			$rows = 2;
			$date_format = array("order_date");
			$datetime_format = array("order_date");
			$temp_params = array(); //tempat menyimpan data text untuk referensi

			$columns = array(				
				array(
					'key' => 'A',
					'name' => 'order_date',						
				),
				array(
					'key' => 'B',
					'name' => 'paid_date',						
				),
				array(
					'key' => 'C',
					'name' => 'canceled',						
				),
				array(
					'key' => 'D',
					'name' => 'status',
					'source' => "state_list"
				),					
				array(
					'key' => 'E',
					'name' => 'sales_order_id',						
				),
				array(
					'key' => 'F',
					'name' => 'channel',		
					'source' => "mediasale",
				),
				array(
					'key' => 'G',
					'name' => 'channel_order_id',						
				),
				array(
					'key' => 'H',
					'name' => 'shipping_courier',						
				),
				array(
					'key' => 'I',
					'name' => 'courier',	
					'source' => "courier",
				),
				array(
					'key' => 'J',
					'name' => 'awb',						
				),
				array(
					'key' => 'K',
					'name' => 'costumer_name',						
				),
				array(
					'key' => 'L',
					'name' => 'customer_email',						
				),
				array(
					'key' => 'M',
					'name' => 'currency_code',						
				),
				array(
					'key' => 'N',
					'name' => 'item_name',						
				),
				array(
					'key' => 'O',
					'name' => 'sku',						
				),
				array(
					'key' => 'P',
					'name' => 'warehouse',						
				),
				array(
					'key' => 'Q',
					'name' => 'quantity',						
				),
				array(
					'key' => 'R',
					'name' => 'selling_price',						
				),
				array(
					'key' => 'S',
					'name' => 'sub_total',						
				),
				array(
					'key' => 'T',
					'name' => 'vat',						
				),
				array(
					'key' => 'U',
					'name' => 'shipping',						
				),
				array(
					'key' => 'V',
					'name' => 'discount',						
				),
				array(
					'key' => 'W',
					'name' => 'gross_sales',						
				),
				array(
					'key' => 'X',
					'name' => 'shipping_name',						
				),
				array(
					'key' => 'Y',
					'name' => 'shipping_address_1',						
				),
				array(
					'key' => 'Z',
					'name' => 'shipping_address_2',						
				),
				array(
					'key' => 'AA',
					'name' => 'shipping_city',						
				),
				array(
					'key' => 'AB',
					'name' => 'shipping_zip'
				),
				array(
					'key' => 'AC',
					'name' => 'shipping_prov',						
				),
				array(
					'key' => 'AD',
					'name' => 'shipping_country',						
				),
				array(
					'key' => 'AE',
					'name' => 'shipping_phone',						
				),
				array(
					'key' => 'AF',
					'name' => 'notes'
				)
			);		

			$columns_state = array(
				"status" => 
					array(
						"source" => "m_state_trx",
						"type" => "status_transaction",
						"name_value" => "trx_state_id",
						"type_data" => "null",
					),				
			);

			$columns_mos = array(
				"channel" => 
					array(
						"source" => "m_mediasale",
						"type" => "channel",
						"name_value" => "mos_id",
						"type_data" => "null",
					)				
			);

			$columns_courier = array(
				"courier" => 
					array(
						"source" => "m_courier",
						"type" => "courier",
						"name_value" => "courier_id",
						"type_data" => "null",
					)				
			);

			//$ref_list = $this->_get_ref_lis(array_column($columns_reference, 'type'));

			$columns_reference = array(
				"simplelist" => array(),
				"state_list" => $columns_state,
				"mediasale" => $columns_mos,
				"courier" => $columns_courier,
			);

			$referensi = array(
				"simplelist" => array(),
				"state_list" => $this->_get_state_trx(),
				"mediasale" => $this->_get_mediasale(),
				"courier" => $this->_get_courier()
			);
			
			while ($sheet->getCell("A$rows")->getValue() !== NULL && $sheet->getCell("A$rows")->getValue() !== '')
			{
				$params = array();

				foreach ($columns as $key => $value)
				{					
					$def_val = ifunsetempty($value,"default_value","");
					$params[$value["name"]] = $def_val;
				}

				$temp_params = array(); //tempat menyimpan data text untuk referensi

				foreach ($columns as $key => $value) {
					$column = $value["key"]; // B or C etc
					$string_param = $value["name"]; // order_date, trx_courier, etc

					if(in_array($string_param, $date_format))
					{
						$value_cell = $sheet->getCell("$column$rows")->getValue();
						if(!empty($value_cell))
						{						
							$config_date = array(
								"old_separator" => "/",
								"new_separator" => "-",
								"order_date" => array(2,1,0)							
							);
							$value_cell = convert_format_date($value_cell,$config_date);
						}
						else
						{
							if(isset($params[$string_param]))
							{
								unset($params[$string_param]);
							}
						}
					}
					else if(in_array($string_param, $datetime_format))
					{
						$value_cell = $sheet->getCell("$column$rows")->getValue();
						if(!empty($value_cell)){						
							$config_date = array(
								"old_separator" => "/",
								"new_separator" => "-",
								"order_date" => array(2,1,0),
								"is_time" => true,
								"old_separator_time" => ":",
								"new_separator_time" => ":",
								"order_time" => array(0,1,2)							
							);
							$value_cell = convert_format_date($value_cell,$config_date);
						}else{
							if(isset($params[$string_param])){
								unset($params[$string_param]);
							}
						}
					}else{
						$value_cell = $sheet->getCell("$column$rows")->getFormattedValue();
					}

					$value_cell = ($value_cell === '' || $value_cell === NULL) ? ifunsetempty($params,$string_param,"") : $value_cell; // set default value;
					
			

					if (isset($value["source"]) && !empty($value["source"])) {
						if (isset($columns_reference[$value["source"]][$string_param])) {
							$ref = $columns_reference[$value["source"]][$string_param];						
							$value_cell = $this->_get_references_value($referensi[$value["source"]],$value_cell,$ref);
						}											
					}
									
					if(isset($params[$string_param])){
						$params[$string_param] = $value_cell; // overwrite value of each index in variable $params														
					}

				}

				$data[] = $params;
				$rows++;			
			}
			
		}

		return $data;
	
	}

	private function _add_transaction($args = array())
	{
		$data = array();

		foreach ($args as $key => $value)
		{
			$change = array(
				"/" => "",
				"\\/" => "",
				" " => "_"				
			);

			$name = str_replace(array_keys($change), array_values($change), $value["sales_order_id"]);
			if (!isset($data[$name])) {
				$data[$name] = array();
			}

			$data[$name] = $value;
		}

		foreach ($data as $key => $value) {					
			$this->_add_trx($value);
			$this->_add_log($value);
		}
	}
	
	private function _add_trx($args)
	{

		$data_user = (array) $this->get_data_user();

		$trx_id = ifunsetempty($args,"sales_order_id","");

		$params_trx = array(
			"trx_id" => $trx_id
		);

		$res_trx = $this->M_transaction_forstok->get_trx_by_id($params_trx);
		$res = true;

		if ($res_trx->num_rows() == 0)
		{			
			$params = array(
				'trx_type' => 'auto',
				'trx_date' => ifunsetempty($args,"order_date",date("Y-m-d H.i.s")),
				'trx_state_id' => ifunsetempty($args,"status_","pending"),
				'trx_id' => $trx_id,
				'trx_courier' => ifunsetempty($args,"courier",""),
				'trx_mos' => ifunsetempty($args,"channel",""),
				'trx_invoice_mos' => ifunsetempty($args,"channel_order_id",""),
				'trx_customer' => ifunsetempty($args,"costumer_name",""),
				'trx_customer_email' => ifunsetempty($args,"customer_email",""),
				'trx_shipping_name' => ifunsetempty($args,"shipping_name",""),
				'trx_shipping_address_1' => ifunsetempty($args,"shipping_address_1",""),
				'trx_shipping_address_2' => ifunsetempty($args,"shipping_address_2",""),
				'trx_shipping_city' => ifunsetempty($args,"shipping_city",""),
				'trx_shipping_zip' => ifunsetempty($args,"shipping_zip",""),
				'trx_shipping_city' => ifunsetempty($args,"shipping_city",""),
				'trx_shipping_prov' => ifunsetempty($args,"shipping_prov",""),
				'trx_shipping_country' => ifunsetempty($args,"shipping_country",""),
				'trx_shipping_phone' => ifunsetempty($args,"shipping_phone",""),
				'trx_notes' => ifunsetempty($args,"notes",""),
				'user_userid' => ifunsetempty($data_user,"user_userid",""),
			);	
			
			$res = $this->M_transaction_forstok->add_trx($params);
		}


		return $res;
	}

	private function _add_log($args)
	{

		$data_user = (array) $this->get_data_user();

		$params = array(
			'trx_log_id' => $this->get_uuid(),
			'order_date' => ifunsetempty($args,"order_date",date("Y-m-d H.i.s")),
			'trx_log_caption' => ifunsetempty($args,"status_","pending"),
			'trx_id' => ifunsetempty($args,"sales_order_id",""),			
			'trx_log_datecreated' => date("Y-m-d H:i:s")
		);	

		$res = $this->M_transaction_forstok->add_log($params);

		return $res;
	}


	public function _add_item($args =  array())
	{
		$data_user = (array) $this->get_data_user();

		$this->load->model("master/M_product");

		$params_product = array(
			"prod_code" => ifunsetempty($args,"sku","-")
		);

		$res_product = $this->M_product->get_by($params_product);
		$res = false;
		if ($res_product->num_rows() > 0)
		{			
			$data_product = $res_product->row_array();

			$params = array(
				'item_id' => $this->get_uuid(),
				'prod_code' => ifunsetempty($data_product,"prod_code",""),
				'prod_price' => ifunsetempty($data_product,"prod_price",""),
				'item_qty' => ifunsetempty($args,"quantity",""),				
				'item_created' => ifunsetempty($args,"item_created",date("Y-m-d")),
				'prod_id' => ifunsetempty($data_product,"prod_id","-"),
				'prod_width' => ifunsetempty($data_product,"prod_width",0),
				'prod_height' => ifunsetempty($data_product,"prod_height",0),
				'prod_weight' => ifunsetempty($data_product,"prod_weight",0),
				'trxid' => ifunsetempty($args,"sales_order_id",""),
				'prod_category' => ifunsetempty($data_product,"category_id",0)				
			);	

			$res = $this->M_transaction_forstok->add_item($params);
		}


		return $res;
	}
}

/* End of file Form.php */
/* Location: ./application/controllers/lapor_diri/Form.php */