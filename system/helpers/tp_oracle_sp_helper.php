<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function execute_sp_count($name_sp, $dt=array(),$is_olahdata=1){
	
	
	$ci=&get_instance();
	$render_string_params="(";
	foreach($dt as $key=>$value){
		if($value==null)
			$render_string_params.="'$value',";
		else
			$render_string_params.="".$ci->db->escape(str_replace("'",'\'\'',$value)).",";
	}

	$render_string_params.=":c, :r); END;";
	
	
	$conn = oci_connect($ci->db->username,$ci->db->password,$ci->db->hostname);
	$sql = "BEGIN $name_sp $render_string_params";
	
	
	// echo $sql;
	// exit;
	$stmt = oci_parse($conn,$sql);
	
	$cv_1 = oci_new_cursor($conn);
	$count;
	
	oci_bind_by_name($stmt,":r",$cv_1,-1,OCI_B_CURSOR);
	oci_bind_by_name($stmt,":c",$count,-1,OCI_B_INT);
	
	$res1=oci_execute($stmt);
	$res2=oci_execute($cv_1);
	if($res1 && $res2){
		if($is_olahdata==1){
			$data = array();
			$no=0;
			while ($row = oci_fetch_array($cv_1, OCI_ASSOC  + OCI_RETURN_NULLS + OCI_RETURN_LOBS)) {
				$row['no']=++$no;
				$data [] = $row;
			}
			return array('data'=>$data,'count'=>$count);
		
		}else{
			return array('data'=>$cv_1,'count'=>$count);
		}
	}else{
		return FALSE;
	}
}

function execute_sp_return($name_sp, $dt=array(),$is_olahdata=1){
	$ci=&get_instance();
	$render_string_params="(";
	foreach($dt as $key=>$value){
		if($value==null)
			$render_string_params.="'$value',";
		else
			$render_string_params.="".$ci->db->escape(str_replace("'",'\'\'',$value)).",";
	}
	$render_string_params.=":r); END;";
	
	
	$conn = oci_connect($ci->db->username,$ci->db->password,$ci->db->hostname);
	$sql = "BEGIN $name_sp $render_string_params";
	
	// echo $sql;
	// exit;
	
	$stmt = oci_parse($conn,$sql);
	
	$cv_1 = oci_new_cursor($conn);
	
	oci_bind_by_name($stmt,":r",$cv_1,-1,OCI_B_CURSOR);
	
	$res1=oci_execute($stmt);
	$res2=oci_execute($cv_1);
	if($res1 && $res2){
		if($is_olahdata==1){
			$data = array();
			$i=0;
			$first_row =array();
			while ($row = oci_fetch_array($cv_1, OCI_ASSOC  + OCI_RETURN_NULLS + OCI_RETURN_LOBS)){
				$i++;
				$row['no']=$i;
				foreach($row as $key => $value){
					if(is_array($value)){
						$row[$key] = convertUtf8($value);
					}
					else{
						$row[$key] = mb_convert_encoding($value, 'UTF-8', 'HTML-ENTITIES');
					}
				}								
				if($i==1){
					$first_row = $row;
				}
				$data [] = $row;
			}
			return array('data'=>$data,'first_row'=>$first_row,'num_rows'=>$i);
		
		}else{
			return array('data'=>$cv_1);
		}
	}else{
		return FALSE;
	}
}

function execute_sp($name_sp, $dt=array()){
	$ci=&get_instance();
	$render_string_params="(";
	$i=0;
	foreach($dt as $key=>$value){
		if($i==0){
			if($value===null)
				$render_string_params.="NULL";
			else
				$render_string_params.="".$ci->db->escape(str_replace("'",'\'\'',$value));
		}else{
			if($value===null)
				$render_string_params.=",NULL";
			else
				$render_string_params.=",".$ci->db->escape(str_replace("'",'\'\'',$value));
		}
		$i++;
	}
	$render_string_params.="); END;";

	$conn = oci_connect($ci->db->username,$ci->db->password,$ci->db->hostname);
	$sql = "BEGIN $name_sp $render_string_params";
	
	// echo $sql;
	// exit;
	
	$stmt = oci_parse($conn,$sql);
	$res = oci_execute($stmt);
	return $conn;
}

function _fetch_array($cv_1){
	return oci_fetch_array($cv_1, OCI_ASSOC  + OCI_RETURN_NULLS + OCI_RETURN_LOBS);
}

function execute_sp_count2($name_sp, $dt=array(),$is_olahdata=1){
	
	
	$ci=&get_instance();
	$render_string_params="(";
	foreach($dt as $key=>$value){
		if($value==null)
			$render_string_params.="'$value',";
		else
			$render_string_params.="".$ci->db->escape(str_replace("'",'\'\'',$value)).",";
	}

	$render_string_params.=":c, :r, :r2); END;";
	
	
	$conn = oci_connect($ci->db->username,$ci->db->password,$ci->db->hostname);
	$sql = "BEGIN $name_sp $render_string_params";
	
	
	// echo $sql;
	// exit;
	$stmt = oci_parse($conn,$sql);
	
	$cv_1 = oci_new_cursor($conn);
	$cv_2 = oci_new_cursor($conn);
	$count;
	
	oci_bind_by_name($stmt,":r",$cv_1,-1,OCI_B_CURSOR);
	oci_bind_by_name($stmt,":r2",$cv_2,-1,OCI_B_CURSOR);
	oci_bind_by_name($stmt,":c",$count,-1,OCI_B_INT);
	
	$res1=oci_execute($stmt);
	$res2=oci_execute($cv_1);
	$res3=oci_execute($cv_2);
	if($res1 && $res2 && $res3){
		if($is_olahdata==1){
			$data = array();
			$no=0;
			while ($row = oci_fetch_array($cv_1, OCI_ASSOC  + OCI_RETURN_NULLS + OCI_RETURN_LOBS)) {
				$row['no']=++$no;
				$data [] = $row;
			}

			$param = array();
			while ($row = oci_fetch_array($cv_2, OCI_ASSOC  + OCI_RETURN_NULLS)) {
				$param= $row;
			}
			
			return array('param'=>$param,'data'=>$data,'count'=>$count);
		
		}else{
			return array('param'=>$cv_2,'data'=>$cv_1,'count'=>$count);
		}
	}else{
		return FALSE;
	}
}