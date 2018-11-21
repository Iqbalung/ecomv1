<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Region extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("master/M_region");
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/master/region/main', $data);
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

		$res = $this->M_region->get($params);

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
			"reg_id" => ifunsetempty($method,"reg_id",''),
			"reg_name" => ifunsetempty($method,"reg_name",''),			
			"reg_datecreated" => ifunsetempty($method,"reg_datecreated",date("Y-m-d")),
			"reg_dateupdated" => ifunsetempty($method,"reg_dateupdated",date("Y-m-d"))
		);

		if (empty($params["reg_id"]))
		{
			$params["reg_id"] = $this->get_uuid();
			unset($params["reg_dateupdated"]);
			$res = $this->M_region->add($params);
		}
		else
		{			
			unset($params["reg_datecreated"]);
			$res = $this->M_region->update($params);
		}

		$out = $this->_respon($res,array());

		echo json_encode($out);
	}

	public function delete()
	{
		$res = false;
		$method = $_POST;		

		$params = array(
			"reg_id" => ifunsetempty($method,"id",0)
		);

		$res = $this->M_region->delete($params);

		$out = $this->_respon($res,array(),"delete");

		echo json_encode($out);
	}
	
}

/* End of file App.php */
/* Location: ./application/controllers/master/Region.php */