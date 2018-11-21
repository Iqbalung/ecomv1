<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CI_Tp_email
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function send($to, $subject, $view, $data = array())
	{
		$this->ci->load->library('email');
		
		$this->ci->email->from('sidumas@big.go.id', 'SIDUMAS');
		$this->ci->email->to($to);
		
		$this->ci->email->subject($subject);
		$this->ci->email->message($this->ci->load->view('inc/email/'.$view, $data, TRUE));
		
		$this->ci->email->send();
	}

}

/* End of file Tp_email.php */
/* Location: ./application/libraries/Tp_email.php */
