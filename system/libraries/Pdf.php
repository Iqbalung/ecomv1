<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class CI_Pdf extends tcpdf
{
    function __construct()
    {
        parent::__construct();
    }

    function create($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false)
    {
    	$pdf = new tcpdf($orientation, $unit, $format, $unicode, $encoding, $diskcache,$pdfa);
    	return $pdf;
    }
}