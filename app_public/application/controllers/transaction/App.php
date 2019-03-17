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
			"prod_id" => $this->input->post('id'),
		);
		$res = $this->M_product->get_by($params)->row_array();

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
        $data['data'] = $res;
        $state = $this->db->query("
			SELECT trx_state_id,trx_customer_email FROM trx
			where trx_id = ?",$id['id'])->row_array();
       	$text_email = array (
          'Messages' => 
          array (
            0 => 
            array (
              'From' => 
              array (
                'Email' => 'iqbalung@gmail.com',
                'Name' => 'noreply',
              ),
              'To' => 
              array (
                0 => 
                array (
                  'Email' => $state['trx_customer_email'],
                  'Name' => 'Customer',
                ),
              ),
              'Subject' => 'Verification registration Mile',
              'TextPart' => 'Dear passenger 1, welcome to Mailjet! May the delivery force be with you!',
              'HTMLPart' => '
              
                    <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">

                          <tr>
                            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
                            <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
                              <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">
                    <img data-v-89fdde4e="" src="https://mile.app/ecf6b935bfc378921fd99dcd4780099a.png" style="width:100px;margin-left:40%;margin-bottom:25px;" class="logo">
                                <!-- START CENTERED WHITE CONTAINER -->
                                <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">This is preheader text. Some clients will show this text as a preview.</span>
                     <a href="http://htmlemail.io" target="_blank" style="display: inline-block;
                        color: #ffffff;
                        z-index:-100;
                        height:100px;
                    text-align:center;

                    margin-bottom:-5px;

                    background-color:#02a8f3;
                    border: solid 1px #fbfdff;
                    border-top-left-radius: 5px;
                    border-top-right-radius: 5px;
                    box-sizing: border-box;
                    cursor: pointer;
                    text-decoration: none;
                    font-size: 24px;
                    font-weight: bold;
                    padding: 12px 25px;
                    text-transform: capitalize;
                    border-color: #f9f9f9;width: 100%;">
                <br>Welcome Milers</a>
                            <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">

                              <!-- START MAIN CONTENT AREA -->
                              <tr>
                                <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
                                  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                    <tr>
                                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">

                <img src="https://mile.app/f8f8bd322511bd24ace7e8707c6263e8.png" class="hero-image" style="width:300px;text-align:center;margin-left:20%">
                                        
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 1px;text-align:center;margin-top:20px;">Thanks for joining <b>Mile</b>.</p><br>
                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 25px;text-align:center;">To Activate your account please click on the button below</p>
                                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                                          <tbody>
                                            <tr>
                                              <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                                  <tbody>
                                                    <tr>
                                                      <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: none; border-radius: 5px; text-align: center;Margin-left: 25px;width:400px"> </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                        <p style="font-family: sans-serif; font-size: 12px; font-weight: normal; margin: 0; Margin-bottom: 15px;margin-left:20%;">For more help, please send email to : support@mile.app</p>
                                        
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>

                            <!-- END MAIN CONTENT AREA -->
                            </table>

                            <!-- START FOOTER -->
                            <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
                              <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                                <tr>
                                  <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                    <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">copyright &copy; 2019 mile.app all right reserved.</span>
                                   
                                  </td>
                                </tr>
                                <tr>
                                  <td class="content-block powered-by" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                                   <a href="http://paket.id" style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">PT. Paket Informasi Digital</a>.
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <!-- END FOOTER -->

                          <!-- END CENTERED WHITE CONTAINER -->
                          </div>
                        </td>
                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
                      </tr>
                    </table>








             ',

            ),
          ),
        );

        $text_email = json_encode($text_email);
        try{
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mailjet.com/v3.1/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,

            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $text_email,
            CURLOPT_USERPWD => 'dea7c195cb5d0b5317d7c6f884661a48:f2d950931d744025ccea3cf877fa429b',
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "cache-control: no-cache"
            ),
            ));

            $response2 = curl_exec($curl);

            $err = curl_error($curl);

            curl_close($curl);
            print_r($response2);
            $out = array('success'=>false);
           
            
           
         }catch(Exception $e){
            dd($e);
         }
        if($state['trx_state_id']!="pending"){
        	$msg =  $this->load->view('inc/transaction/payment_information',$data,true);
        }else{
        	$msg =  $this->load->view('inc/transaction/payment_information2',$data,true);
        }
    
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