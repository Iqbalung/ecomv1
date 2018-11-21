<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function execute_sp_count($name_sp, $dt=array(),$is_olahdata=1) {

	$ci = &get_instance();
	$render_string_params = "";
	$i = 0;
	$koma='';
	foreach($dt as $key=>$value) {
		
		if($key == 'start' || $key == 'limit') {
			$$key = $value;
			continue ;
		}

		if($i!=0)
			$koma=',';

		if($value === null)
			$render_string_params.="$koma'$value'";
		else if(strrpos($key, 'int') !== false)
			$render_string_params.="$koma $value";
		else
			$render_string_params.="$koma".$ci->db->escape(str_replace("'",'\'\'',$value));
		$i=1;	
		//echo $value."#";
	}

	//exit ;

	$link = pg_connect("host=".$ci->db->hostname." port=".$ci->db->port." dbname=".$ci->db->database." user=".$ci->db->username." password=".$ci->db->password);
	
	$sql = " SELECT * FROM $name_sp ($render_string_params )";
	//echo $sql;
	//exit;
	$query = pg_query($sql);
	
	if($is_olahdata==1){
		$data = array();
		$i=0;
		$first_row =array();

		
		if($query !== true)
		if ( !pg_num_rows($query)) {
			pg_close($link);
			return array('data'=>array(),'first_row'=>array(),'count'=>0,'num_rows'=>0);
		} else {
			
			while ($row = pg_fetch_array($query, null,PGSQL_ASSOC)) {
				
				if($i >= $start && $i < $start + $limit){
					if($i == 0){
						$first_row = $row;
					}
					$data [] = $row;
				}
				$i++;

			}
			
			pg_close($link);
			return array('data'=>$data,'first_row'=>$first_row,'count'=>$i,'num_rows'=>$i);
		}
	}else{
		pg_close($link);
		return array('data'=>$query);
	}

}

function execute_sp_return($name_sp, $dt=array(),$is_olahdata=1) {
	$ci=&get_instance();
	$render_string_params="";
	$i=0;
	$koma='';
	foreach($dt as $key=>$value){
		
		if($i!=0)
			$koma=',';
		
		if($value === null)
			$render_string_params.="$koma'$value'";
		else if(strrpos($key, 'int') !== false)
			$render_string_params.="$koma $value";
		else
			$render_string_params.="$koma".$ci->db->escape(str_replace("'",'\'\'',$value));
		$i=1;	
		//echo $value."#";
	}

	//exit ;


	$link = pg_connect("host=".$ci->db->hostname." port=".$ci->db->port." dbname=".$ci->db->database." user=".$ci->db->username." password=".$ci->db->password);
	

	$sql = " SELECT * FROM $name_sp ($render_string_params )";

	//echo $sql ;
	//exit;
	
	$query = pg_query($sql);
	
	if($is_olahdata==1){
		$data = array();
		$i=0;
		$first_row =array();
	
		
		if($query !== true)
		if ( !pg_num_rows($query)) {
			pg_close($link);
			return array('data'=>array(),'first_row'=>array(),'num_rows'=>0);
		} else {
			
			while ($row = pg_fetch_array($query, null,PGSQL_ASSOC)) {
				$i++;
				$row['no']=$i;
				if($i==1){
					$first_row = $row;
				}
				$data [] = $row;
			}
			
			pg_close($link);
			return array('data'=>$data,'first_row'=>$first_row,'num_rows'=>$i);
		}
	}else{
		pg_close($link);
		return array('data'=>$query);
	}
}

function execute_sp($name_sp, $dt = array()){
	$ci=&get_instance();
	$render_string_params = "";
	
	
	$i=0;
	$koma='';
	foreach($dt as $key=>$value){
		
		if($i!=0)
			$koma=',';
		
		if($value === null)
			$render_string_params.= "$koma'$value'";
		else if(strrpos($key, 'int') !== false)
			$render_string_params.= "$koma $value";
		else
			$render_string_params.= "$koma".$ci->db->escape(str_replace("'",'\'\'',$value));
		$i=1;	

		//echo "'".$value."',";
	
	}

	$link = pg_connect("host=".$ci->db->hostname." port=".$ci->db->port." dbname=".$ci->db->database." user=".$ci->db->username." password=".$ci->db->password);
	
	
	$sql = "SELECT $name_sp ($render_string_params)";

	//echo $sql;
	//exit;

	$query = pg_query($sql);
	pg_close($link);
	return $query;
}

function _fetch_array($cv_1){
	return  pg_fetch_array($cv_1,null, PGSQL_ASSOC );
}





