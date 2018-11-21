<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

	public function __construct()
	{

		parent::__construct();
			$this->load->model(array('M_crud'));
			$this->load->library('cart');
	}

	public function get_riwayat()
	{
		$res =  $this->M_crud->get_riwayat()->result_array();
		echo json_encode($res);
	}

	public function get_kapal()
	{
		$table['table_name'] = "ship";
		$params = array();
		$res =  $this->M_crud->get($params,$table)->result_array();
		echo json_encode($res);
	}

	public function get_wilayah()
	{
		$table['table_name'] = "city";
		$params = array();
		$res =  $this->M_crud->get($params,$table)->result_array();
		echo json_encode($res);
	}

	public function get_rute()
	{
		$res =  $this->M_crud->get_route()->result_array();
		echo json_encode($res);
	}

	public function get_pencarian()
	{
		$params = $this->input->post();
		$res =  $this->M_crud->get_route_search($params)->result_array();
		echo json_encode($res);
	}

	public function get_member()
	{
		$params = array();
		$table['table_name'] = "member";
		$res =  $this->M_crud->get($params,$table)->result_array();
		echo json_encode($res);
	}

	public function index()
	{
		$table1['table_name'] = "ship";
		$table2['table_name'] = "city";
		$params = array();

		$data = array(
			'kapal' => $this->M_crud->get($params,$table1)->result_array(), 
			'wilayah' => $this->M_crud->get($params,$table2)->result_array(),
			'data_app' => $this->get_data_app()
		);
		$this->template->display('inc/dashboard/main_member', $data);
	}

	public function tambah_kapal($arg="")
	{
		$data = array(
			'ID_SASARAN' => $arg,
			'data_app' => $this->get_data_app()
		);

		
		$this->template->display('inc/kapal/tambah', $data);
	}

	public function tambah_rute($arg="")
	{
		$table1['table_name'] = "ship";
		$table2['table_name'] = "city";
		$params = array();
		$data = array(
			'kapal' => $this->M_crud->get($params,$table1)->result_array(), 
			'wilayah' => $this->M_crud->get($params,$table2)->result_array(),
			'data_app' => $this->get_data_app()
		);
		$this->template->display('inc/rute/tambah', $data);
	}

	public function tambah_wilayah($arg="")
	{
		$data = array(
			'ID_SASARAN' => $arg,
			'data_app' => $this->get_data_app()
		);

		$this->template->display('inc/wilayah/tambah', $data);
	}

	public function tambah_member($arg="")
	{
		$data = array(
			'ID_SASARAN' => $arg,
			'data_app' => $this->get_data_app()
		);		
		$this->template->display('inc/member/tambah', $data);
	}


	public function tambah_video($arg="")
	{
		$data = array(
			'ID_SASARAN' => $arg,
			'data_app' => $this->get_data_app()
		);

		
		$this->template->display('inc/news/tambah_video', $data);
	}

	public function tambah_galery($arg="")
	{
		$data = array(
			'ID_SASARAN' => $arg,
			'data_app' => $this->get_data_app()
		);

		
		$this->template->display('inc/news/tambah_galery', $data);
	}

	public function edit_news($value="")
	{
		$table['table_name'] = "news";
		$params = array(
			'where' => "id",
			'where_value' => $value,
		 );
		$data = array(
			'id' => $value,
			'data_app' => $this->get_data_app()
		);

		
		$this->template->display('inc/news/ubah', $data);
	}

	public function edit($value='')
	{
		$table['table_name'] = "news";
		$params = array(
			'where' => "id",
			'where_value' => $value,
		 );
		$res =  $this->M_crud->get($params,$table)->result_array();
		echo json_encode($res);
	}

	public function add()
	{
		$data = $this->input->post();
		$table['table_name'] = $data['table_name'];
		unset($data['table_name']);
		$config = array(
            'upload_path'   => FCPATH2."client/uploads",  
            'allowed_types' => '*'              
		);
		$res = $this->M_crud->add($data,$table);
		if($res){
			$out = array(
				'success' => true,
				'msg' => 'Berhasil Memperbaharui',
			);
		}else{
			$out = array(
				'success' => false,
				'msg' => 'Gagal Memperbaharui',
			);
		}
		echo json_encode($out);
	}

	public function get_detailrute(){
		$params = $this->input->post();
		$res = $this->M_crud->get_route_detail($params)->result_array();
		echo json_encode($res);
	}

	public function detailrute(){
		$data = array(
			'data_app' => $this->get_data_app()
		);
		$this->template->display('inc/rute/detail', $data);
	}

	public function addcart(){

		$query = $this->db->query("select uuid() as uuid")->row_array();
		$uid = $query['uuid'];
		$post = $this->input->post();
		$data = array(
	        'id'      => $uid,
	        'qty'     => $post['QTY'],
	        'name'   => $post['DESCRIPTION'],
	        'type'   => $post['TYPE'],
	        'term'   => $post['TERM'],
	        'price'   => "",
	        'size'   => $post['SIZE'],
	        'pickup_place' => $post['PICKUPPLACE'],
	        'date'    => $post['DATE'],
		);
		$this->cart->insert($data);
		$out = array(
			'success' => true,
			'msg' => 'Berhasil Memperbaharui',
		);
		echo json_encode($out);
	}

	function table_cart(){
		$this->load->view('/inc/table_cart');
	}

	function table_cart2(){
		$this->load->view('/inc/table_cart2');
	}

	function get_pencarian_booking(){
		$params = $this->input->post();
		$params['where'] = 'TRXID';
		$params['where_value'] = $params['TRXID'];
		$table['table_name'] = 'itenary';
		$res = $this->M_crud->get($params,$table)->result_array();
		echo json_encode($res);
	}

	function get_byinc(){
		$params = $this->input->post();
		$params['where'] = 'INQUIRY';
		$params['where_value'] = $params['INQUIRY'];
		$table['table_name'] = 'itenary';
		$res = $this->M_crud->get($params,$table)->result_array();
		echo json_encode($res);
	}

	function get_riwayat_byuser(){
		$res = $this->M_crud->get_riwayat_byuser()->result_array();
		echo json_encode($res);
	}


	function createinquiry(){
		$params = $this->input->post();
		$params['where'] = 'TRXID';
		$params['where_value'] = $params['TRXID'];
		$table['table_name'] = 'itenary';
		$query = $this->db->query("SELECT COUNT(*)+1 AS uuid FROM `itenary`")->row_array();
		$uid = $query['uuid'];
		$params['INQUIRY'] = "BL-".date('dm')."00".$uid;
		$res = $this->M_crud->upd($params,$table);
		$res = $this->M_crud->get($params,$table)->result_array();
		echo json_encode($res);
	}

	function upd_itenary(){
		$params = $this->input->post();
		$params['where'] = 'TRXID';
		$params['where_value'] = $params['TRXID'];
		$table['table_name'] = 'itenary';
		$res = $this->M_crud->upd($params,$table);
			foreach ($this->cart->contents() as $key => $value) {
				$params = array(
					'ROUTEID' => $value['id'],  
					'TRXID' => $params['TRXID'],  
			        'QTY'     => $value['qty'],
			        'TYPE'   => $value['type'],
			        'TERM'   => $value['term'],
			        'PRICE'   => $value['type'],
			        'SIZE'   => $value['size'],
			        'NAME' => $value['name'],
			        'PICKUPPLACE' => $value['pickup_place'],
			        'DATE'    => $value['date'],  
				);
				$table2['table_name'] = "item2";
				$res = $this->M_crud->add($params,$table2);
			}
			$this->cart->destroy();
			$out = array(
						'success' => true,
						'msg' => 'Success' ,
			);
			echo json_encode($out);
	}

	public function add_rute()
	{
		$data = $this->input->post();
		$table['table_name'] = "route";
		$data['DATE'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['DATE'])));
		unset($data['table_name']);
		$config = array(
            'upload_path'   => FCPATH2."client/uploads",  
            'allowed_types' => '*'              
		);
		$res = $this->M_crud->add($data,$table);
		if($res){
			$out = array(
				'success' => true,
				'msg' => 'Berhasil Memperbaharui',
			);
		}else{
			$out = array(
				'success' => false,
				'msg' => 'Gagal Memperbaharui',
			);
		}
		echo json_encode($out);
	}

	function finish(){
			$query = $this->db->query("SELECT COUNT(*)+1 AS uuid FROM `itenary`")->row_array();
			$uid = $query['uuid'];
			$itenary = $this->input->post();
			$itenary = array(
				"TRXID" => $itenary['code_start']."00".$uid, 
				"MEMBERID" => $this->session->userdata('userid'), 
				"DATE" => $itenary["date"],
				"COMODITY" => $itenary["COMODITY"],
				"PIC" => $itenary["PIC"],
				"MOBILE" => $itenary["MOBILE"],
				"TELEPHONE" => $itenary["TELEPHONE"],
				"DATE" => $itenary["date"],
				"TERM" => $itenary["TERM"],
				"NAME_START" => $itenary["name_start"],
				"NAME_DEST" => $itenary["name_dest"],
				"MOBILENO2" => $itenary["MOBILENO2"],
				"FAX" => $itenary["FAX"],
				"VESSEL" => $itenary["vessel"],
				"WEIGHT" => $itenary["WEIGHT"]
			);
			$table1['table_name'] = "itenary";
			$res = $this->M_crud->add($itenary,$table1);
			foreach ($this->cart->contents() as $key => $value) {
				$params = array(
					'ROUTEID' => $value['id'],  
					'TRXID' => $itenary['TRXID'],  
			        'QTY'     => $value['qty'],
			        'TYPE'   => $value['type'],
			        'TERM'   => $value['term'],
			        'PRICE'   => $value['type'],
			        'SIZE'   => $value['size'],
			        'NAME' => $value['name'],
			        'PICKUPPLACE' => $value['pickup_place'],
			        'DATE'    => $value['date'],  
				);
				$table2['table_name'] = "item";
				$res = $this->M_crud->add($params,$table2);
			}
			$this->cart->destroy();
			$out = array(
						'success' => true,
						'msg' => 'Success Your Booking Kode is '.$itenary['TRXID'] ,
			);
			echo json_encode($out);
	}


	
	public function cetak_invoice()
	{		
		$par = $this->input->get();
		$params = $par;
		$params['where'] = 'TRXID';
		$params['where_value'] = $params['TRXID'];
		$table['table_name'] = 'itenary';
		$table2['table_name'] = 'item';
		$itenary = $this->M_crud->get_riwayat_byid($par)->row_array();
		$template = $this->config->item("path_client_tpl")."/perjanjian_kerja/invoice.docx";
		$output_file_name = "invoice.".date("Y/m/d").".docx";
		$item = $this->M_crud->get($params,$table2)->result_array();
		$TBS = $this->template_cetak->createNew("docx",$template);
		$data = array();
		foreach ($item as $key => $value) {
			if($value['NAME']==""){
				$value['NAME'] = "-";
			} 
			$data[] = $value;
		}
		$TBS->MergeBlock("item",$data);
		$TBS->MergeField("MEMBER_NAME",$itenary['USERNAME']);
		$TBS->MergeField("TRXID",$itenary['TRXID']);
		$TBS->MergeField("DATENOW", date("Y/m/d"));
		$TBS->MergeField("NAME_DEST",$itenary['NAME_DEST']);
		$TBS->MergeField("VESSEL",$itenary['VESSEL']);
		$TBS->MergeField("INQUIRY",$itenary['INQUIRY']);
		$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
	}


	public function cetak_bl()
	{		
		$par = $this->input->get();
		$params = $par;
		$params['where'] = 'TRXID';
		$params['where_value'] = $params['TRXID'];
		$table['table_name'] = 'itenary';
		$table2['table_name'] = 'item';
		$itenary = $this->M_crud->get_riwayat_byid($par)->result_array();
		$template = $this->config->item("path_client_tpl")."/perjanjian_kerja/bol.docx";
		$output_file_name = "bol.".date("Y/m/d").".docx";
		$item = $this->M_crud->get($params,$table2)->result_array();
		$TBS = $this->template_cetak->createNew("docx",$template);
		$TBS->MergeField("DATENOW", date("Y/m/d"));
		$TBS->MergeField("SHIPER_NAME",$itenary[0]['SHIPER_NAME']);
		$TBS->MergeField("SHIPER_INFO",$itenary[0]['SHIPER_INFO']);
		$TBS->MergeField("MEMBER_NAME",$itenary[0]['MEMBER_NAME']);
		$TBS->MergeField("NAME_START",$itenary[0]['NAME_START']);
		$TBS->MergeField("NAME_DEST",$itenary[0]['NAME_DEST']);
		$TBS->MergeField("VESSEL",$itenary[0]['VESSEL']);
		$TBS->MergeField("WEIGHT",$itenary[0]['WEIGHT']);
		$TBS->MergeField("CONTAIG_NAME",$itenary[0]['CONTAIGNE_NAME']);
		$TBS->MergeField("CONTAIG_INFO",$itenary[0]['CONTAIGNE_INFO']);
		$TBS->MergeField("INQUIRY",$itenary[0]['INQUIRY']);
		$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
	}

}

/* End of file App.php */
/* Location: ./application/controllers/dashboard/App.php */