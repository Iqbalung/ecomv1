<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function fpak_upload_file($file,$path_to='',$allowed_types='',$old_filename=''){
		$ci =& get_instance();

		if(isset($_FILES[$file]) && $_FILES[$file]['name']!=''){
			$data_file = $_FILES[$file];
		} else {
			if(file_exists($path_to.$old_filename) && $old_filename!=''){
				$file_name = $old_filename;
				$size = round(filesize($path_to.$old_filename)/1024, 2);
			} else {
				$file_name = $old_filename;
				$size = 0;
			}

			return array('success' => true, 'message' => 'File tidak ada','error_message'=>'','data'=>array('file_name'=>$file_name,'file_size'=>$size));
			exit;
		}
		

		$file_pathinfo = pathinfo($data_file['name']);


		$file_nama = str_replace(' ', '_', $file_pathinfo['filename']);
		$send_filerandom = $file_nama.'_'. md5(time().$file_nama) . '.' .$file_pathinfo['extension'];
		if($path_to=='') $path_to = config_item('upload_path');


		$config['upload_path'] = $path_to;
		$config['allowed_types'] = ($allowed_types!='')?$allowed_types:$ci->config->item('extension');
		$config['overwrite']  = TRUE;
		$config['file_name']  = $send_filerandom;
		$config['max_size']   = ($ci->config->item('ukuran_maks_file')/1024);

		$ci->load->library('upload', $config);
		$ci->upload->initialize($config);
		$up =$ci->upload->do_upload($file);
		$upload_data = $ci->upload->data();

		if (!$up){
			$result = array('success' => false, 'message' => 'Gagal Upload', 'error_message'=>$ci->upload->display_errors(),'data'=>$upload_data);
		} else {
			if(file_exists($path_to.$old_filename) && $old_filename!=''){
				unlink($path_to.$old_filename);
			}
			$result = array('success'=>true, 'message'=>'Data Berhasil Terkirim', 'error_message'=>$ci->upload->display_errors(),'data'=>$upload_data);
		}
		return $result;
	}