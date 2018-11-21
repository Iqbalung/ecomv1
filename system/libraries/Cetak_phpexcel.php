<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('PHPExcel.php');
require_once('PHPExcel/IOFactory.php');

class CI_Cetak_phpexcel
{
	function __construct($type="") {

    }


    function createNew() {
        $objPHPExcel = new PHPExcel();

        return $objPHPExcel;		
    }


    function loadTemplate($str) {
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($str);

        return $objPHPExcel;
    }


    function writeFile($phpExcelReader, $fileName) {
        $writer = PHPExcel_IOFactory::createWriter($phpExcelReader, 'Excel2007');
        $writer->save($fileName);

        return $writer;
    }
	
	function createColom($sheet,$base,$height,$colomStart,$ln,$value,$center){		
		$height+=$base-1;
		$c=$ln;
		$ln=$colomStart+$ln-1;
		
		$A=$this->getNameFromNumber($colomStart);
		$B=$this->getNameFromNumber($ln);
		$sheet->setCellValue($A . $base, $value);
		$colomStart=$ln+1;
		
		
		$sheet->getStyle("$A$base:$B$height")->getAlignment()->setWrapText(true);
		
		if( $base!=$height || $c!=1)
			$sheet->mergeCells("$A$base:$B$height");
		
		if($center===FALSE){
			$sheet->getStyle("$A$base:$B$height")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			$sheet->getStyle("$A$base:$B$height")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		}else{
			$sheet->getStyle("$A$base:$B$height")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			$sheet->getStyle("$A$base:$B$height")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
		
		$sheet->getStyle("$A$base:$B$height")->getFont()->setSize(8);;
		
		return $colomStart;
	}
	
	
	function getNameFromNumber($num) {
		$numeric = ($num - 1) % 26;
		$letter = chr(65 + $numeric);
		$num2 = intval(($num - 1) / 26);
		if ($num2 > 0) {
			return $this->getNameFromNumber($num2) . $letter;
		} else {
			return $letter;
		}
	}
	
	function getRowcount($text, $width=55) {
		$rc = 0;
		$line = explode("\n", $text);
		foreach($line as $source) {
			$rc += intval((strlen($source) / $width) +1);
		}
		return $rc;
	}
	
	
	
	
}