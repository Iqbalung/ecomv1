<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_authentication');
	}

	function index()
	{
		$this->check_session();
	}

	function member()
	{
		$this->check_session_member();
	}

	function do_register(){
		
		$params = array(
			'user_username' => $this->input->post('email'),
			'user_password' => $this->input->post('rpassword'),
			'user_userid' => $this->get_uuid(),
			'no_hp' => $this->input->post('no_hp'),
			'kodepos' => $this->input->post('kodepos'),
			'alamat' => $this->input->post('alamat')
		);
		$res = $this->M_authentication->do_register($params);
		if ($res) {			
			echo json_encode(array(
				"success"	=> true,
				"message"	=> "berhasil masuk ke aplikasi",
			));
		}
	}
	
	function do_login(){
		//batas berapa salah login terus captcha muncul
		$data = array(					
					'logged_in'	=> 1
				);


		$uname = $this->input->post('uname');
		
		$pwd = $this->input->post('pwd');

		$res = $this->M_authentication->do_login($uname, $pwd);
		$sesscode = (string) trim($this->session->userdata('sesscode'));
		$params = array(
			'USERNAMA'	=> $this->input->post('uname'),
			'USERPASSWORD'	=> $this->input->post('pwd')
		);

		$user_is_valid = false;
		$captcha_is_valid = false;
		$data = array();
		
		
		if ($res->num_rows() > 0) {			
			
			// $this->akses->init_new();
			// $this->app->updArsip($user->row()->UserID); proses timeout

			$session = array('count_failure' => 0,'sesscode'=>'','user' =>  $res->row_array());
			$this->session->set_userdata($session);
			$data = array(					
					'logged_in'	=> 1
				);
			$this->session->set_userdata($data);
			echo json_encode(array(
				"success"	=> true,
				"message"	=> "berhasil masuk ke aplikasi",
			));

		} else {
			if($this->config->item('use_captcha')==false){
				$i= 0;
			} else {
				$i=((int)$this->session->userdata('count_failure'));
			}
			$session = array('count_failure' => $i);
			$this->session->set_userdata($session);
			
			$captcha = false;
			$word = '';
			$captcha_img = '';
			
			if($session['count_failure']>=$batas){
				// $word = $this->random_string(6);
				$data = array(
					'captcha' => $word
				);
				$this->session->set_userdata($data);
				$this->load->helper('captcha');
				
				$sessionn = array('sesscode' => md5($word.$server));
				$this->session->set_userdata($sessionn);
				
				$captcha = true;
				$vals = array(
					'word' => $word,
					'img_path' => FCPATH2 . 'media/images/captcha/',
					'img_url' => base_url() . 'media/images/captcha/',
					'font_path' => './media/font/captcha4.ttf',
					'img_width' => 150,
					'img_height' => 30,
					'expiration' => 20
				);
				$cap = create_captcha($vals);

				$captcha_img = $cap['image'];
			}
			
			echo json_encode(array(
				"success"	=> false,
				"message"	=> "Username dan Password salah",
				"captcha" => $captcha,
				"img" => $captcha_img,
				// "kode" => $word,
				"captcha_is_valid" => $captcha_is_valid
			));
		}
	}

	function do_login2(){
		//batas berapa salah login terus captcha muncul

		$batas = $this->config->item('limit_login');
		$server = $_SERVER['SERVER_NAME'];
		$sesscode = (string) trim($this->session->userdata('sesscode'));
		$char = $this->session->userdata('captcha');
		$failure_count = $this->session->userdata('count_failure');
		
		$params = array(
			'USERNAMA'	=> $this->input->post('uname'),
			'USERPASSWORD'	=> $this->input->post('pwd')
		);

		$user_is_valid = false;
		$captcha_is_valid = false;
		$data = array();
		
		if(trim($this->input->post("captcha")) == trim($char)){
			$this->load->model('m_app','app');
			$res = $this->app->do_login2($params);
			$valid = true;
			if (($valid) && $res->num_rows() > 0) {
				$data = $res->result();
				$row = $data[0];

				// $hak_akses = $this->app->get_hakakses($userid);

				// $array = array(
				// 	'hak_akses' => $hak_akses['data']
				// );
				
				$data = array(
					'userid' => $row->ID,
					'logged_in'	=> 1
				);

				$user_is_valid = true;
				$captcha_is_valid = true;
			}
		}
		
		if($user_is_valid){
			$this->session->set_userdata($data);
			
			// $this->akses->init_new();
			// $this->app->updArsip($user->row()->UserID); proses timeout

			$session = array('count_failure' => 0,'sesscode'=>'');
			$this->session->set_userdata($session);
			echo json_encode(array(
				"success"	=> true,
				"message"	=> "berhasil masuk ke aplikasi",
				"usergroup" =>$this->session->userdata('usergroup')
			));
		} else {
			if($this->config->item('use_captcha')==false){
				$i= 0;
			} else {
				$i=((int)$this->session->userdata('count_failure'));
			}
			$session = array('count_failure' => $i);
			$this->session->set_userdata($session);
			
			$captcha = false;
			$word = '';
			$captcha_img = '';
			
			if($session['count_failure']>=$batas){
				// $word = $this->random_string(6);
				$data = array(
					'captcha' => $word
				);
				$this->session->set_userdata($data);
				$this->load->helper('captcha');
				
				$sessionn = array('sesscode' => md5($word.$server));
				$this->session->set_userdata($sessionn);
				
				$captcha = true;
				$vals = array(
					'word' => $word,
					'img_path' => FCPATH2 . 'media/images/captcha/',
					'img_url' => base_url() . 'media/images/captcha/',
					'font_path' => './media/font/captcha4.ttf',
					'img_width' => 150,
					'img_height' => 30,
					'expiration' => 20
				);
				$cap = create_captcha($vals);

				$captcha_img = $cap['image'];
			}
			
			echo json_encode(array(
				"success"	=> false,
				"message"	=> "Username dan Password salah",
				"captcha" => $captcha,
				"img" => $captcha_img,
				// "kode" => $word,
				"captcha_is_valid" => $captcha_is_valid
			));
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('');
	}
	function upd_password()
	{
		$this->load->model('M_App');
		$password = ifunsetempty($_POST, 'password', 'a');
		$params = array(
			'USERPASSWORD' => md5($password),
			'USERID' => $this->session->userdata('userid')
		);

		$res = $this->M_App->upd_password($params);

		$params['USERPASSWORD'] = $password;
		$params['EMAIL'] = $this->session->userdata('email');
		$params['NAMAPELAPOR'] = $this->session->userdata('fullname');

		$this->tp_email->send($params['EMAIL'], 'Password Berhasil Diubah', 'ubah_sandi', $params);

		if ($res) {
			$out = array(
				'success' => true,
				'msg' => 'Kata sandi berhasil diubah'
			);
		}
		else {
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
			$this->template->display('inc/login/login_checkout');
		}
		else{
			redirect(base_url('index.php/transaction'));
		}
	}

	function check_session_member(){

		$user = $this->session->userdata('user');
		$logged_in = $this->session->userdata('logged_in');
		if(! isset($logged_in) or $logged_in != 1){
			$this->load->view('main-inc/login2');
		}
		else{
			redirect(base_url('index.php/transaction/'));
		}
	}
	function isLoggedIn(){
		$logged_in = $this->session->userdata('logged_in');
		if(! isset($logged_in) or $logged_in != 1){
			redirect();
		}
	}
	function sendEmail(){
		$email = strtolower($this->input->post('email'));
		if($email=='' or !isset($email)){
			header('location: '.base_url());
			exit;
		}
		$this->load->model('m_app');
		$res = $this->m_app->cekEmail($email);
		$result = $res->result_array();
		$num = $res->num_rows();
		if(0<$num){
			//kirim email
			$from = $this->config->item('app_name')." - ".$this->config->item('client_name');
			$to = $result[0]['email'];
			$old_pass = $result[0]['password'];
			$crypt = md5($to.$old_pass);
			$subject = "Reset Kata Sandi Aplikasi ".$from;
			$pesan = "	Apakah anda yang meminta request untuk reset sandi aplikasi ".$from." ?<br />
						jika tidak abaikan email ini.<br /><br />

						Jika iya, silahkan klik link dibawah ini untuk mereset sandi anda :<br />
						Link : ".base_url()."login/reset_sandi/".$crypt."<br /><br />
						Terima Kasih";
				if($this->config->item('use_email')){
					//kirim email
					$this->load->library('email');
					$this->email->from('',$from);
					$this->email->to($to);
					$this->email->subject($subject);
					$this->email->message($pesan);
					$kirim = $this->email->send();
					if($kirim){
						echo "<span style='background-color: #01FF00; color: #000; padding: 5px; border-radius: 5px;'>Notifikasi reset sandi telah di kirim ke email anda.</span>";
					} else {
						echo "<span style='background-color: #FFFF00; color: #fff; padding: 5px; border-radius: 5px;'>Email tidak dapat dikirim.<span>";
					}
				} else {
					echo "<span style='font-size: 10px; background-color: #FF0000; color: #fff; padding: 5px; border-radius: 5px;'>Maaf aplikasi ".$from." ini tidak mengaktifkan fitur kirim email, tolong hubungi administrator.</span>";
				}
		} else {
			echo "<span style='background-color: #FF6600; color: #fff; padding: 5px; border-radius: 5px;'>Email tidak terdaftar.</span>";
		}
	}
	function random_string($length = 10,$type="captcha") {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		if($type=="password"){
			$chars .= "0123456789";
		}
		$string = substr( str_shuffle( $chars ), 0, $length );
		return $string;
	}
	function reset_sandi($enkripsi){
		
		$new_password = $this->random_string(10,"password");
		$name = $this->config->item('app_name')." - ".$this->config->item('client_name');
		
		$this->load->model('m_app');
		$res = $this->m_app->cekEmail($enkripsi,2);
		$result = $res->result_array();
		$num = $res->num_rows();
		// print_r($result);
		if($num==0){
			echo "
			<center>
			<div style='width: 30%; margin-top: 10%; border: 1px solid #555; border-radius: 5px; padding: 15px; background-color: #F0F0F0; font-family: Century Gothic; font-size: 20px; color: #050505;'>
				Maaf link sudah digunakan, untuk mengajukan link baru untuk mereset kata sandi gunakan fungsi <b>lupa kata sandi?</b> pada halaman Login<br />
				<br /><a href=".base_url().">".$name."</a>
			</div>
			<center>";
		} else {
			$user_id = $result[0]['userid'];
			$email = $result[0]['email'];
			$userlogin = $result[0]['username'];
			$data = array("password"=>md5($new_password));
			$ubah = $this->m_app->ubah_password($data,$user_id);
			$hasil = json_decode($ubah);
			if($hasil->success){
				echo "
				<center>
				<div style='width: 30%; margin-top: 10%; border: 1px solid #555; border-radius: 5px; padding: 15px; background-color: #F0F0F0; font-family: Century Gothic; font-size: 20px; color: #050505;'>
					Kata sandi berhasil di reset
					<table border='0'>
						<tr>
							<td>Email</td>
							<td>: ".$email."</td>
						</tr>
						<tr>
							<td>Userlogin</td>
							<td>: ".$userlogin."</td>
						</tr>
						<tr>
							<td>Kata Sandi Baru</td>
							<td>: <b>".$new_password."</b></td>
						</tr>
					</table>
					<br />
					<a href=".base_url().">Home ".$name."</a>
				</div>
				<center>";
			} else {
				echo "
				<center>
				<div style='width: 30%; margin-top: 10%; border: 1px solid #555; border-radius: 5px; padding: 15px; background-color: #F0F0F0; font-family: Century Gothic; font-size: 20px; color: #050505;'>
					Maaf tidak dapat mengganti kata sandi, hubungi Administrator
				</div>
				<center>";
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
