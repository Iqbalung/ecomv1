<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tp_upload {
	
	function __construct(){
		$this->_ci = &get_instance();
	}
	
	function upload($file,$path_to='',$allowed_types='',$old_filename='',$short_name=false,$bypass=false){
		if(isset($_FILES[$file]) && $_FILES[$file]['name']!=''){
			$data_file = $_FILES[$file];
		} else {
			if(file_exists($path_to.$old_filename) && $old_filename!=''){
				$file_name = $old_filename;
				$size = round(filesize($path_to.$old_filename)/1024, 2);
				$success = TRUE;
			} else {
				$file_name = $old_filename;
				$size = 0;
				$success = FALSE;
			}

			if($bypass){
				$success = true;
			}

			return array('success' => $success, 'message' => 'File tidak ada','error_message'=>'','data'=>array('file_name'=>$file_name,'file_size'=>$size));
			exit;
		}

		$extension = pathinfo($data_file['name']);

		if ($extension['extension'] == 'txt' || $extension['extension'] == 'php') {
			$out = array(
				'success' => FALSE,
				'msg' => 'File gagal diunggah, mohon perikasa kembali file yang anda unggah, file dengan extension .txt, .exe dan .php tidak diperbolehkan',
				'data' => array()
			);

			echo json_encode($out);
			exit;
		}

		$file_pathinfo = pathinfo($data_file['name']);


		$file_nama = str_replace(' ', '_', $file_pathinfo['filename']);

		if ($short_name) {
			$file_nama = 'foto';
		}

		$send_filerandom = 'file_'. md5(time().$file_nama) . '.' .$file_pathinfo['extension'];
		if($path_to=='') $path_to = config_item('upload_path');


		$config['upload_path'] = $path_to;
		$config['allowed_types'] = $allowed_types;
		$config['overwrite']  = TRUE;
		$config['file_name']  = $send_filerandom;
		$config['max_size']   = ($this->_ci->config->item('ukuran_maks_file')/1024);

		$this->_ci->load->library('upload', $config);
		$this->_ci->upload->initialize($config);
		$up =$this->_ci->upload->do_upload($file);
		$upload_data = $this->_ci->upload->data();

		if (!$up){
			$result = array('success' => false, 'message' => 'Gagal Upload', 'error_message'=>$this->_ci->upload->display_errors(),'data'=>$upload_data);
		} else {
			if(file_exists($path_to.$old_filename) && $old_filename!=''){
				unlink($path_to.$old_filename);
			}
			$result = array('success'=>true, 'message'=>'Data Berhasil Terkirim', 'error_message'=>$this->_ci->upload->display_errors(),'data'=>$upload_data);
		}
		return $result;
	}

	function multi_upload($file,$path_to='',$allowed_types='',$old_filenames=''){
		$out = array(
			'success' => FALSE,
			'msg' => 'File tidak ditemukan',
			'data' => array()
		);

		$allow = str_replace('|',', ', $allowed_types);

		if($_FILES[$file]){
			$files = $_FILES[$file];
			$data_success_upload = array();
			$found_failure = FALSE;

			foreach ($files['name'] as $key => $value) {
				if ($files['name'][$key] != '') {
					$_FILES['THIS_IS_MULTI_UPLOAD_FILE']['name']= $files['name'][$key];
			        $_FILES['THIS_IS_MULTI_UPLOAD_FILE']['type']= $files['type'][$key];
			        $_FILES['THIS_IS_MULTI_UPLOAD_FILE']['tmp_name']= $files['tmp_name'][$key];
			        $_FILES['THIS_IS_MULTI_UPLOAD_FILE']['error']= $files['error'][$key];
			        $_FILES['THIS_IS_MULTI_UPLOAD_FILE']['size']= $files['size'][$key];
			        $old_filename = isset($old_filenames[$key])?$old_filenames[$key]:'';

			        $upload = $this->upload('THIS_IS_MULTI_UPLOAD_FILE',$path_to,$allowed_types,$old_filename);

			        if($upload['success']){
			        	$data_success_upload[$key] = $upload['data'];
			        } else {
			        	$found_failure = TRUE;
			        	break;
			        }
				}
			}

			if($found_failure){
				$this->clear_upload($data_success_upload,TRUE);
				$out = array(
					'success' => FALSE,
					'msg' => 'File gagal diunggah, mohon perikasa kembali file yang anda unggah, file yang diperbolehkan: '.$allow,
					'data' => array()
				);
			} else {
				$out = array(
					'success' => TRUE,
					'msg' => 'Berhasil diunggah semua',
					'data' => $data_success_upload
				);
			}

		}


		return $out;
	}

	private function clear_upload($params=array(),$multi=FALSE){
		if($multi){
			foreach ($params as $r) {
				if(isset($r['full_path'])){
					$this->delete_file($r['full_path']);
				}
			}
		} else {
			if(isset($r['full_path'])){
				$this->delete_file($params['full_path']);
			}
		}
	}

	private function delete_file($file=''){
		if(file_exists($file) && is_file($file)){
			unlink($file);
		}
	}
}