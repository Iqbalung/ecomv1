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
			"parent_id" => $params["prod_id"],
			"files_upload" => json_decode(ifunsetempty($_POST,"files_upload","[]"),true)
		);
		
		$res_images = $this->simpan_images($args_images);
	
		$out = $this->_respon(($res && $res_images),false,"create");
		echo json_encode($out);

	}

	function simpan_images($args) {

		$doc_id = array_column($args["files_upload"], "doc_id");

		if (count($doc_id) > 0) {
			$params_del_doc = array(
				"notin_doc_id" => $doc_id,
				"parent_id" => $args["parent_id"],
			);
			$res_doc_del = $this->M_product->del_doc($params_del_doc);

			if ($res_doc_del) {
				
			}
		}

		 // File upload configuration
		$this->load->library('upload');
        $uploadPath = $this->config->item('path_client_upload_product');
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $res = true;
		if (isset($_FILES["files"])) {
			if (isset($_FILES["files"]["name"]) && is_array($_FILES["files"]["name"]) && count($_FILES["files"]["name"]) > 0) {
				foreach ($_FILES["files"]["name"] as $key => $value) {
					
					$seacrh = $this->custom_search($args["files_upload"],"name",$_FILES['files']['name'][$key]);
														
						
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
						$is_ubah = false;
						if (count($seacrh) > 0) {
							if (isset($seacrh[0]["isUbah"]) && $seacrh[0]["isUbah"]) {
								$is_ubah = true;
								$params["doc_id"] = $seacrh[0]["doc_id"];

							}
						}
					
						if ($is_ubah) {				
							$params["where"] = "doc_id";
							$params["where_value"] = $params["doc_id"];
							$res = $this->M_crud->upd($params,array("table_name"=>'document'));						
						} else {
							$res = $this->M_crud->create('document',$params);						
						}
						if (!$res) {
							$res = false;
							break;
						}
				}
			}
		}
		return $res;
	}

	function custom_search ($arr, $index, $search)
	{
		$r = array();
		foreach ($arr as $key => $val) {
		    if ($val[$index] === $search) {
		        $r[] = $val;
		    }
		}

		return $r;
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

	public function get_document()
	{
		$method = $_GET;
		$this->load->model("M_crud");
		$params = array();
		$params["where"] = array(			
			"doc_parentid" => ifunsetempty($method,"prod_id",''),
		);

		$res['document'] = $this->M_crud->get_where($params,"document")->result_array();
		
		$out = $this->_respon($res,$res,"get");

		echo json_encode($out);
	}
	
}

/* End of file Form.php */
/* Location: ./application/controllers/product/Form.php */