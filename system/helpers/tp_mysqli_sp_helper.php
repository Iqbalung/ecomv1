<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function execute_sp_count($namaSP, $parameterSP)
{
	$ci     = &get_instance();
	$mysqli = mysqli_connect($ci->db->hostname,$ci->db->username,$ci->db->password, $ci->db->database);
	$params = '';
	$i      = 0;
	$record = array();

	foreach ($parameterSP as $key => $value) {

		if(gettype($value) == "integer"){
			$params .= ($i == 0) ? "$value" : ", $value";
		}else{
			$params .= ($i == 0) ? "'$value'" : ", '$value'";
		}

		$i++;
	}

	$params .= ', @count';

	$query1 = "CALL $namaSP ($params);";

	// echo $query1;
	// exit;

	$select = mysqli_query($mysqli, $query1);
	
    while($row = mysqli_fetch_array($select, MYSQLI_ASSOC)){
        $record[] = $row;
    }

    return $record;
}

function execute_sp_count_useless($namaSP, $parameterSP)
{
	$ci         = &get_instance();
	$mysqli     = mysqli_connect($ci->db->hostname,$ci->db->username,$ci->db->password, $ci->db->database);
	$tandaTanya = '?';

	for($i=1; $i<count($parameterSP); $i++){
		$tandaTanya .= ', ?';
	}

	$call = mysqli_prepare($mysqli, "CALL $namaSP($tandaTanya, @count)");

	foreach ($parameterSP as $key => $value) {

		if(gettype($value) == 'integer'){
			$type = 'i';
		} else if(gettype($value) == 'double'){
			$type = 'd';
		} else if(gettype($value) == 'string'){
			$type = 's';
		} else if(gettype($value) == 'resource'){
			$type = 'b';
		} else {
			$type = 's';			
		}

		//echo "$value = $type";

	}

	$strin = '';
	$zero = 0;
	$_25 = 25;
	mysqli_stmt_bind_param($call, 'sii', $strin, $zero, $_25);
	mysqli_stmt_execute($call);

	$select = mysqli_query($mysqli, 'CALL (?,?,?,@count)');
	$result = mysqli_fetch_assoc($select);

	echo json_encode($result);
}

function execute_sp_return($namaSP, $params=array())
{
	$ci     = &get_instance();
	$mysqli = mysqli_connect($ci->db->hostname,$ci->db->username,$ci->db->password, $ci->db->database);

	$i 			= 0;
	$parameter  = '';
	$record 	= array();
	
	foreach ($params as $key => $value) {	
		if(gettype($value) == 'integer'){
			$parameter .= ($i==0) ? "$value" : ", $value";
		}
		else{
			$parameter .= ($i==0) ? "'$value'" : ", '$value'";
		}
		$i++;
	}

	// echo "CALL $namaSP ($parameter);";
	// exit;
	$res = $mysqli->query("CALL $namaSP ($parameter);");

	/*var_dump($res);
	exit;*/
	
	while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
		$record[] = $row;
	}

    return $record;
}

function execute_sp()
{

}




