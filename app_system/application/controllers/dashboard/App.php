<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
			$this->load->model(array('M_crud'));
	}

	public function get_coco() {
		$Date = "2010-09-17";
		echo date('Y-m-d', strtotime($Date. ' - 7 days'));
	}

	public function get_kapal()
	{
		$table['table_name'] = "ship";
		$params = array();
		$res =  $this->M_crud->get($params,$table)->result_array();
		echo json_encode($res);
	}

	public function get_order(){
		$res =  $this->M_crud->get_order()->result_array();
		echo json_encode($res);
	}

	public function simpanbooking(){
		$data = $this->input->post();
		$data['ID'] = $this->session->userdata('userid');
		print_r($this->session->all_userdata());
		$res = $this->db->insert("itenary",$data);
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

	public function get_member()
	{
		$params = array();
		$table['table_name'] = "member";
		$res =  $this->M_crud->get($params,$table)->result_array();
		echo json_encode($res);
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		$this->template->display('inc/dashboard/index', $data);
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

	public function add_rute()
	{
		$data = $this->input->post();
		$table['table_name'] = "route";
		$data['DATE'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['DATE'])));
		$data['DATEARV'] = date('Y-m-d', strtotime(str_replace('/', '-', $data['DATEARV'])));
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


	public function upd()
	{
		$table['table_name'] = "news";
		$data = $this->input->post();
		$config = array(
            'upload_path'   => FCPATH2."client/uploads",  
            'allowed_types' => '*'              
		);

		if($_FILES['userfile']['name']!=""){
	    	$this->load->library('upload', $config);
	    	if (! $this->upload->do_upload()) {
		        $error = array('error' => $this->upload->display_errors()); 
		        print_r($error);
		    }else { 

		        $upload = $this->upload->data();
		      	$data['gambar'] = $upload['file_name'];
		    } 
		}
		$data['where'] = 'id';
		$data['where_value'] = $data['id'];
		$res = $this->M_crud->upd($data,$table);
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
}

/* End of file App.php */
/* Location: ./application/controllers/dashboard/App.php */