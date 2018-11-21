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

		$out = $this->_respon($res,false,"create");
		echo json_encode($out);

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