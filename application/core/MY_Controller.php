<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->check_session();
	}
	
	function check_session(){
		$logged_in = $this->session->userdata('logged_in');
		if(!isset($logged_in) or $logged_in != 1){
			redirect('login');
		}
	}

}
