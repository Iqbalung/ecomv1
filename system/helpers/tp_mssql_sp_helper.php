<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function execute_sp_count($name_sp, $dt=array(),$is_olahdata=1){

	$ci=&get_instance();
	$render_string_params="";
	$link = mssql_connect($ci->db->hostname,$ci->db->username,$ci->db->password);
    mssql_select_db($ci->db->database, $link); 
	
	$stmt = mssql_init($name_sp, $link);
	
	foreach($dt as $key=>$value){
		if($value==null){
			mssql_bind($stmt, "@".$key, $value, SQLVARCHAR, false, false, 255);
		}else{
			mssql_bind($stmt, "@".$key, str_replace("'",'\'\'',$value), SQLVARCHAR, false, false, 255);
		}
	}
	
	$count = 0;
	mssql_bind($stmt, '@count', $count, SQLINT4, true);
	$res = mssql_execute($stmt);

	$i=0;
	if($is_olahdata==1){
		$data = array();
		$first_row =array();
		
		if (!mssql_num_rows($res)) {
			return array('data'=>$data,'first_row'=>$first_row,'num_rows'=>0);
		} else {
			while ($row = mssql_fetch_assoc($res)) {
				$i++;
				$row['no']=$i;
				if($i==1){
					$first_row = $row;
				}
				$data [] = $row;
			}
			return array('data'=>$data,'count'=>$count);
		}
	}else
		return array('data'=>$res,'count'=>$count);
		
		
		
}

function execute_sp_return($name_sp, $dt=array(),$is_olahdata=1){
	$ci=&get_instance();
	$render_string_params="";
	$i=0;
	$koma='';
	foreach($dt as $key=>$value){
		
		if($i!=0)
			$koma=',';
		
		if($value==null)
			$render_string_params.="$koma'$value'";
		else
			$render_string_params.="$koma".$ci->db->escape(str_replace("'",'\'\'',$value));
		$i=1;	
	
	}


	$link = mssql_connect($ci->db->hostname,$ci->db->username,$ci->db->password);
    mssql_select_db($ci->db->database, $link); 
	
	$sql = " $name_sp $render_string_params ";
	
	$query = mssql_query($sql);
	
	if($is_olahdata==1){
		$data = array();
		$i=0;
		$first_row =array();
		
		if (!mssql_num_rows($query)) {
			return array('data'=>array(),'first_row'=>array(),'num_rows'=>0);
		} else {
			
			while ($row = mssql_fetch_array($query, MSSQL_ASSOC)) {
				$i++;
				$row['no']=$i;
				if($i==1){
					$first_row = $row;
				}
				$data [] = $row;
			}
			
			
			return array('data'=>$data,'first_row'=>$first_row,'num_rows'=>$i);
		}
	}else
		return array('data'=>$query);
	
}

function execute_sp($name_sp, $dt=array()){
	$ci=&get_instance();
	$render_string_params="";
	
	
	$i=0;
	$koma='';
	foreach($dt as $key=>$value){
		
		if($i!=0)
			$koma=',';
		
		if($value==null)
			$render_string_params.="$koma'$value'";
		else
			$render_string_params.="$koma".$ci->db->escape(str_replace("'",'\'\'',$value));
		$i=1;	
	
	}


	$link = mssql_connect($ci->db->hostname,$ci->db->username,$ci->db->password);
    mssql_select_db($ci->db->database, $link); 
	
	$sql = " $name_sp $render_string_params ";
	
	$query = mssql_query($sql);
	
	return $query;
}

function _fetch_array($cv_1){
	return  mssql_fetch_array($cv_1, MSSQL_ASSOC );
}





