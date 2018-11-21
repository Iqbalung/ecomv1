<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courier extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("master/M_courier");
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/master/courier/main', $data);
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

		$res = $this->M_courier->get($params);

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
			"courier_id" => ifunsetempty($method,"courier_id",''),
			"courier_name" => ifunsetempty($method,"courier_name",''),
			"courier_datecreated" => ifunsetempty($method,"courier_datecreated",date("Y-m-d")),
			"courier_dateupdated" => ifunsetempty($method,"courier_dateupdated",date("Y-m-d"))
		);

		if (empty($params["courier_id"]))
		{
			$params["courier_id"] = $this->get_uuid();
			unset($params["courier_dateupdated"]);
			$res = $this->M_courier->add($params);
		}
		else
		{			
			unset($params["courier_datecreated"]);
			$res = $this->M_courier->update($params);
		}

		$out = $this->_respon($res,array());

		echo json_encode($out);
	}

	public function delete()
	{
		$res = false;
		$method = $_POST;		

		$params = array(
			"courier_id" => ifunsetempty($method,"id",0)
		);

		$res = $this->M_courier->delete($params);

		$out = $this->_respon($res,array(),"delete");

		echo json_encode($out);
	}
	
}

/* End of file App.php */
/* Location: ./application/controllers/App.php */