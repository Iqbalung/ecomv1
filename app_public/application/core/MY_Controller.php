<?php

class MY_Controller extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		
		$this->user = array();
		$this->menu = array();

	}

	function get_token()
	{
		$token = $_COOKIE["token"];
		
		if (!$token) {
				
		}

		return $token;
	}

	function validate_token($token)
	{
		$out = false;
		$this->load->config('jwt');
		$this->load->library(array('Jwt'));						
		if (count(explode('.',$token)) == 3) 
		{		
			try{
				$decodedToken = JWT::decode($token,$this->config->item('jwt_key'),array('HS256'));
		        if ($decodedToken != false) 
		        {	        
		        	$out = (array) $decodedToken;		        	
		        }		        
		    }catch(ExpiredException $e){
		         echo 'Caught exception: ',  $e->getMessage(), "\n";
		    }
		}

        return $out;
	}

	function check_access($fiturid,$not_menu=true,$direct=''){
		$this->load->model('m_hak_akses');
		$cek = $this->m_hak_akses->check_fitur($fiturid);
		$num_rows = (int) $cek->num_rows();
		$usergroupid = $this->session->userdata('usergroupid');
		if($num_rows == 0)
		{
			if($not_menu)
			{
				$out = array(
					'success' => false,
					'msg' => 'Anda tidak memiliki hak',
					'data' => array()
				);
				return $out;
				exit;
			} 
			else 
			{
				if ($usergroupid == 5) {
					$direct ='../index.php/';
				}

				redirect($direct);
			}
		}
	}

	function get_fitur(){
		$this->load->model('m_hak_akses');
		$res = $this->m_hak_akses->get_fitur();
		$data = $res->result_array();
		$out = array();

		foreach ($data as $key => $value) {
			$out[] = $value['FITURID'];
		}

		print_r($out);
		exit;
	}

	function check_access_id($usergroupid=0){
		// usergroup id can access this task
		$usergroupid = explode(',', $usergroupid);
		$count = 0;
		foreach ($usergroupid as $d) {
			if($d==$this->session->userdata('usergroupid')){
				$count++;
			}
		}
		if($count>0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function root_check_access($page=''){
		$logged_in = $this->session->userdata('logged_in');
		$usergroupid = $this->session->userdata('usergroupid');
		$hak_akses = $this->config->item('hak_akses');

		
		if($logged_in){
			foreach ($hak_akses as $d) {
				if($usergroupid==$d['usergroupid']){
					redirect($d['root_access']);
				}
			}
		} else if($page!='login_page'){
			redirect($this->config->item('log_in_link'));
		}
	}

	function get_jml_pengaduan(){
		$this->load->model('M_buat_pengaduan');
		$jml_pengaduan = $this->M_buat_pengaduan->get_jml_pengaduan();
		return $jml_pengaduan['first_row'];
	}

	function get_menu(){
		// $this->load->model('m_hak_akses');
		// $menu = $this->m_hak_akses->get_menu()->result();
		// return $menu;
	}

	function convert_unit($val)
	{
		$str = ($val == 1) ? '' : '_unit';

		return $str;
	}

	function get_data_app(){
		$data_app = array(
        	'load' => array(
        		'css'=> array(
					$this->config->item('url_plugins').'font-awesome/css/font-awesome.min.css',
        		),
        		'js' => array(
        			$this->config->item('url_bootstrap').'js/bootstrap.min.js',
        		),
        		'js_second' => array(
        		)
        	),
        	'base_url' => base_url(),
			'site_url' => site_url(),
			'current_url' => current_url(),
			
			'base_client_images' => $this->config->item('base_client_images'),
			'url_images' => $this->config->item('url_images'),
			
			'url_media' => $this->config->item('url_media'),
			'url_plugins' => $this->config->item('url_plugins'),
			'url_app' => $this->config->item('url_app_dumas'),
			'url_client_images' => $this->config->item('url_client_images'),
			'url_client_uploads' => $this->config->item('url_client_uploads'),
			'default_photo' => $this->config->item('url_media').'images/photo/icon-user-default.png',
			'url_foto' => $this->config->item('dumas_upload_foto_url'),
			'segment' => array(
				1 => $this->uri->segment(1),
				2 => $this->uri->segment(2),
				3 => $this->uri->segment(3),
				4 => $this->uri->segment(4),
				5 => $this->uri->segment(5),
			)
        );
		
        return $data_app;
	}

	function check_session(){
		$logged_in = $this->session->userdata('logged_in');
		if(!isset($logged_in) or $logged_in != 1){
			redirect(base_url().'index.php/login');
		}
	}

	function _gen_uuid() {
	   return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
	       // 32 bits for "time_low"
	       mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

	       // 16 bits for "time_mid"
	       mt_rand( 0, 0xffff ),

	       // 16 bits for "time_hi_and_version",
	       // four most significant bits holds version number 4
	       mt_rand( 0, 0x0fff ) | 0x4000,

	       // 16 bits, 8 bits for "clk_seq_hi_res",
	       // 8 bits for "clk_seq_low",
	       // two most significant bits holds zero and one for variant DCE1.1
	       mt_rand( 0, 0x3fff ) | 0x8000,

	       // 48 bits for "node"
	       mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
	   );
	}

	function _get_message($type = "common")
	{
		$message = array();
		$message["common"] = array(
			"success" => 'Transaction succes',
			"failure" => 'Transaction failed'
		);
		$message["get"] = array(
			"success" => 'Load data succes',
			"failure" => 'Load data failed'
		);
		$message["create"] = array(
			"success" => 'Create succes',
			"failure" => 'Create failed'
		);
		$message["update"] = array(
			"success" => 'Update succes',
			"failure" => 'Update failed'
		);
		$message["delete"] = array(
			"success" => 'Delete succes',
			"failure" => 'Delete failed'
		);
		$out = (object) $message["common"];

		if(isset($message[$type])){
			$out = (object) $message[$type];
		}
		return $out;

	}

	function _respon($in,$data = false,$type = "common",$message = array()){
		if($in){
			$out = array(
				'success' => true,
				'msg' => $this->_get_message($type,$message)->success
			);			
			if ($data) {
				$out = array_merge($out,$data);
			}
		}else{
			$out = array(
				'success' => false,
				'msg' => $this->_get_message($type,$message)->failure
				);
			if ($data) {
				$out = array_merge($out,$data);
			}
		}
		return $out;
	}

	public function get_uuid()
	{
		$q = $this->db->query("SELECT UUID() UID");		
		return $q->row()->UID;
	}

	function get_data_user()
	{
		$data =  array();
		if (is_array($this->user))
		{
			$data = (object) $this->user;
		}

		return $data;
	}

	public function set_pagination($res, $link,$setting = array())
	{
		$this->load->library('pagination');

		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		$config['base_url'] = $link;
		$config['total_rows'] = 0;
		if (isset($res['data'][0]['num_rows'])) {
			$config['total_rows'] = $res['data'][0]['num_rows'];			
		}		
		if (isset($res['count'])) {
			$config['total_rows'] = $res['count'];			
		}		
		$config['per_page'] = ifunsetempty($setting,"per_page",20);

		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['first_url'] = '';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['last_url'] = '';

		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';		
		$this->pagination->initialize($config);		
		return $this->pagination->create_links();
	}

}