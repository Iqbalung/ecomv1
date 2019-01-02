<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->model("M_product");
		$this->load->model("M_crud");
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/product/form', $data);
	}

	public function save()
	{		
		$params = array(			    
		    "prod_id" => ifunsetempty($_POST,"prod_id",""),
		    "prod_code" => ifunsetempty($_POST,"prod_code",""),
		    "prod_name" => ifunsetempty($_POST,"prod_name",""),
		    "prod_name_short" => ifunsetempty($_POST,"prod_name_short",""),
		    "prod_colour" => ifunsetempty($_POST,"prod_colour",""),
		    "prod_desc" => ifunsetempty($_POST,"prod_desc",""),
		    "category_id" => ifunsetempty($_POST,"category_id",""),
		    "prod_suplier" => ifunsetempty($_POST,"prod_suplier",""),
		    "prod_barcode" => ifunsetempty($_POST,"prod_barcode",""),
		    "prod_stock_minimal" => ifunsetempty($_POST,"prod_stock_minimal",""),
		    "prod_piece" => ifunsetempty($_POST,"prod_piece","")
		);

		if (empty($params["prod_id"]))
		{
			$params['prod_id'] = $this->get_uuid();
			$res = $this->M_product->add($params);
		}
		else
		{
			$res = $this->M_product->update($params);
		}
		
		$args_images = array(
			"parent_id" => $params["prod_id"]
		);
		
		$res_images = $this->simpan_iamges($args_images);
	
		$out = $this->_respon(($res && $res_images),false,"create");
		echo json_encode($out);

	}

	function simpan_iamges($args) {

		 // File upload configuration
		$this->load->library('upload');
        $uploadPath = $this->config->item('path_client_upload_product');
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $res = true;
		if (isset($_FILES["files"])) {
			if (isset($_FILES["files"]["name"]) && is_array($_FILES["files"]["name"]) && count($_FILES["files"]["name"]) > 0) {
				foreach ($_FILES["files"]["name"] as $key => $value) {
						
					    $_FILES['file']['name']     = $_FILES['files']['name'][$key];
		                $_FILES['file']['type']     = $_FILES['files']['type'][$key];
		                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$key];
		                $_FILES['file']['error']     = $_FILES['files']['error'][$key];
		                $_FILES['file']['size']     = $_FILES['files']['size'][$key];
		                $name = $_FILES['file']['name'];
		                $filename = md5($name.time());
						$config['file_name'] = $filename;			
		                $this->upload->initialize($config);
			    		$this->upload->do_upload('file');
						$upload = $this->upload->data();
						//print_r($upload);					
						$params = array(										
							'doc_id' => $this->get_uuid(),
							'doc_name' => $filename.$upload['file_ext'],
							'doc_created' => date("Y-m-d H.i.s"),
							'doc_type' => $upload['file_type'],
							'doc_size' => $upload['file_size'],
							'doc_parentid' => ifunsetempty($args,"parent_id","")
						);
						$sort = $this->db->query("select IFNULL(max(sort),0)+1 as sort from document where doc_parentid = ? ",array($params['doc_parentid']))->row_array();
						$params['sort'] = $sort['sort'];
					
						$res = $this->M_crud->create('document',$params);						
						if (!$res) {
							$res = false;
							break;
						}
				}
			}
		}
		return $res;
	}

	public function create_wf(){
		$params = array(
			'prod_id' => $this->get_uuid(),
		);
		$data = $this->M_crud->create("product",$params);
		if($data){
			$out = array(
				'success' => true,
				'data' => $params['prod_id'],
			);		
		}else{
			$out = array(
				'success' => false,
			);	
		}
		echo json_encode($out);
	}

	public function get_variant(){
		$params = array(
			'prod_id' => ifunsetempty($_GET,"prod_id",""),
		);
		$data = $this->M_product->get_variant($params);
		if($data){
			$out = array(
				'success' => true,
				'data' => $params['prod_id'],
			);		
		}else{
			$out = array(
				'success' => false,
			);	
		}
		$out = $this->_respon($data,$data,"get");
		echo json_encode($out);
	}


	public function save_variant()
	{
		$params = array(			    
			    "prod_id" => ifunsetempty($_POST,"prod_id",""),
			    "varian_id" => ifunsetempty($_POST,"varian_id",""),
			    "varian_value" => ifunsetempty($_POST,"value",""),
			    "varian_stock" => ifunsetempty($_POST,"stock",""),
			);

		if (empty($params["varian_id"]))
		{
			$params['varian_id'] = $this->get_uuid();
			$res = $this->M_product->add_variant($params);
		}
		else
		{
			$res = $this->M_product->update_variant($params);
		}

		$out = $this->_respon($res,false,"create");
		echo json_encode($out);

	}

	public function del_variant()
	{
		$params = array(			    
			    "varian_id" => ifunsetempty($_POST,"varian_id",""),
			);

		
		$res = $this->M_product->delete_variant($params);
		

		$out = $this->_respon($res,false,"del");
		echo json_encode($out);

	}
	
}

/* End of file Form.php */
/* Location: ./application/controllers/product/Form.php */