<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costumer extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("master/M_costumer");
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);		
		$this->template->display('inc/master/costumer/main', $data);
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

		$res = $this->M_costumer->get($params);

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

}

/* End of file App.php */
/* Location: ./application/controllers/App.php */