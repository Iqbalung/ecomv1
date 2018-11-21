<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
			$this->load->model('M_dashboard');
	}
	
	public function get_grafik_penjualan() {
		$date1 	= ifunsetempty($_POST,'date1','2018-08-01');
		$date2 	= ifunsetempty($_POST,'date2','2018-08-30');
		$jenis_filter 	= $this->input->post('jenis_filter');
		if ($jenis_filter == 'mingguan' || true) {
			$res 	= $this->M_dashboard->get_grafik_penjualan_harian($date1, $date2);
			echo json_encode($res->result_array());
		}
	}


	public function get_total_uang_masuk() {
		
		$date1 	= ifunsetempty($_POST,'date1','2018-08-01');
		$date2 	= ifunsetempty($_POST,'date2','2018-08-30');

		$label 	= ifunsetempty($_POST,'label','bulanan');

		if ( $label == 'mingguan' ) 
		{
			$date3 	= date('Y-m-d', strtotime($date1 . ' - 7 days'));
			$date4 	= date('Y-m-d', strtotime($date1 . ' - 1 days'));

			$satuan_waktu = 'minggu sebelumnya';

		} else if (  $label == 'harian' )
		{
			$date3 	= date('Y-m-d', strtotime($date1 . ' - 1 days'));
			$date4 	= date('Y-m-d', strtotime($date1 . ' - 1 days'));

			$satuan_waktu = 'hari sebelumnya';
		} else if (  $label == 'bulanan' )
		{
			$date3 	= date('Y-m-d', strtotime($date1 . ' - 30 days'));
			$date4 	= date('Y-m-d', strtotime($date1 . ' - 1 days'));

			$satuan_waktu = 'periode sebelumnya';
		} else {

			$datetime1 = strtotime($date1);
			$datetime2 = strtotime($date2);

			$secs = $datetime2 - $datetime1;// == <seconds between the two times>
			$days = (int)($secs / 86400);

			$date3 	= date('Y-m-d', strtotime($date1 . " - $days days"));
			$date4 	= date('Y-m-d', strtotime($date1 . " - 1 days"));

			$satuan_waktu = 'periode sebelumnya';
		}


		$res = $this->M_dashboard->get_total_uang_masuk($date1, $date2);
		$res2 = $this->M_dashboard->get_total_uang_masuk($date3, $date4);

		$r = isset($res->row()->jml)? $res->row()->jml : '';
		$r2 = isset($res2->row()->jml)? $res2->row()->jml : '';

		$selisih = ($r - $r2);
		if ($r != 0) {

			if ($selisih > 0) {
			$compare = (round( ( ( $selisih )/$r )*100 )) . "% (+Rp$selisih) <br/>dari $satuan_waktu";
				$result = '+';
			} else {
				$compare = (round(( ( $selisih )/$r )*100 )) . "% (-Rp$selisih) <br/>dari $satuan_waktu";
				$result = '-';
			}
		} else {
			$compare = "-100% (Rp$selisih)<br/> dari $satuan_waktu";
			$result = '-';
		}
		$hasil_rupiah = "Rp " . number_format($r,0,',','.');
		echo json_encode( array('jml' => $hasil_rupiah,'jml2' => $r2,'compare' => $compare,'result' => $result ) );



	}


	public function get_profit() {
		
		$date1 	= ifunsetempty($_POST,'date1','2018-08-01');
		$date2 	= ifunsetempty($_POST,'date2','2018-08-30');
		
		$label 	= ifunsetempty($_POST,'label','bulanan');

		if ( $label == 'mingguan' ) 
		{
			$date3 	= date('Y-m-d', strtotime($date1 . ' - 7 days'));
			$date4 	= date('Y-m-d', strtotime($date1 . ' - 1 days'));

			$satuan_waktu = 'minggu sebelumnya';

		} else if (  $label == 'harian' )
		{
			$date3 	= date('Y-m-d', strtotime($date1 . ' - 1 days'));
			$date4 	= date('Y-m-d', strtotime($date1 . ' - 1 days'));

			$satuan_waktu = 'hari sebelumnya';
		} else if (  $label == 'bulanan' )
		{
			$date3 	= date('Y-m-d', strtotime($date1 . ' - 30 days'));
			$date4 	= date('Y-m-d', strtotime($date1 . ' - 1 days'));

			$satuan_waktu = 'periode sebelumnya';
		} else {

			$datetime1 = strtotime($date1);
			$datetime2 = strtotime($date2);

			$secs = $datetime2 - $datetime1;// == <seconds between the two times>
			$days = (int)($secs / 86400);

			$date3 	= date('Y-m-d', strtotime($date1 . " - $days days"));
			$date4 	= date('Y-m-d', strtotime($date1 . " - 1 days"));

			$satuan_waktu = 'periode sebelumnya';
		}


		$masuk = $this->M_dashboard->get_total_uang_masuk($date1, $date2);
		$keluar = $this->M_dashboard->get_total_pengeluaran($date1, $date2);

		$masuk2 = $this->M_dashboard->get_total_uang_masuk($date3, $date4);
		$keluar2 = $this->M_dashboard->get_total_pengeluaran($date3, $date4);

		$m = isset($masuk->row()->jml)? $masuk->row()->jml : 0;
		$m2 = isset($masuk2->row()->jml)? $masuk2->row()->jml : 0;
		
		$k = isset($keluar->row()->jml)? $keluar->row()->jml : 0;
		$k2 = isset($keluar2->row()->jml)? $keluar2->row()->jml : 0;

		$r = $m - $k;
		$r2 = $m2 - $k2;

		$selisih = ($r - $r2);
		if ($r != 0) {

			if ($selisih > 0) {
			$compare = ( round(( ( $selisih )/$r )*100) ) . "% (+Rp$selisih) <br/>dari $satuan_waktu";
				$result = '+';
				
			} else {
				$compare = ( round(( ( $selisih )/$r )*100) ) . "% (-Rp$selisih) <br/>dari $satuan_waktu";
				$result = '-';
			}
		} else {
			$compare = "100% (-Rp$selisih)<br/> dari $satuan_waktu";
			$result = '-';
		}
		$hasil_rupiah = "Rp " . number_format($r,0,',','.');
		echo json_encode( array('jml' => $hasil_rupiah,'jml2' => $r2,'compare' => $compare,'result' => $result) );
		
	}



	public function get_jumlahtransaksi_range()
	{
		$date1 	= ifunsetempty($_POST,'date1','2018-08-01');
		$date2 	= ifunsetempty($_POST,'date2','2018-08-30');

		$label 	= ifunsetempty($_POST,'label','bulanan');

		if ( $label == 'mingguan' ) 
		{
			$date3 	= date('Y-m-d', strtotime($date1 . ' - 7 days'));
			$date4 	= date('Y-m-d', strtotime($date1 . ' - 1 days'));

			$satuan_waktu = 'minggu sebelumnya';

		} else if (  $label == 'harian' )
		{
			$date3 	= date('Y-m-d', strtotime($date1 . ' - 1 days'));
			$date4 	= date('Y-m-d', strtotime($date1 . ' - 1 days'));

			$satuan_waktu = 'hari sebelumnya';
		} else if (  $label == 'bulanan' )
		{
			$date3 	= date('Y-m-d', strtotime($date1 . ' - 30 days'));
			$date4 	= date('Y-m-d', strtotime($date1 . ' - 1 days'));

			$satuan_waktu = 'periode sebelumnya';
		}  else {

			$datetime1 = strtotime($date1);
			$datetime2 = strtotime($date2);

			$secs = $datetime2 - $datetime1;// == <seconds between the two times>
			$days = (int)($secs / 86400);

			$date3 	= date('Y-m-d', strtotime($date1 . " - $days days"));
			$date4 	= date('Y-m-d', strtotime($date1 . " - 1 days"));

			$satuan_waktu = 'periode sebelumnya';
		}
		
	
		$res 	= $this->M_dashboard->get_jumlahtransaksi_range($date1, $date2);
		$res2 	= $this->M_dashboard->get_jumlahtransaksi_range($date3, $date4);
		
		$r = isset($res->row()->jml)? $res->row()->jml : 0;
		$r2 = isset($res2->row()->jml)? $res2->row()->jml : 0;
		
		$selisih = ($r - $r2);
		if ($r != 0) {

			$compare = ( round(( ( $selisih )/$r )*100) ) . "% dari $satuan_waktu";
			
			if ($selisih > 0) {
				$result = '+';	
			} else {
				$result = '-';
			}
		} else {
			$compare = "-100% dari $satuan_waktu";
			$result = '-';
		}

		echo json_encode(array('jml'=> $r,'jml2'=> $r2,'compare'=> $compare,'result' => $result));

	}

	public function get_produk_tertinggi() {
		$date1 	= ifunsetempty($_POST,'date1','2018-08-01');
		$date2 	= ifunsetempty($_POST,'date2','2018-08-30');
		
		$res 	= $this->M_dashboard->get_produk_tertinggi($date1, $date2);
		echo json_encode($res->result_array());
	}

	public function get_kategori_tertinggi() {
		$date1 	= ifunsetempty($_POST,'date1','2018-08-01');
		$date2 	= ifunsetempty($_POST,'date2','2018-08-30');
		
		$res 	= $this->M_dashboard->get_kategori_tertinggi($date1, $date2);
		echo json_encode($res->result_array());
	}

	public function get_mediasale() {
		$date1 	= ifunsetempty($_POST,'date1','2018-08-01');
		$date2 	= ifunsetempty($_POST,'date2','2018-08-30');
		
		$res 	= $this->M_dashboard->get_mediasale($date1, $date2);
		echo json_encode($res->result_array());
	}

}

/* End of file App.php */
/* Location: ./application/controllers/dashboard/App.php */