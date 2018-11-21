<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simplelist extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('M_log','M_simplelist','M_crud'));
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/master/courier/main', $data);
	}

	public function unit(){
		$table['table_name'] = "simplelist";
		$params = array(
			'where' => "list_flag",
			'where_value' => "unit",
		);
		$res =  $this->M_crud->get($params,$table)->result_array();
		$arr = array();
		foreach ($res as $key => $value) {
			$value['text'] = $value['list_caption'];
			$value['id'] = $value['list_id'];
			$arr[] = $value;
		}
		$data = array('data' => $arr );
		echo json_encode($data);
	}

	public function payment_method(){
		$table['table_name'] = "simplelist";
		$params = array(
			'where' => "list_flag",
			'where_value' => "payment_method",
		);
		$res =  $this->M_crud->get($params,$table)->result_array();
		$arr = array();
		foreach ($res as $key => $value) {
			$value['text'] = $value['list_caption'];
			$value['id'] = $value['list_id'];
			$arr[] = $value;
		}
		$data = array('data' => $arr );
		echo json_encode($data);
	}

	public function payment_term(){
		$table['table_name'] = "simplelist";
		$params = array(
			'where' => "list_flag",
			'where_value' => "payment_term",
		);
		$res =  $this->M_crud->get($params,$table)->result_array();
		$arr = array();
		foreach ($res as $key => $value) {
			$value['text'] = $value['list_caption'];
			$value['id'] = $value['list_id'];
			$arr[] = $value;
		}
		$data = array('data' => $arr );
		echo json_encode($data);
	}

	public function mediasale(){
		$table['table_name'] = "m_mediasale";
		$params = array(
		);
		$res =  $this->M_crud->get($params,$table)->result_array();
		$arr = array();
		foreach ($res as $key => $value) {
			$value['text'] = $value['mos_name'];
			$value['id'] = $value['mos_id'];
			$arr[] = $value;
		}
		$data = array('data' => $arr );
		echo json_encode($data);
	}


	public function cost_type(){
		$table['table_name'] = "simplelist";
		$params = array(
			'where' => "list_flag",
			'where_value' => "cost_type",
		);
		$res =  $this->M_crud->get($params,$table)->result_array();
		$arr = array();
		foreach ($res as $key => $value) {
			$value['text'] = $value['list_caption'];
			$value['id'] = $value['list_id'];
			$arr[] = $value;
		}
		$data = array('data' => $arr );
		echo json_encode($data);
	}

	public function provinsi()
	{
		$provinsi = $this->_api_ongkir('province');
		$data = json_decode($provinsi, true);
		echo json_encode($data['rajaongkir']['results']);
	}

	public function kota($provinsi="")
	{
		if(!empty($provinsi))
		{
			if(is_numeric($provinsi))
			{
				$kota = $this->_api_ongkir('city?province='.$provinsi);	
				$data = json_decode($kota, true);
				echo json_encode($data['rajaongkir']['results']);		  					 
			}
			else
			{
				show_404();
			}
		}else{
	   		show_404();
	   	}
	}

	function _api_ongkir($data)
	{
	   	$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://api.rajaongkir.com/starter/".$data,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",		  
		  CURLOPT_HTTPHEADER => array(
		    "key: ganti api key"
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
		  return  $err;
		} else {
		  return $response;
		}
	}

	public function get_city($province_id){
			$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=$province_id",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: $this->api_key" // sesuai dengan api raja ongkir
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		   return json_decode($response);
		}
	}

	public function get_province(){
		$provinces = $this->rajaongkir->province();
		print_r($province);
	}

	public function province(){
			$api_key = '5f0b2b7dc71dd2bab399fbc0c11eeb43';
			$curl = curl_init();
 
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "key: $api_key"
			  ),
			));
 
			$response = curl_exec($curl);
			$response = json_decode($response);
			$err = curl_error($curl);
			curl_close($curl);
			return $response->rajaongkir->results;
 			
	}

	public function city(){
		$api_key = '5f0b2b7dc71dd2bab399fbc0c11eeb43';
		$curl = curl_init();
		$params = $this->input->post();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$params['province_id'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: $api_key"
		  ),
		));

		$response = curl_exec($curl);
		$response = json_decode($response);
		$err = curl_error($curl);
		curl_close($curl);
		return $response->rajaongkir->results;
 			
	}

	public function distric(){
		$api_key = '5f0b2b7dc71dd2bab399fbc0c11eeb43';
		$params = $this->input->post();
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".$params['city_id'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		    "key: $api_key"
		  ),
		));

		$response = curl_exec($curl);
		$response = json_decode($response);
		$err = curl_error($curl);
		curl_close($curl);
		return $response->rajaongkir->results;
 			
	}

	public function call_province(){
		$province = $this->province();
		$arr = array('data' =>$province , );
		echo json_encode($arr);
	}

	public function call_city(){
		$city = $this->city();
		$arr = array('data' =>$city , );
		echo json_encode($arr);
	}

	public function call_distric(){
		$distric = $this->distric();
		$arr = array('data' =>$distric , );
		echo json_encode($arr);
	}


	
}

/* End of file App.php */
/* Location: ./application/controllers/App.php */