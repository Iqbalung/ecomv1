<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("master/M_product");
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/master/product/main', $data);
	}

	public function get()
	{
		$res = false;
		$method = $_GET;
		$records = array();
		$count = 0;
		$no = 1;

		$params = array(
			"f_search" => ifunsetempty($method,"f_search",""),
			"limit" => ifunsetempty($method,"limit",10),
			"start" => ifunsetempty($method,"start",0)
		);

		$res = $this->M_product->get($params);

		$no += $params["start"];
		
		if (isset($res["data"]) && is_array($res["data"]) && isset($res["count"]))
		{
			$count = $res["count"];
			foreach ($res["data"] as $key => $value) {
				$value["no"] = $no;
				$records[] = $value;
				$no++;
			}			
		}

		$data = array(
			"draw" => ifunsetempty($method,"draw",1),
	  		"recordsTotal" => $params["limit"],
	  		"recordsFiltered" => $count,
	  		"data" => $records
	  	);

		$out = $this->_respon($res,$data,"get");

		echo json_encode($out);
	}

	public function get_by_id($id)
	{
		$params = array(
			"prod_id" => $id,
		);

		$res['product'] = $this->M_product->get_by($params)->row_array();

		$res['variant'] = $this->M_product->get_variant($params);
		$out = $this->_respon($res,$res,"get");

		echo json_encode($out);
	}

	public function save()
	{
		$res = false;
		$method = $_POST;
		

		$params = array(
			"prod_id" => ifunsetempty($method,"prod_id",''),
			"prod_name" => ifunsetempty($method,"prod_name",'')			
		);

		if (empty($params["prod_id"]))
		{
			$params["prod_id"] = $this->get_uuid();			
			$res = $this->M_product->add($params);
		}
		else
		{						
			$res = $this->M_product->update($params);
		}

		$out = $this->_respon($res,array());

		echo json_encode($out);
	}

	public function delete()
	{
		$res = false;
		$method = $_POST;		

		$params = array(
			"prod_id" => ifunsetempty($method,"id",0)
		);

		$res = $this->M_product->delete($params);

		$out = $this->_respon($res,array(),"delete");

		echo json_encode($out);
	}
	
}

/* End of file App.php */
/* Location: ./application/controllers/App.php */