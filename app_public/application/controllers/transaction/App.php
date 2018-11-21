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
		
		$this->template->display('inc/transaction/alltransaction', $data);
	}

	public function directransaction()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/transaction/direct/direct', $data);
	}
	
	public function detail()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/transaction/direct/detail', $data);
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

	public function add_to_cart(){
		$params = array(
			"prod_id" => $this->input->post('id'),
		);
		$res = $this->M_product->get_by($params)->row_array();

		$data = array( 
			array(
		        'id'      => $res['prod_id'],
		        'qty'     => 1,
		        'price'   => 12000,
		        'name'    => $res['prod_name'],
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
		foreach ($data as $key => $value) {
			$arr['data'][] = $value;
		}
		$arr['count'] = count($arr['data']);
		$out = $this->_respon($arr,$arr,"get");
		echo json_encode($out);
	}

	
}

/* End of file App.php */
/* Location: ./application/controllers/App.php */