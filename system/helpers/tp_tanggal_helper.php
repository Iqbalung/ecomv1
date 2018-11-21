<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function formatDate($tgl, $separator, $neworder, $newseparator = null) {
	if (!$newseparator) {
		$newseparator = $separator;
	}
	
	$split = explode($separator, $tgl);
	$newtgl = $split[$neworder[0]] . $newseparator . $split[$neworder[1]] . $newseparator . $split[$neworder[2]];
	return $newtgl;
}

function dmy2ymd($input, $separator = '-') {
	if ($input) {
		return formatDate($input, $separator, array(2, 1, 0));
	}
	else {
		return $input;
	}
}

function date2unix($a='01/01/1970'){
		$t=$a;
		$d=substr($t,0,2);
		$m=substr($t,3,2);
		$y=substr($t,6,4);
		return mktime(0, 0, 0, $m  , $d, $y);
}

function get_textual_month($month_number)
{

  switch($month_number)

  {

    case 1: $month = 'Januari'; break;

    case 2: $month = 'Februari'; break;

    case 3: $month = 'Maret'; break;

    case 4: $month = 'April'; break;

    case 5: $month = 'Mei'; break;

    case 6: $month = 'Juni'; break;

    case 7: $month = 'Juli'; break;

    case 8: $month = 'Agustus'; break;

    case 9: $month = 'September'; break;

    case 10: $month = 'Oktober'; break;

    case 11: $month = 'November'; break;

    case 12: $month = 'Desember'; break;

    default: $month = ''; break;

  }

  

  return $month;

}



function get_mysql_long_date($mysql_timestamp)

{

  $new_date = (int)substr($mysql_timestamp, 8, 2).' ';

  $new_date .= get_textual_month(substr($mysql_timestamp, 5, 2)).' ';

  $new_date .= substr($mysql_timestamp, 0, 4);

  

  return $new_date;

}



function get_mysql_short_date($mysql_timestamp)

{

  $new_date = substr($mysql_timestamp, 8, 2).'-';

  $new_date .= substr($mysql_timestamp, 5, 2).'-';

  $new_date .= substr($mysql_timestamp, 0, 4);

  

  return $new_date;

}



function get_php_long_date($php_timestamp){

  $new_date = date('d', $php_timestamp).' ';

  $new_date .= get_textual_month(date('m', $php_timestamp)).' ';

  $new_date .= date('Y', $php_timestamp);

  

  return $new_date;

}

function getIndonesia($php_timestamp){
	$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
	$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
	$hari = $array_hari[date('N',$php_timestamp)];
	$tanggal = date('j',$php_timestamp);
	$bulan = $array_bulan[date('n',$php_timestamp)];
	$tahun = date('Y',$php_timestamp);
    echo $hari . ", " . $tanggal ." ". $bulan ." ".$tahun; 
}

function getIndonesia2($php_timestamp){
	$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
	$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
	$hari = $array_hari[date('N',$php_timestamp)];
	$tanggal = date('j',$php_timestamp);
	$bulan = $array_bulan[date('n',$php_timestamp)];
	$tahun = date('Y',$php_timestamp);
    return $tanggal ." ". $bulan ." ".$tahun; 
}

function getDateIndonesiaPendek($date='dd/mm/yyyy'){
	$exp = explode("/",$date);
	$array_bulan = array(1=>'Jan','Feb','Mar', 'Apr', 'Mei', 'Jun','Jul','Agus','Sept','Okt', 'Nov','Des');
	if(count($exp)==3){
		$m = (int) $exp[1];
		return $exp[0].'-'.$array_bulan[$m].'-'.$exp[2];
	} else {
		return '';	
	}
}

function getIndonesia3($php_timestamp){
	$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
	$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
	$hari = $array_hari[date('N',$php_timestamp)];
	$tanggal = date('j',$php_timestamp);
	$bulan = $array_bulan[date('n',$php_timestamp)];
	$tahun = date('Y',$php_timestamp);
    return $hari.", ". $tanggal ." ". $bulan ." ".$tahun; 
}

function hari_tanggal_terbilang($time=0){
	$array_hari = array(1=>'senin','selasa','rabu','kamis','jumat', 'sabtu','minggu');
	$array_bulan = array(1=>'januari','februari','maret', 'spril', 'mei', 'juni','juli','agustus','september','oktober', 'november','desember');
	$hari = $array_hari[date('N',$time)];
	$tanggal = date('d',$time);
	$bulan = $array_bulan[date('n',$time)];
	$tahun = date('Y',$time);
	return array('HARI'=>ucfirst($hari),'TANGGAL'=>ucfirst(baca($tanggal*1)),'BULAN'=>ucfirst($bulan),'TAHUN'=>$tahun);
}

function date_to_unix($a='01/01/1090'){
	$t=$a;
	$d=substr($t,0,2);
	$m=substr($t,3,2);
	$y=substr($t,6,4);
	return mktime(0, 0, 0, $m  , $d, $y);
}

function create_time_indonesia3($a='01/01/1090'){
		$t=$a;
		$d=substr($t,0,2);
		$m=substr($t,3,2);
		$y=substr($t,6,4);
		return getIndonesia3(mktime(0, 0, 0, $m  , $d, $y));
}

function baca_tanggal($a='01/01/1090'){
		$t=$a;
		$d=substr($t,0,2);
		$m=substr($t,3,2);
		$y=substr($t,6,4);
		$php_timestamp=mktime(0, 0, 0, $m  , $d, $y);
		
		$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
		$hari = $array_hari[date('N',$php_timestamp)];
		return $hari." tanggal ". baca($d*1) ." bulan ". baca($m*1) ." tahun ".baca($y*1); 	
}

function tanggal_surat($a='01/01/1090'){
		$t=$a;
		$d=substr($t,0,2);
		$m=substr($t,3,2);
		$y=substr($t,6,4);
		$php_timestamp=mktime(0, 0, 0, $m  , $d, $y);
		
		$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
		$tanggal = date('j',$php_timestamp);
		$bulan = $array_bulan[date('n',$php_timestamp)];
		$tahun = date('Y',$php_timestamp);
		return $tanggal ." ". $bulan ." ".$tahun;
}

 function baca($n) {
    $dasar = array(1 => 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam','tujuh', 'delapan', 'sembilan');
    $angka = array(1000000000, 1000000, 1000, 100, 10, 1);
    $satuan = array('milyar', 'juta', 'ribu', 'ratus', 'puluh', '');
	 $str='';
    $i = 0;
    if($n==0){
       $str = "nol";
    }else{
       while ($n != 0) {
          $count = (int)($n/$angka[$i]);
      if ($count >= 10) {
          $str .= $this->baca($count). " ".$satuan[$i]." ";
      }else if($count > 0 && $count < 10){
          $str .= $dasar[$count] . " ".$satuan[$i]." ";
      }
      $n -= $angka[$i] * $count;
      $i++;
       }
       $str = preg_replace("/satu puluh (\w+)/i", "\\1 belas", $str);
       $str = preg_replace("/satu (ribu|ratus|puluh|belas)/i", "se\\1", $str);
    }
    return $str;
  }



function create_time_indonesia2($a='01/01/1090'){
		$t=$a;
		$d=substr($t,0,2);
		$m=substr($t,3,2);
		$y=substr($t,6,4);
		return getIndonesia2(mktime(0, 0, 0, $m  , $d, $y));
}

function PhpTimeToOLEDateTime($timestamp)
{
	$a_date = getdate ($timestamp);
	$year= $a_date['year']; //this year
	$partial_days = ($year-1900)*365;//days elapsed since 1-1-1900
	//let's calculate how many 29 february from 1900 to first day on this year
	$partial_days +=(int)(($year-1) / 4); //each 4 years a leap year since year 0
	$partial_days -= (int)(($year-1) / 100); //each 100 years skip a leap
	$partial_days += (int)(($year-1) / 400); //each 400 years add a leap
	$partial_days -= 460; //459 leap years before 1900 + 1 for math (year 0 does not exist)
	$partial_days += $a_date['yday'];

	$seconds = $a_date['hours'] * 3600;
	$seconds += $a_date['minutes'] * 60;
	$seconds += $a_date['seconds'];

	$d = (double) $partial_days;
	$d +=  ((double)$seconds)/86400.0;

	return $d;
}

function tglAkhirBulan($thn,$bln){
	$bulan[1]='31';
	$bulan[2]='28';
	$bulan[3]='31';
	$bulan[4]='30';
	$bulan[5]='31';
	$bulan[6]='30';
	$bulan[7]='31';
	$bulan[8]='31';
	$bulan[9]='30';
	$bulan[10]='31';
	$bulan[11]='30';
	$bulan[12]='31';

	if ($thn%4==0){
		$bulan[2]=29;
	}
	return $bulan[$bln];
}

function convert_tgl($tgl,$format){
	if(strlen($tgl) > 1){
		if($format == 'd/m/y'){
			$tgl_exp = explode('/',$tgl);
			$tgl_result = $tgl_exp[0] . ' ' . get_textual_month($tgl_exp[1]) . ' ' . $tgl_exp[2];
		}
		else if($format == 'd-m-y'){
			$tgl_exp = explode('-',$tgl);
			$tgl_result = $tgl_exp[0] . ' ' . get_textual_month($tgl_exp[1]) . ' ' . $tgl_exp[2];				
		}
		else if($format == 'y-m-d'){
			$tgl_exp = explode('-',$tgl);
			$tgl_result = $tgl_exp[2] . ' ' . get_textual_month($tgl_exp[1]) . ' ' . $tgl_exp[0];
		}
		else if($format == 'y/m/d'){
			$tgl_exp = explode('/',$tgl);
			$tgl_result = $tgl_exp[2] . ' ' . get_textual_month($tgl_exp[1]) . ' ' . $tgl_exp[0];
		}
	}
	else{
		$tgl_result = '';
	}
	return $tgl_result;
}

function convert_format_date($tgl,$config = array()){
	$date_result = "";
	if(strlen($tgl) > 1){	
		$old_separator = ifunsetempty($config,"old_separator","/");
		$new_separator = ifunsetempty($config,"new_separator","-");
		$old_separator_time = ifunsetempty($config,"old_separator_time",":");
		$new_separator_time = ifunsetempty($config,"new_separator_time",".");
		$date_order = ifunsetempty($config,"date_order",array(2,1,0));
		$time_order = ifunsetempty($config,"date_order",array(0,1,2));		
		$is_time = ifunset($config,"is_time",true);		
		$date = explode(" ",$tgl);
		$date = ifunsetempty($date,0,array());		
		$date_exp = explode($old_separator,$date);		
		foreach ($date_order as $key => $value) {
			$date_result .= ifunsetempty($date_exp,$value,"00");						
			if ($key < count($date_order)-1)
			{
				$date_result .= $new_separator;
			}
		}			
		if ($is_time)
		{			
			$time = explode(" ",$tgl);
			$time = ifunsetempty($time,1,array());
			$time_exp = explode($old_separator_time,$time);
			$time_result = "";			
			foreach ($time_order as $key => $value) {
				$time_result .= ifunsetempty($time_exp,$value,"00");
				if ($key < count($time_order)-1)
				{
					$time_result .= $new_separator_time;
				}
			}

			$date_result .= " ".$time_result;
		}
	}
	else{
		$date_result = '';
	}
	return $date_result;
}



/* End of file tanggal_helper.php */

/* Location: ./application/helpers/tanggal_helper.php */