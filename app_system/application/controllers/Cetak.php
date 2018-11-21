<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
			$this->load->model(array('M_cetak'));
	}

	public function index()
	{
		redirect('dashboard');
	}

	public function shipping_label(){
		$trx_id = "#SO-4847324";
		$template = $this->config->item("path_client_tpl")."shipping_label.xlsx";			
		$output_file_name = "Shiping Label ".$trx_id.".xlsx";
		$TBS = $this->template_cetak->createNew("xlsx",$template);
		$arg['trx_id'] = $trx_id;
		$trx = $this->M_cetak->get_trx_by_id($arg)->row_array();
		$item = $this->M_cetak->get_items($arg)->result_array();
		$TBS->MergeField("trx_shipping_name",$trx['trx_shipping_name']);
		$TBS->MergeField("trx_shipping_country",$trx['trx_shipping_country']);
		$TBS->MergeField("trx_shipping_phone",$trx['trx_shipping_phone']);
		$TBS->MergeField("trx_shipping_address_1",$trx['trx_shipping_address_1']);
		$TBS->MergeField("trx_shipping_city",$trx['trx_shipping_city']);
		$TBS->MergeField("trx_shipping_zip",$trx['trx_shipping_zip']);
		$TBS->MergeField("trx_shipping_zip",$trx['trx_shipping_zip']);
		$TBS->MergeField("courier_name",$trx['courier_name']);
		$TBS->MergeBlock("product",$item);
		$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
	}

	public function shipping_label_pdf($trx_id)
	{
		$this->load->library("Pdf");
		$trx_id = base64_decode($trx_id);
		
		$arg['trx_id'] = $trx_id;
		$trx = $this->M_cetak->get_trx_by_id($arg)->row_array();
		$item = $this->M_cetak->get_items($arg)->result_array();
		$data = array(
			"trx" => $trx,
			"items" => $item,
		);
		$pdf = $this->pdf->create('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->AddPage();
		$pdf->Image($this->config->item('path_client').'images/header2.png', 5, 3, 200, 35, 'png', '', '', true, 300, '', false, false, 0, false, false, false);			
		$html = $this->load->view("cetak/shipping_label",$data,true);
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('Shipping Label '.$trx_id.'.pdf', 'I');
	}

	public function multy_shipping_label_pdf($trx_id)
	{
		$this->load->library("Pdf");				
		$list_trx_id = json_decode(base64_decode($trx_id),true);				
		if (is_array($list_trx_id) && count($list_trx_id))
		{
			$pdf = $this->pdf->create('P', 'mm', 'A4', true, 'UTF-8', false);
			foreach ($list_trx_id as $trx_id)
			{		
				$arg['trx_id'] = $trx_id;
				$trx = $this->M_cetak->get_trx_by_id($arg)->row_array();
				$item = $this->M_cetak->get_items($arg)->result_array();
				$data = array(
					"trx" => $trx,
					"items" => $item,
				);				
				$pdf->AddPage();
				$pdf->Image($this->config->item('path_client').'images/header2.png', 5, 3, 200, 35, 'png', '', '', true, 300, '', false, false, 0, false, false, false);			
				$html = $this->load->view("cetak/shipping_label",$data,true);
				$pdf->writeHTML($html, true, false, true, false, '');
			}
			$pdf->Output('Shipping Label '.$trx_id.'.pdf', 'I');
		}
	}

	public function invoice(){
		$trx_id = "#SO-4847324";
		$template = $this->config->item("path_client_tpl")."invoice.xlsx";			
		$output_file_name = "Invoice ".$trx_id.".xlsx";
		$TBS = $this->template_cetak->createNew("xlsx",$template);
		$arg['trx_id'] = $trx_id;
		$trx = $this->M_cetak->get_trx_by_id($arg)->row_array();
		$item = $this->M_cetak->get_items($arg)->result_array();
		$TBS->MergeField("trx_customer",$trx['trx_customer']);
		$TBS->MergeField("trx_customer_email",$trx['trx_customer_email']);
		$TBS->MergeField("trx_id",$trx['trx_id']);
		$TBS->MergeField("trx_shipping_name",$trx['trx_shipping_name']);
		$TBS->MergeField("trx_shipping_country",$trx['trx_shipping_country']);
		$TBS->MergeField("trx_shipping_phone",$trx['trx_shipping_phone']);
		$TBS->MergeField("trx_shipping_address_1",$trx['trx_shipping_address_1']);
		$TBS->MergeField("trx_shipping_city",$trx['trx_shipping_city']);
		$TBS->MergeField("trx_shipping_zip",$trx['trx_shipping_zip']);
		$TBS->MergeField("trx_shipping_zip",$trx['trx_shipping_zip']);
		$TBS->MergeField("trx_total",$trx['trx_total']);
		$TBS->MergeField("trx_invoice",$trx['trx_invoice']);
		$TBS->MergeField("trx_date",$trx['trx_date']);
		$TBS->MergeField("trx_payment_term",$trx['trx_payment_term']);
		$TBS->MergeField("courier_name",$trx['courier_name']);
		$TBS->MergeBlock("product",$item);
		$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
	}

	public function invoice_pdf($trx_id)
	{
		$this->load->library("Pdf");
		$trx_id = base64_decode($trx_id);
		
		$arg['trx_id'] = $trx_id;
		$trx = $this->M_cetak->get_trx_by_id($arg)->row_array();
		$item = $this->M_cetak->get_items($arg)->result_array();
		$data = array(
			"trx" => $trx,
			"items" => $item,
		);
		$pdf = $this->pdf->create('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->AddPage();
		$pdf->Image($this->config->item('path_client').'images/header2.png', 5, 3, 200, 35, 'png', '', '', true, 300, '', false, false, 0, false, false, false);			
		$html = $this->load->view("cetak/invoice",$data,true);
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('Invoice '.$trx_id.'.pdf', 'I');
	}

	public function multy_invoice_pdf($trx_id)
	{
		$this->load->library("Pdf");
		$list_trx_id = json_decode(base64_decode($trx_id),true);		
		if (is_array($list_trx_id) && count($list_trx_id))
		{
			$pdf = $this->pdf->create('P', 'mm', 'A4', true, 'UTF-8', false);
			foreach ($list_trx_id as $trx_id)
			{
				$arg['trx_id'] = $trx_id;
				$trx = $this->M_cetak->get_trx_by_id($arg)->row_array();
				$item = $this->M_cetak->get_items($arg)->result_array();
				$data = array(
					"trx" => $trx,
					"items" => $item,
				);
				$pdf->AddPage();
				$pdf->Image($this->config->item('path_client').'images/header2.png', 5, 3, 200, 35, 'png', '', '', true, 300, '', false, false, 0, false, false, false);			
				$html = $this->load->view("cetak/invoice",$data,true);
				$pdf->writeHTML($html, true, false, true, false, '');
			}	

			$pdf->Output('Invoices.pdf', 'I');
		}
		
	}

	public function surat_jalan(){
		$trx_id = "#SO-4847324";
		$template = $this->config->item("path_client_tpl")."surat_jalan.xlsx";			
		$output_file_name = "Surat Jalan ".$trx_id.".xlsx";
		$TBS = $this->template_cetak->createNew("xlsx",$template);
		$arg['trx_id'] = $trx_id;
		$trx = $this->M_cetak->get_trx_by_id($arg)->row_array();
		$item = $this->M_cetak->get_items($arg)->result_array();
		$TBS->MergeField("trx_customer",$trx['trx_customer']);
		$TBS->MergeField("trx_id",$trx['trx_id']);
		$TBS->MergeField("trx_shipping_name",$trx['trx_shipping_name']);
		$TBS->MergeField("trx_shipping_country",$trx['trx_shipping_country']);
		$TBS->MergeField("trx_shipping_phone",$trx['trx_shipping_phone']);
		$TBS->MergeField("trx_shipping_address_1",$trx['trx_shipping_address_1']);
		$TBS->MergeField("trx_shipping_city",$trx['trx_shipping_city']);
		$TBS->MergeField("trx_shipping_zip",$trx['trx_shipping_zip']);
		$TBS->MergeField("trx_shipping_zip",$trx['trx_shipping_zip']);
		$TBS->MergeField("courier_name",$trx['courier_name']);
		$TBS->MergeBlock("product",$item);
		$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
	}

	public function surat_jalan_pdf($trx_id)
	{
		$this->load->library("Pdf");
		$trx_id = base64_decode($trx_id);
		
		$arg['trx_id'] = $trx_id;
		$trx = $this->M_cetak->get_trx_by_id($arg)->row_array();
		$item = $this->M_cetak->get_items($arg)->result_array();
		$data = array(
			"trx" => $trx,
			"items" => $item,
		);
		$pdf = $this->pdf->create('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->AddPage();
		$pdf->Image($this->config->item('path_client').'images/header2.png', 5, 3, 200, 35, 'png', '', '', true, 300, '', false, false, 0, false, false, false);			
		$html = $this->load->view("cetak/surat_jalan",$data,true);
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('Surat Jalan '.$trx_id.'.pdf', 'I');
	}

	public function multy_surat_jalan_pdf($trx_id)
	{
		$this->load->library("Pdf");				
		$list_trx_id = json_decode(base64_decode($trx_id),true);				
		if (is_array($list_trx_id) && count($list_trx_id))
		{
			$pdf = $this->pdf->create('P', 'mm', 'A4', true, 'UTF-8', false);
			foreach ($list_trx_id as $trx_id)
			{
				
				$arg['trx_id'] = $trx_id;
				$trx = $this->M_cetak->get_trx_by_id($arg)->row_array();
				$item = $this->M_cetak->get_items($arg)->result_array();
				$data = array(
					"trx" => $trx,
					"items" => $item,
				);				
				$pdf->AddPage();
				$pdf->Image($this->config->item('path_client').'images/header2.png', 5, 3, 200, 35, 'png', '', '', true, 300, '', false, false, 0, false, false, false);			
				$html = $this->load->view("cetak/surat_jalan",$data,true);
				$pdf->writeHTML($html, true, false, true, false, '');
			}
			$pdf->Output('Surat Jalan '.$trx_id.'.pdf', 'I');
		}
	}

}

/* End of file App.php */
/* Location: ./application/controllers/App.php */