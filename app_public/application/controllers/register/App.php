<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class register extends CI_Controller {
	
	public function __construct ()
	{
		parent::__construct();
		$this->load->model('model_users');
		$this->load->model('model_settings');
		$this->load->helper('form');

	}
		
	public function index()
	{
		
		
		
			$data['get_sitename'] = $this->model_settings->sitename_settings();
			$data['get_footer'] = $this->model_settings->footer_settings();	
			$this->load->view('index/header'); 
			$this->load->view('register/form_register',$data); 
			// if(($this->input->post('rusername')=="") || ($this->input->post('propinsi_tujuan')=="") || ($this->input->post('detination')=="") ){
			// 	 $this->session->set_flashdata('info','gagal' );
			// 						 redirect('login');
			// }

			$pass = $this->input->post('rpassword');
				$data_register_new = array
				 (
					'usr_name'			=> $this->input->post('rusername'),
					'usr_password'		=> sha1($pass),
					'stuts'				=> '1',
					'usr_group'				=>'3',
					'alamat'			=> $this->input->post('alamat'),
					'reseler_status'    => '0',
					'email'				=> $this->input->post('email'),
					'provinsi'			=> $this->input->post('propinsi_tujuan'),
					'kabupaten'			=> $this->input->post('detination'),
					'kodepos'			=> $this->input->post('kodepos'),
					'no_hp'			=> $this->input->post('no_hp')
				 );
				 if($this->model_users->is_usr() == FALSE)
				 {
					 $this->model_users->register_new($data_register_new);
						 $this->form_validation->set_rules('rusername');
						 $this->form_validation->set_rules('rpassword');
						 
								$this->load->view('login/form_login'); 	
						
								$valid_user	= $this->model_users->check();
								 		
								 	
									 $this->session->set_flashdata('info','Finish' );
									 redirect('login');
									
								 
										 $this->session->set_userdata('username',$valid_user->usr_name);
										 $this->session->set_userdata('group',$valid_user->usr_group);
										 switch($valid_user->usr_group)
										 {
											 case 3 ://for member
											 redirect(base_url());
											 break;
											 
											 default: break;
										 }
								 }
						 
					 
					// redirect(base_url());
					
					
				 }
		}
	

?>