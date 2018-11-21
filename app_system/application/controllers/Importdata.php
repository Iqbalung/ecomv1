<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Importdata extends MY_Controller{
	function __construct()
    {
		parent::__construct();
		$this->load->model(array('M_log','M_importdata'));
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','20048M');
	}

	public function importdata_by_satker($satkerid, $satkerid_sakip) 
	{
		
		$tahun 		= $this->session->userdata('tahun');

		$sasaran 	= $this->M_importdata->get_sasaran_by_satkerid($satkerid, $tahun);

		foreach ($sasaran as $key => $row) {
			
			$insert_sasaran = $this->M_importdata->insert_sasaran($row, $satkerid_sakip);

			$iku_sasaran = $this->M_importdata->get_iku_sasaran($row['id_sasaran'], $tahun);

			$this->M_importdata->insert_indikator( $iku_sasaran , $row['newid'], 1);
			
			$program 	= $this->M_importdata->get_program_by_sasaranid($row['id_sasaran'], $satkerid, $tahun);

			foreach ($program as $key => $row2) {
				
				$insert_program = $this->M_importdata->insert_program($row2, $row['newid']);
				
				$iku_program 	= $this->M_importdata->get_iku_program($row2['kode_prog'], $tahun, $row2['id_jenisanggaran']);
				
				$this->M_importdata->insert_indikator( $iku_program , $row2['newid'], 2);

				$kegiatan 	= $this->M_importdata->get_kegiatan_by_progid($row2['id_prog'], $satkerid, $tahun);
				
				foreach ($kegiatan as $key => $row3) {
					
					$insert_kegiatan = $this->M_importdata->insert_kegiatan($row3, $row2['newid']);
					
					$iku_kegiatan 	= $this->M_importdata->get_iku_kegiatan($row3['id_keg'], $tahun);
					
					$insert_idk = $this->M_importdata->insert_indikator( $iku_kegiatan , $row3['newid'], 3);

				}


			}
		}	

		echo "Integrasi sukses dan berhasil"; 
	}


	public function import_from_rkpd() {
		
		$tahun 		= $this->session->userdata('tahun');

		$this->M_importdata->delete_sakip_pk($tahun);
		
		$res = $this->M_importdata->get_satker_eselon2();
		
		foreach ($res->result_array() as $key => $value) {
			$this->importdata_by_satker( $value['rkpdid'], $value['id_satker'] );			
		}
	}


}
