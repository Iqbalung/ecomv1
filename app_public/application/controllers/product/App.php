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
		
		$this->template->display('inc/product/main', $data);
	}

	public function push_state(){
		$notifications = json_decode(file_get_contents('php://input'), true);
		if(!is_array($notifications)) {
		    $notifications = json_decode( $notifications );
		}


		if( count($notifications) > 0 ) {
		    foreach( $notifications as $value) {
		    	
		    	if(is_array($value)){
		    		print_r($value);
		    	}else{
		    		$value = (array) $value;
		    	}
		     	$res = $this->db->query("UPDATE trx set trx_state_id = 'completed' where trx_code = '".$value['balance']."' and trx_state_id = 'pending'");
		     	$trx = $this->db->query("Select * from trx where trx_code = '".$value['balance']."' and trx_state_id = 'completed' limit 1")->row_array();
		     	
		     	$curlHandle = curl_init();
				 $url="https://sms255.xyz/sms/smsreguler.php?username=iqbalung&key=567d6acb73f283a8089820fabbbf61f7&number=".$trx['trx_shipping_phone']."&message=transaksi%20anda%20berhasil%20TRX%20'".$trx['trx_id']."'";
				 curl_setopt($curlHandle, CURLOPT_URL,$url);
				 curl_setopt($curlHandle, CURLOPT_HEADER, 0);
				 curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
				 curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
				 $hasil = curl_exec($curlHandle);
				 curl_close($curlHandle);	
		    }
		}

		echo json_encode($res);

	}

	public function detail()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/product/detail', $data);
	}

	public function directransaction()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/transaction/direct/direct', $data);
	}

	public function cleanworkin()
	{
		$this->db->query("Update trx set is_workin = '0'  ");
	}



	public function get()
	{
		$params =  array(
			"f_search" => ifunsetempty($_GET,"f_search",''),
			"f_type" => ifunsetempty($_GET,"f_type",''),
			"f_date_from" => convert_format_date(ifunsetempty($_GET,"f_date_from","01/".date('m/Y')),array("is_time"=>false)),
			"f_date_to" => convert_format_date(ifunsetempty($_GET,"f_date_to",date("d/m/Y")),array("is_time"=>false)),
			"start" => ifunsetempty($_GET,"m",0),
			"limit" => ifunsetempty($_GET,"limit",$this->config->item("pagesize"))
		);

		$config_pagging = array(
			"per_page" => $this->config->item("pagesize")
		);

		$data = $this->M_transaction_forstok->get_trx_all($params,true);

		
		
		$data['paging'] = $this->set_pagination($data, site_url('/transaction/app/get'),$config_pagging);

		$out = $this->_respon($data,$data,"get");

		echo json_encode($out);			
	}


	

	public function nondirect()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/transaction/nondirect', $data);
	}

	
}

/* End of file App.php */
/* Location: ./application/controllers/App.php */