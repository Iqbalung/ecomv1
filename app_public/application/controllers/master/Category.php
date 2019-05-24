<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("master/M_category");
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/master/category/main', $data);
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

		$res = $this->M_category->get($params);

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

	public function save()
	{
		$res = false;
		$method = $_POST;
		

		$params = array(
			"category_id" => ifunsetempty($method,"category_id",''),
			"category_name" => ifunsetempty($method,"category_name",''),
			"category_datecreated" => ifunsetempty($method,"category_datecreated",date("Y-m-d")),
			"category_dateupdated" => ifunsetempty($method,"category_dateupdated",date("Y-m-d"))
		);


		if (empty($params["category_id"]))
		{
			$params["category_id"] = $this->get_uuid();
			unset($params["category_dateupdated"]);
			$res = $this->M_category->add($params);
		}
		else
		{			
			unset($params["category_datecreated"]);
			$res = $this->M_category->update($params);
		}

		$out = $this->_respon($res,array());

		echo json_encode($out);
	}

	public function delete()
	{
		$res = false;
		$method = $_POST;		

		$params = array(
			"category_id" => ifunsetempty($method,"id",0)
		);

		$res = $this->M_category->delete($params);

		$out = $this->_respon($res,array(),"delete");

		echo json_encode($out);
	}
	
}

/* End of file App.php */
/* Location: ./application/controllers/master/Category.php */