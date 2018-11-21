<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suplier extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("master/M_suplier");
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/master/suplier/main', $data);
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

		$res = $this->M_suplier->get($params);

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
			"suplier_id" => ifunsetempty($method,"suplier_id",''),
			"suplier_name" => ifunsetempty($method,"suplier_name",''),
			"suplier_phone" => ifunsetempty($method,"suplier_phone",''),
			"suplier_address" => ifunsetempty($method,"suplier_address",''),
			"suplier_datecreated" => ifunsetempty($method,"suplier_datecreated",date("Y-m-d")),
			"suplier_dateupdated" => ifunsetempty($method,"suplier_dateupdated",date("Y-m-d"))
		);

		if (empty($params["suplier_id"]))
		{
			$params["suplier_id"] = $this->get_uuid();
			unset($params["suplier_dateupdated"]);
			$res = $this->M_suplier->add($params);
		}
		else
		{			
			unset($params["suplier_datecreated"]);
			$res = $this->M_suplier->update($params);
		}

		$out = $this->_respon($res,array());

		echo json_encode($out);
	}

	public function delete()
	{
		$res = false;
		$method = $_POST;		

		$params = array(
			"suplier_id" => ifunsetempty($method,"id",0)
		);

		$res = $this->M_suplier->delete($params);

		$out = $this->_respon($res,array(),"delete");

		echo json_encode($out);
	}
	
}

/* End of file App.php */
/* Location: ./application/controllers/App.php */