<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		header("Access-Control-Allow-Origin: *");
		$this->load->model("M_transaction_forstok");
		$this->load->model("master/M_product");
		$this->load->library('cart');
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/cart/main', $data);
	}

	public function myorder()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/transaction/myorder', $data);
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

		$data = $this->M_transaction_forstok->get_trx_customer($params,true);

		
		
		$data['paging'] = $this->set_pagination($data, site_url('/transaction/app/get'),$config_pagging);

		$out = $this->_respon($data,$data,"get");

		echo json_encode($out);			
	}

	public function add_to_cart(){
		$params = array(
			"prod_name" => $this->input->post('id'),
		);
		$res = $this->M_product->get_by_slug($params)->row_array();

		$data = array( 
			array(
		        'id'      => $res['prod_id'],
		        'qty'     => $this->input->post('qty'),
		        'price'   => $res['prod_price'],
		        'name'    => $res['prod_name'],
		        'size'    => $this->input->post('variant'),
		        'coupon'  => 'XMAS-50OFF'
			)
		);


		$out = $this->_respon(($data && $data),false,"CREATE");


		$this->cart->insert($data);

		echo json_encode($out);
	}

	public function del_cart(){
		$this->cart->insert($data);
	}

	public function get_cart(){
		$data = $this->cart->contents();
		
		$arr = array();

		if(count($data)>0){
			foreach ($data as $key => $value) {
				$arr['data'][] = $value;
			}
		}else{
			$arr['data'] = array();
		}
		$arr['count'] = count($arr['data']);
		$out = $this->_respon($arr,$arr,"get");
		echo json_encode($out);
	}

	public function checkout_proses(){
		$data = array(
			'data_app' => $this->get_data_app()
		);


		if($this->session->userdata('user')==""){
			header("Location:".site_url('login'));
		}
		
		
		$this->template->display('inc/transaction/checkout', $data);
	}

	public function checkout_proses_nonuser(){
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/transaction/checkout_nonuser', $data);
	}

	public function information_payment(){
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/transaction/payment_information', $data);
	}

	public function push_state(){
		$params = $this->input->post();
		print_r($params);		
	}

	public function get_trx_total(){
		$id = $this->input->get();
		$idx = $id['id']; 
		$res = $this->db->query("
			SELECT (trx_total+trx_cost_estimation_price) as total, floor(0+ RAND() * 1000) as kode_unik,trx_date, '$idx' as invoice_id FROM trx
			left join trx_cost on trx.trx_id = trx_cost.trx_id
			where trx.trx_id = ?",$id['id'])->row_array();
		$res['total_dibayar'] = $res['total']+$res['kode_unik'];
		$unik = $res['kode_unik'];
		try {
			$upd = $this->db->query("UPDATE trx set trx_code = '$unik' where trx_id = ?",$id['id']);
		} catch (Exception $e) {
			
		}
		echo json_encode($res);
		$this->load->library('email');
		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'premium66.web-hosting.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = '	_mainaccount@biyoz.com';
        $config['smtp_pass']    = 't3Zy407rH7AS';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['wordwrap'] =TRUE;
        $config['charset'] = 'utf-8';
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);

        $this->email->from('_mainaccount@biyoz.com', 'myname');
        $this->email->to('iqbalung@gmail.com'); 

        $this->email->subject('Email Test');
        $data['data'] = $res;
        $state = $this->db->query("
			SELECT trx_state_id FROM trx
			where trx_id = ?",$id['id'])->row_array();
        if($state['trx_state_id']!="pending"){
        	$msg =  $this->load->view('inc/transaction/payment_information',$data,true);
        }else{
        	$msg =  $this->load->view('inc/transaction/payment_information2',$data,true);
        }
        $this->email->message($msg);  

        $this->email->send();

	}

	public function confirm_order(){
		$params = $this->input->post();
			
		$data = $this->cart->contents();
		$trx['trx_id'] = $this->get_uuid();
		$arr = array();
		$trx['trx_total'] = 0;

		foreach ($data as $key => $value) {
			$arr[] = $value;

			$params2['prod_id'] =  $value['id'];
			$res = $this->M_product->get_by($params2)->row_array();
			$params_product['item_id'] = $this->get_uuid();
			$params_product['prod_code'] = $res['prod_code'];
			$params_product['prod_price'] = $res['prod_price'];
			$params_product['item_qty'] = $value['qty'];
			$params_product['prod_id'] = $value['id'];
			$params_product['trxid'] = $trx['trx_id'];
			$params_product['variant'] = $value['size'];
			$params_product['item_unit'] = "pack";
			$trx['trx_total'] = $trx['trx_total']+$value['subtotal'];
			$this->db->insert('trx_item',$params_product);
		}


		$params['shipping'] = json_decode($params['shipping'],true);
		$params_cost['trx_cost_id'] = $this->get_uuid();
		$params_cost['trx_id'] =  $trx['trx_id'];
		$params_cost['trx_cost_estimation_price'] =  $params['shipping']['cost'][0]['value'];
		$params_cost['trx_cost_type'] =  "shipping";
		$this->db->insert('trx_cost',$params_cost);



		$trx['trx_service_courier'] = $params['shipping']['description'];
		$trx['province'] = $params['province'];
		$trx['province_text'] = $params['province_text'];
		$trx['city'] = $params['city'];
		$trx['city_text'] = $params['city_text'];
		$trx['distric'] = $params['distric'];
		$trx['distric_text'] = $params['distric_text'];
		$trx['trx_payment_term'] = 'transfer';
		$trx['trx_type'] = 'online';
		$trx['trx_payment_method'] = 'transfer';
		$trx['trx_state_id'] = 'pending';
		$trx['trx_mos'] = "mos-Any-625c33b0-9b0f-11e8-adfd-0a0027000011";
		$trx['trx_customer'] = ifunsetempty($_POST,"nama",$this->session->userdata('user')['nama']);
		$trx['trx_customer_email'] = ifunsetempty($_POST,"email",$this->session->userdata('user')['email']);
		$trx['trx_shipping_address_2'] = ifunsetempty($_POST,"alamat",$this->session->userdata('user')['alamat']);
		$trx['trx_shipping_phone'] = ifunsetempty($_POST,"no_telp",$this->session->userdata('user')['no_telp']);
		$trx['user_userid'] = ifunsetempty($_POST,"no_telp",$this->session->userdata('user')['user_userid']);
		
		unset($params['shipping']);
		
		$res = $this->db->insert('trx',$trx);

		$out = $this->_respon($res,false,"update");
		$out['trx_id'] = $trx['trx_id'];
		$curlHandle = curl_init();
		$url="http://45.32.118.255/sms/smsmasking.php?username=iqbalung&key=567d6acb73f283a8089820fabbbf61f7&number=".$trx['trx_shipping_phone']."&message=transaksi%20anda%20berhasil%20silahkan%20segera%20melakukan%20pembayaran%20";
		curl_setopt($curlHandle, CURLOPT_URL,$url);
		curl_setopt($curlHandle, CURLOPT_HEADER, 0);
		curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlHandle, CURLOPT_TIMEOUT,120);
		$hasil = curl_exec($curlHandle);
		curl_close($curlHandle);	
		echo json_encode($out);
	}

	public function get_identitas_buyer(){
		echo json_encode($this->session->userdata('user'));
	}

	
}

/* End of file App.php */
/* Location: ./application/controllers/App.php */