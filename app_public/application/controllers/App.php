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
		$this->template->display('inc/home/index', $data);
	}

	public function download($file = '', $folder = '')
	{
		$this->load->helper('download');
		$path = config_item('path_client_upload').$folder.'/'.$file;

		if (file_exists($path)) {
			force_download($path, NULL);
		}
		else {
			echo "<h3>File telah rusak atau hilang</h3>";
		}
	}

}

/* End of file App.php */
/* Location: ./application/controllers/App.php */