<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Material extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("master/M_material");
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/master/material/main', $data);
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

		$res = $this->M_material->get($params);

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
			"material_id" => ifunsetempty($method,"material_id",''),
			"material_name" => ifunsetempty($method,"material_name",''),
			"material_datecreated" => ifunsetempty($method,"material_datecreated",date("Y-m-d")),
			"material_dateupdated" => ifunsetempty($method,"material_dateupdated",date("Y-m-d"))
		);

		if (empty($params["material_id"]))
		{
			$params["material_id"] = $this->get_uuid();
			unset($params["material_dateupdated"]);
			$res = $this->M_material->add($params);
		}
		else
		{			
			unset($params["material_datecreated"]);
			$res = $this->M_material->update($params);
		}

		$out = $this->_respon($res,array());

		echo json_encode($out);
	}

	public function delete()
	{
		$res = false;
		$method = $_POST;		

		$params = array(
			"material_id" => ifunsetempty($method,"id",0)
		);

		$res = $this->M_material->delete($params);

		$out = $this->_respon($res,array(),"delete");

		echo json_encode($out);
	}
	
}

/* End of file App.php */
/* Location: ./application/controllers/master/Category.php */