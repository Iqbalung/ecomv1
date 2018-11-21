<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("master/M_user");
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/master/user/main', $data);
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

		$res = $this->M_user->get($params);

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
		$params = array(
			"user_userid" => ifunsetempty($_POST,"user_userid",""),
			"user_username" => ifunsetempty($_POST,"user_username",""),
			"user_password" => md5(ifunsetempty($_POST,"user_password","")),
			"user_datecreated" => ifunsetempty($_POST,"user_datecreated",date("Y-m-d")),
			"user_dateupdated" => ifunsetempty($_POST,"user_dateupdated",date("Y-m-d"))
		);
		
		$flag = "create";
			
		if ($params["user_userid"] == "")
		{
			$params["user_userid"] = $this->get_uuid();
			unset($params["user_dateupdated"]);
			$res = $this->M_user->add($params);			
		}
		else
		{	
			$flag = "update";		
			unset($params["user_password"]);
			unset($params["user_datecreated"]);
			$res = $this->M_user->update($params);
		}

		$params_usergroup = array(
			"user_usergroupid" => ifunsetempty($_POST,"user_usergroupid",""),
			"user_usergroup" => ifunsetempty($_POST,"user_usergroup",""),		
			"user_userid" => ifunsetempty($params,"user_userid","")			
		);

		$res_usergroup = $this->save_user_usergroup($params_usergroup);

		$out = $this->_respon(($res && $res_usergroup),false,$flag);

		echo json_encode($out);
	}

	function save_user_usergroup($args = array())
	{
		$params = array(
			"user_usergroupid" => ifunsetempty($args,"user_usergroupid",""),
			"user_usergroup" => ifunsetempty($args,"user_usergroup",""),
			"user_userid" => ifunsetempty($args,"user_userid",""),			
		);
		
		$res = false;		
		if (!empty($params["user_userid"]))
		{			
			if ($params["user_usergroupid"] == "")
			{
				$params["user_usergroupid"] = $params["user_userid"].'.'.$params["user_usergroup"];
				$res = $this->M_user->add_user_usergroup($params);
			}
			else
			{
				$res = $this->M_user->update_user_usergroup($params);
			}
		}

		return $res;
	}

	public function delete()
	{
		$res = false;
		$method = $_POST;		

		$params = array(
			"user_userid" => ifunsetempty($method,"id",0)
		);

		$res = $this->M_user->delete($params);

		$out = $this->_respon($res,array(),"delete");

		echo json_encode($out);
	}
	

	public function get_usergroup()
	{
		$res = $this->M_user->get_usergroup();

		$data["data"] = $res->result_array();

		$out = $this->_respon($res,$data,"get");

		echo json_encode($out);
	}
}

/* End of file App.php */
/* Location: ./application/controllers/App.php */