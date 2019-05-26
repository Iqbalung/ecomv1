<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		header("Access-Control-Allow-Origin: *");
		$this->load->model("M_transaction_forstok");
		$this->load->database();
	}

	public function index($id)
	{
		$article = $this->db->query("select * from m_page where page_title = '$id' ")->result_object();
		

		$data = array(
			'data_app' => $this->get_data_app(),
			'article' => $article
		);
		
		$this->template->display('inc/page/main', $data);
	}
}
