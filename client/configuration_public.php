<?php

if(!isset($_SERVER['HTTP_HOST'])){
	$_SERVER['HTTP_HOST']='localhost';
}

$config['base_url'] = "http".((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "s" : "")."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

$config['app_name']	= "Point Of Sales";
$config['app_longname']	= "Point of Sales";
$config['client_name'] = "PT. Anyaliving";
$config['client_long'] = "PT. Anyaliving Indonesia";

$config['nama_pemda'] = 'Fenomagz';
$config['alamat_pemda'] = 'Cibinong, Bogor';
$config['lokasi_pemda'] = 'Sistem Perundang-Undangan';
$config['nama_aplikasi'] = 'uu';
$config['app_footer']	= "&copy; ".date('Y')." ".$config['nama_pemda'].". All Rights reserved. ";
$config['welcome_text'] = 'Selamat Datang<br>di <b>'.$config['app_longname'].'</b>';
$config['client_logo'] = $config['base_url'].'client/logo.png';

$config['use_captcha'] = true;
$config['limit_login'] = 3;

$config['api_raja_ongkir'] = "5f0b2b7dc71dd2bab399fbc0c11eeb43";

$config['url_media'] = $config['base_url'].'media_front/';
$config['url_bootstrap'] = $config['url_media'].'bootstrap/';
$config['url_extjs'] = $config['url_media'].'extjs/';
$config['url_css'] = $config['url_media'].'css/';
$config['url_js'] = $config['url_media'].'js/';
$config['url_plugins'] = $config['url_media'].'plugins/';
$config['url_prj'] = $config['url_media'].'prj/';
$config['url_images'] = $config['url_media'].'images/';

$config['url_app'] = $config['base_url'].'app_public/app/';

$config['url_client'] = $config['base_url'].'client/';
$config['url_client_images'] = $config['url_client'].'images/';
$config['url_client_uploads'] = $config['url_client'].'uploads/';
$config['url_client_tpl'] = $config['url_client'].'templates/';

$config['client_folder_name'] = '';
$config['path_client'] = FCPATH2."client/".$config['client_folder_name'];
$config['path_client_tpl'] = $config['path_client']."templates/";
$config['path_client_upload'] = $config['path_client']."uploads/";
$config['path_client_upload_forstok'] = $config['path_client_upload']."transaksi_forstok/";

$config['limit'] = "20";
$config['pagesize'] = $config['limit'];
$config['maxsize'] = 25600;

$config['db_mdm_name'] = 'BIG_MDM_TES';

$config['use_ldap'] = true;
$config['ldap_server'] = 'ui-25';
$config['base_dn'] = 'dc=sso,dc=com';
$config['root_dn'] = 'ou=People,dc=sso,dc=com';

$config['root_unitkerjaid'] = '1.';

/* ------------------------- config modul ------------------------- */
$cfg_modul[] = array('1','admin','admin');

$upload_url = $config['url_client_uploads'];
$upload_path = $config['path_client_upload'];

foreach($cfg_modul as $row){
	$modul=$row[1];
	$nama_var='cfg_'.$modul;
	
	$temp['modulid']					= $row[0];
	$temp['modul_name']					= $modul;
	$temp['modul_long_name']			= $row[2];
	$config['url_'.$modul]				= $config['base_url'].$modul.'.php';		
	$temp['view_'.$modul]				= $config['base_url'].'app_'.$modul.'/'.$modul.'/';
	$temp['url_app_'.$modul]				= $config['base_url'].'app_'.$modul.'/app/';
	$temp['component_'.$modul]			= $config['base_url'].'app_'.$modul.'/'.$modul.'/component/';
	$temp[$modul.'_upload_foto_path']	= $upload_path.$modul.'/foto/';
	$temp[$modul.'_upload_dok_path']	= $upload_path.$modul.'/dokumen/';
	$temp[$modul.'_tpl_path']			= $config['path_client_tpl'].$modul.'/';
	$temp[$modul.'_upload_foto_url']	= $upload_url.$modul.'/foto/';
	$temp[$modul.'_upload_dok_url']		= $upload_url.$modul.'/dokumen/';
	$temp[$modul.'_download_dok_url']	= $upload_url.$modul.'/dokumen/';
	$temp[$modul.'_tpl_url']			= $config['url_client_tpl'].$modul.'/';
	// $temp[$modul.'_ftp_upload_dok_url']	=$config['ftp_url'].$modul.'/dokumen/';
	
	$temp['index_page'] 		= $modul.'.php';
	$temp['subclass_prefix'] 	= $modul.'_';


	$$nama_var=$temp;
}