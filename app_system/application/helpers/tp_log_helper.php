<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	date_default_timezone_set("Asia/Jakarta");

	function log_insert($mode, $data = array())
	{
		$ci =& get_instance();
		$ci->load->database();
		$ci->load->model(array('m_pegawai','m_kalender_diklat'));

		$tmp = array();
		if (isset($data['data'])) {
			$tmp = $data['data'];
		}

		$params = array(
            'PEGAWAIID' => $data['PEGAWAIID'],
            'start' => ifunsetempty($_POST,'start',0),
            'limit' => ifunsetempty($_POST,'limit',25)
        );
        $pegawai = $ci->m_pegawai->get($params)->first_row();
        $par = array($pegawai->NAMA);

		if (isset($data['KALENDERID'])) {
			$params = array(
	            'PEGAWAIID' => $data['PEGAWAIID'],
	            'KALENDERID' => $data['KALENDERID'],
	            'start' => ifunsetempty($_POST,'start',0),
	            'limit' => ifunsetempty($_POST,'limit',25)
	        );
	        
	        $diklat = $ci->m_kalender_diklat->get($params)->first_row();
	        array_push($par, $diklat->DIKLAT);
	        // $tmp = $diklat;
		}

		$aktivitas = generate_aktivitas($mode, $par, $tmp);

		$params = array(
			'USERACTID' => '',
			'AKTIFITAS' => $aktivitas,
			'WAKTU' => date('d/m/Y H:i:s'),
			'IPADDRESS' => $_SERVER['HTTP_HOST'],
			'USERGROUP' => $ci->session->userdata('usergroup'),
			'USERLOGIN' => $ci->session->userdata('email'),
			'USERNAMA' => $ci->session->userdata('fullname'),
			'USERNIP' => $ci->session->userdata('nip'),
			'USERPEGAWAIID' => $ci->session->userdata('pegawaiid'),
			'AFFECTED_PEGAWAIID' => $data['PEGAWAIID']
		);

		$sql = "INSERT INTO ESURTA_USERAKTIFITAS
                    (USERACTID, AKTIFITAS, WAKTU, IPADDRESS, USERGROUP, USERLOGIN, USERNAMA, USERNIP, USERPEGAWAIID, AFFECTED_PEGAWAIID)
                VALUES
                    (?,?,to_date(?,'dd/mm/yyyy hh24:mi:ss'),?,?,?,?,?,?,?)";

        $ci->db->query($sql,$params);
	}

	function generate_aktivitas($mode, $params = array(), $data = array())
	{
		/*tp_log_helper - generate_aktivitas:
		 1. menambah pegawai
		 2. mengubah data pegawai
		 3. menambah angka kredit
		 4. mengubah angka kredit
		 5. menghapus angka kredit
		 6. mendaftarkan pegawai untuk diklat
		 7. pegawai mengunggah berkas pada diklat
		 8. pegawai/calon peserta diklat tidak lolos
		 9. pegawai/calon peserta diklat lolos
		 10. pegawai/calon peserta diklat dibatalkan
		 11. pegawai/calon peserta diklat lulus
		 12. pegawai/calon peserta diklat tidak lulus*/
 
		$ci =& get_instance();
		$aktivitas = array('data' => $data, 'pesan' => '');

		switch ($mode) {
			case 1:
				$aktivitas['pesan'] = '<b>'.$ci->session->userdata('fullname').'</b> menambah pegawai ';
				break;

			case 2:
				$aktivitas['pesan'] = '<b>'.$ci->session->userdata('fullname').'</b> mengubah data pegawai ';
				break;

			case 3:
				$aktivitas['pesan'] = '<b>'.$ci->session->userdata('fullname').'</b> menambah angka kredit ';
				break;

			case 4:
				$aktivitas['pesan'] = '<b>'.$ci->session->userdata('fullname').'</b> mengubah angka kredit ';
				break;

			case 5:
				$aktivitas['pesan'] = '<b>'.$ci->session->userdata('fullname').'</b> menghapus angka kredit ';
				break;

			case 6:

				$aktivitas['pesan'] = 'Didaftarkan pada diklat <b>'.$params[1].'</b> oleh <b>'.$ci->session->userdata('fullname').'</b>';
				break;

			case 7:
				$aktivitas['pesan'] = '<b>'.$ci->session->userdata('fullname').'</b> melengkapi berkas dan mengkonfirmasi pendaftaran diklat <b>'.$params[1].'</b>';
				break;

			case 8:
				$aktivitas['pesan'] = 'Tidak lolos pada diklat <b>'.$params[1].'</b>';
				break;

			case 9:
				$aktivitas['pesan'] = 'Lolos pada diklat <b>'.$params[1].'</b>';
				break;

			case 10:
				$aktivitas['pesan'] = 'Dibatalkan kepesertaannya pada diklat <b>'.$params[1].'</b>';
				break;

			case 11:
				$aktivitas['pesan'] = 'Tidak lulus pada diklat <b>'.$params[1].'</b>';
				break;

			case 12:
				$aktivitas['pesan'] = 'Lulus pada diklat <b>'.$params[1].'</b>';
				break;

			default:
				$aktivitas['pesan'] = '';
				break;
		}

		return json_encode($aktivitas);
	}