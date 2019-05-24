<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/inventory/purchasematerial', $data);
	}

	public function stockopname()
	{
		$data = array(
			'data_app' => $this->get_data_app()
		);
		
		$this->template->display('inc/inventory/stockopname/main', $data);
	}
	
}

/* End of file App.php */
/* Location: ./application/controllers/App.php */