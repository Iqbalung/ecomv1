<?php 

/**
 * 
 */
class Synchronize extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array("M_transaction","M_transaction_forstok"));		
	}

	function status_transaction()
	{	
		$params = array(
			"trx_state_id" => "shipped",
			"is_shipping" => true
		);
		
		while (true)
		{		
			$res = $this->M_transaction->get_transaction_by($params);
			if ($res->num_rows() > 0)
			{			
				foreach ($res->result_array() as $value) {
					$response = $this->check_status($value);		
					$out = $this->update_transaction($response);		
					echo json_encode($out);
					echo "\n";
				}
			}
			else
			{
				echo "Belum ada antrian shipped ".date('Y-m-d H:i:s')."\n";				
				sleep(10);
			}
		}
	}

	public function check_status($args = array())
	{
		$curl = curl_init();

		$params = array(
			"waybill" => ifunsetempty($args,"trx_shipping_code",""),
			"courier" => ifunsetempty($args,"courier_flag","jne"),
		);
		$postData = "";

		foreach($params as $k => $v) 
	   	{ 
	    	$postData .= $k . '='.$v.'&'; 
	   	}
	   	$postData = rtrim($postData, '&');

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/basic/waybill",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $postData,
		  CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded",
		    "key: ".$this->config->item('api_raja_ongkir')
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  $out = array(
		  	"success" => false,
		  	"error" => $err
		  );
		} else {
			$out = array(
			  	"success" => true,
			  	"response" => $response,
			  	"data_trx" => $args
			  );
		}
		return $out;
	}


	function update_transaction($args = array())
	{		
		if ($args["success"] == true)
		{
			$res = json_decode(ifunsetempty($args,"response","{}"),true);
			$res = $res["rajaongkir"];
			if ($res["status"]["code"] == 200)
			{
				$data_trx = ifunsetempty($args,"data_trx",array());
				$data = $res["result"];
				
				$is_delivered = (bool) ifunset($data,"delivered",false);
				
				$status = " on proses";

				if ($is_delivered)
				{
					
					$params_trx = array(
						"trx_id" => ifunsetempty($data_trx,"trx_id",""),
						"trx_state_id" => "delivered"
					);
					$delivered_status = $data["delivery_status"];

					$params_log = array(
						'trx_log_id' => $this->get_uuid(),
						'order_date' => ifunsetempty($delivered_status,"pod_date",date("Y-m-d"))." ".ifunsetempty($delivered_status,"pod_time",date("H:i")).":00",
						'trx_log_caption' => "delivered",
						'trx_id' => ifunsetempty($params_trx,"trx_id",""),			
						'trx_log_datecreated' => date("Y-m-d H:i:s"),
						'user_userid' => 'raja ongkir'	
					);
					if (!empty($params_trx["trx_id"]))
					{						
						$res_trx = $this->M_transaction_forstok->upd_trx($params_trx);
						$res_log = $this->M_transaction_forstok->add_log($params_log);
						$status = " is delivered";
					}
				}				

				$out = array(
					"success"=> true,
					"msg" => "Resi : ".$res["query"]["waybill"].$status
				);
			}
			else
			{				
				$out = array(
					"success"=> false,
					"msg" => "Resi : ".$res["query"]["waybill"]." ".$res["status"]["description"]
				);
			}			
		}		
		return $out;
	}

	public function get_uuid()
	{
		$q = $this->db->query("SELECT UUID() UID");		
		return $q->row()->UID;
	}
}