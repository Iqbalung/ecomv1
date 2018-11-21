<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include FCPATH2."client/database.php";

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => $database['hostname'],
	'username' => $database['username'],
	'password' => $database['password'],
	'database' => $database['database'],
	'dbdriver' => $database['dbdriver'],
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
