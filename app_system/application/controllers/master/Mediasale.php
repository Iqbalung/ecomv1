<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mediasale extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("master/M_mediasale");
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/master/mediasale/main', $data);
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

		$res = $this->M_mediasale->get($params);

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
			"mos_id" => ifunsetempty($method,"mos_id",''),
			"mos_name" => ifunsetempty($method,"mos_name",''),
			"mos_code" => ifunsetempty($method,"mos_code",''),
			"mos_datecreated" => ifunsetempty($method,"mos_datecreated",date("Y-m-d")),
			"mos_dateupdated" => ifunsetempty($method,"mos_dateupdated",date("Y-m-d"))
		);

		if (empty($params["mos_id"]))
		{
			$params["mos_id"] = $this->get_uuid();
			unset($params["mos_dateupdated"]);
			$res = $this->M_mediasale->add($params);
		}
		else
		{			
			unset($params["mos_datecreated"]);
			$res = $this->M_mediasale->update($params);
		}

		$out = $this->_respon($res,array());

		echo json_encode($out);
	}

	public function delete()
	{
		$res = false;
		$method = $_POST;		

		$params = array(
			"mos_id" => ifunsetempty($method,"id",0)
		);

		$res = $this->M_mediasale->delete($params);

		$out = $this->_respon($res,array(),"delete");

		echo json_encode($out);
	}
	
}

/* End of file App.php */
/* Location: ./application/controllers/App.php */