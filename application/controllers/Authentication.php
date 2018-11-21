<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* mengambil controller rest yg sudah di extend ke ci controller */
require APPPATH.'/libraries/REST_Controller.php';

class Authentication extends REST_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->config('jwt');
		$this->load->library(array('Jwt'));
		$this->load->model('M_authentication');
	}

	function generate_key() {
		$token = bin2hex(openssl_random_pseudo_bytes(16));
		echo $token;
	}

	public function do_login_get()
	{
		$out = array();

		$uname = $this->input->get('uname');
		
		$pwd = $this->input->get('pwd');
		
		$out = $this->get_token_login($uname,$pwd);
		
		if ($out["success"]) 
		{				
			$this->response($out);
		} 
		else
		{			
			$this->response($out,401);
		}
	}

	public function do_login_post()
	{
		$out = array();

		$uname = $this->input->post('uname');
		
		$pwd = $this->input->post('pwd');
		
		$out = $this->get_token_login($uname,$pwd);
		
		$this->response($out);		
	}
	
	function get_token_login($username,$password)
	{		
		$res = $this->M_authentication->do_login($username, $password);
		$out['success'] = false;
		if ($res->num_rows() > 0) {			
			$data_user = $res->row_array();			

			$usergroupid = ifunsetempty($data_user,"user_usergroup","");
			
			//$menu = $this->M_authentication->menu($usergroupid);
			// $fitur = $this->M_authentication->fitur_user($res[0]['grup'],$res[0]['pgn_id']);

			$menu['menu'] = array();
			// if ($menu['menu'] == '') {
			// }

			$out['success'] = true;

			$data= array(
				'user' => $data_user,		
				"exp" => time()+86400, // masa berlaku token 1 hari
				"menu" => $menu['menu'],
				"API_KEY" => "f6eed6446c15978f9e4021b99b928851"
				);					
			$out['token'] = JWT::encode($data,$this->config->item('jwt_key'));			
		} 
		else 
		{
			$out = array(
				'success'=>false,
				'msg'=>'Username atau Password salah!'
			);
		}

		return $out;
	}


	function logout_get(){
		$this->session->sess_destroy();
		unset($_COOKIE['token']);
    	setcookie('token', null, -1, '/');
		redirect('');
	}

	function init_token_get()
	{		
		$token = $this->input->get('token');
		if (count(explode(".", $token)) == 3) 
		{
			setcookie("token", $token, time()+86400, "/"); // // masa berlaku cookie 1 hari
			$out = array(
				"success" => true,
				"token" => $token
			);
			$this->response($out);
		}
		else
		{
			$out = array(
				"success" => false,
				"msg" => "Token not valid!"
			);
			$this->response($out,401);
		}
	}

	function upd_password()
	{

		$password 		= ifunsetempty($_POST, 'password', '');
		$password_lama  = ifunsetempty($_POST, 'passwordlama', '');

		$this->form_validation->set_rules('password', 'password', 'trim|required|max_length[60]');
		$this->form_validation->set_rules('passwordlama', 'passwordlama', 'trim|required|max_length[60]');

		if ($this->form_validation->run() === FALSE)
        {
        	echo json_encode(
				array('success'=>false, 'msg' => validation_errors())
			);
			exit;
        }
		
		$salt_password = $this->config->item('salt_password');
		$password = md5( md5( $password . $salt_password ) ) . md5( $salt_password );

		$salt_password = $this->config->item('salt_password');
		$password_lama = md5( md5( $password_lama . $salt_password ) ) . md5( $salt_password );

		if ($password_lama == $this->session->userdata('password_') ) {

			$params = array(
				'password_' => $password,
				'pgn_id' => $this->session->userdata('pgn_id')
			);

			$this->load->model('M_pengguna');

			$res = $this->M_pengguna->upd($params);
			
			if ($res) {
				$out = array(
					'success' => true,
					'msg' => 'Kata sandi berhasil diubah'
				);
				$this->session->set_userdata($params);
			}

		} else {
			$out = array(
				'success' => false,
				'msg' => 'Kata sandi gagal diubah'
			);
		}

		echo json_encode($out);
	}

	function check_session(){
		$user = $this->session->userdata('user');
		$logged_in = $this->session->userdata('logged_in');
		if(! isset($logged_in) or $logged_in != 1){
			$this->load->view('main-inc/login');
			
		}
		else{
			redirect(base_url('admin.php'));
		}
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
