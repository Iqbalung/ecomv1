<?php
class M_importdata extends CI_Model{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	

	function get_iku_sasaran($id, $tahun){
		$q = $this->db->query("
				SELECT * from a_indikator_sasaran
				where id_sasaran = ? and tahun = ?
			", array($id, $tahun));
		return $q;
	}

	function get_iku_program ( $id, $tahun , $id_jenisanggaran){
		
		$q = $this->db->query("
			select * from a_indikator_progsatker a
			where a.kode_program = ? and tahun = ?
			", array( $id, $tahun ) );
		return $q;
	}

	function get_iku_kegiatan($id, $tahun){
		$q = $this->db->query("
				select * from a_indikator_kegiatan
				where 
				id_keg = ? and tahun = ?
			",array($id, $tahun));
		return $q;
	}
	

	function get_satker_eselon2() {
		return $this->db->query("SELECT id_satker, rkpdid from SAKIP_MST_UNITKERJA
		where LEN(ID_SATKER) - LEN(REPLACE(ID_SATKER, '.', '')) = 2 ");
	}

	function delete_sakip_pk( $tahun ) {

		$jenis = $this->session->userdata('jenis');
		
		$this->db->query('DELETE FROM SAKIP_INDIKATOR_SASARAN where tahun = ? and id_jenisanggaran = ? ', array( $tahun, $jenis  ));
		
		$this->db->query('DELETE FROM SAKIP_KEGIATAN where tahun = ? and id_jenisanggaran = ? ', array( $tahun, $jenis  ));

		$this->db->query('DELETE FROM SAKIP_PROGRAM where tahun = ? and idjenisanggaran = ? ', array( $tahun, $jenis  ));
		
		$this->db->query('DELETE FROM SAKIP_MST_SASARAN where tahun_sasaran = ? and id_jenisanggaran = ? ', array( $tahun, $jenis  ));
	}


	function get_sasaran_by_satkerid ($satkerid, $tahun) {

		$jenis = $this->session->userdata('jenis'); // murni atau PAK

		$res = $this->db->query("
		SELECT  convert(nvarchar(50), newid()) newid, nama_sasaran, tahun, id_sasaran FROM (
			SELECT 
				DISTINCT msa.nama_sasaran,
				msa.tahun, msa.id_sasaran
			from  a_program ap
			left join master_sasaran msa on 
				ap.id_sasaran = msa.id_sasaran and isnull(msa.is_deleted,0) = 0 and msa.tahun = ?
			left join master_prokeg mp on ap.id_prokeg = mp.id_prokeg and mp.tahun = ? 
			left join a_program ap2 on ap.id_prokeg = ap2.id_prokeg and ap2.tahun = ?
				and ap.id_satker = ap2.id_satker and ap.kode_prog = ap2.kode_prog and ap2.id_jenisanggaran = ? and isnull(ap2.is_deleted,0) = 0
			left join master_urusan mu on mp.id_urusan = mu.id_urusan and mu.tahun = ? 
			left join master_satker ms on ap.id_satker = ms.id_satker and ms.tahun = ?
			where ap.id_satker like  ? and ap.id_jenisanggaran = ? and isnull(msa.is_deleted,0) = 0
		) tab
		", array ( $tahun, $tahun, $tahun, $jenis, $tahun, $tahun, $satkerid, $jenis ) );

		//echo $this->db->last_query();

		return $res->result_array();
	}

	function insert_sasaran($data, $satkerid_sakip) {

		$jenis = $this->session->userdata('jenis');

		$params = array(
			 'id_sasaran' => $data['newid'], 
			 'id_satker' => $satkerid_sakip, 
			 'rkpdid' => $data['id_sasaran'],
			 'kode_sasaran'=> $data['id_sasaran'],
			 'tahun_sasaran'=> $data['tahun'],
			 'nama_sasaran'=> $data['nama_sasaran'],
			 'id_jenisanggaran'=> $jenis
		);
		return $this->db->insert('SAKIP_MST_SASARAN', $params);
	}

	function insert_kegiatan($data, $program_id) {
		
		$params = array( 
			 'nama_kegiatan' 	=> $data['nama_kegiatan'],
			 'pagu_dana_rkpd'	=> $data['pagu_dana_rkpd'],
		//	 'datecreated'		=> date('Y-m-d'),
			 'tahun'			=> $data['tahun'],
			 'rkpdid'			=> $data['id_keg'],
			 'id_jenisanggaran'	=> $data['id_jenisanggaran'],
			 'id_kegiatan'		=> $data['newid'],
			 'id_program'		=> $program_id
		);

		return $this->db->insert('SAKIP_KEGIATAN', $params);
	}

	function insert_program($data, $sasaran_id) {

		$params = array(
			 'id_sasaran' 		=> $sasaran_id,  
			 'nama_program' 	=> $data['nama_program'],
			 'target' 			=> $data['total_paguindikatif_rkpd'],
			 'datecreated'		=> date('Y-m-d'),
			 'tahun'			=> $data['tahun'],
			 'rkpdid'			=> $data['id_prog'],
			 'idjenisanggaran'	=> $data['id_jenisanggaran'],
			 'id_program'		=> $data['newid']
		);

		return $this->db->insert('SAKIP_PROGRAM', $params );
	}


	function get_program_by_sasaranid ($sasaran_id, $satkerid, $tahun) {

		$jenis = $this->session->userdata('jenis'); // murni atau PAK

		$res = $this->db->query(
		"SELECT convert(nvarchar(50), newid()) newid,nama_program, total_paguindikatif_rkpd, kode_prog, id_prog, id_jenisanggaran, status, tahun
		FROM (SELECT
			DISTINCT 
			ap.nama_program, 
			ap.total_paguindikatif_rkpd, 
			ap.kode_prog, 
			ap.id_prog, 
			ap.id_jenisanggaran, 
			ap.status,
			ap.tahun
		from  a_program ap
		join master_sasaran msa on 
			ap.id_sasaran = msa.id_sasaran and isnull(msa.is_deleted,0) = 0 and msa.tahun = ?
		left join master_prokeg mp on ap.id_prokeg = mp.id_prokeg and mp.tahun = ? 
		left join a_program ap2 on ap.id_prokeg = ap2.id_prokeg and ap2.tahun = ?
			and ap.id_satker = ap2.id_satker and ap.kode_prog = ap2.kode_prog and ap2.id_jenisanggaran = ? and isnull(ap2.is_deleted,0) = 0
		left join master_urusan mu on mp.id_urusan = mu.id_urusan and mu.tahun = ? 
		left join master_satker ms on ap.id_satker = ms.id_satker and ms.tahun = ?
		where ap.id_satker like  ? and msa.id_sasaran = ?
		and ap.id_jenisanggaran = ? ) tab
		", array ( $tahun, $tahun, $tahun, $jenis, $tahun, $tahun, $satkerid, $sasaran_id, $jenis ) );


	
		return $res->result_array();
	}

	function get_kegiatan_by_progid ($program_id, $satkerid, $tahun) {

		$jenis = $this->session->userdata('jenis'); // murni atau PAK

		$res = $this->db->query(
			"SELECT convert(nvarchar(50), newid())  newid, * from a_kegiatan ak
			left join a_urusan_satker aus on ak.id_satkerurusan = aus.id_satkerurusan and aus.tahun = ? 
			    and isnull(aus.is_deleted,0) = 0 and aus.id_jenisanggaran = 2
			left join a_urusan_satker aus2 on ak.id_satker = aus2.id_satker and aus2.tahun = ?
					and isnull(aus2.is_deleted,0) = 0 and aus2.id_jenisanggaran = 2 and aus2.is_pokok = 1
			left join master_urusan mu on isnull(aus2.id_urusan,aus.id_urusan) = mu.id_urusan and mu.tahun = ?
			left join master_satker ms on isnull(ak.id_satker,aus.id_satker) = ms.id_satker and ms.tahun = ? and isnull(ms.is_deleted,0) = 0
			where  ak.id_jenisanggaran = ? and ak.id_satker = ? and ak.id_prog = ?
		", array ( $tahun, $tahun, $tahun, $tahun, $jenis, $satkerid, $program_id ) );
		return $res->result_array();
	}

	function insert_indikator ($data,$id, $tipe) {

		$jenis = $this->session->userdata('jenis');
		foreach ($data->result_array() as $key => $value) {

			if ($tipe == 1) {
				$nama_idk = $value['nama_indikator'];
				$target = $value['target_indikator'];
				$rumus = $value['formula_indikator'];
			} else if ($tipe == 2) {
				$nama_idk = $value['indikator_program'];
				$target = $value['targetRKPD'];
				$rumus = $value['formula_perhitungan'];

			} else if ($tipe == 3) {
				$nama_idk = $value['tolok_ukur_hasil_rkpd'];
				$target = $value['target_hasil_rkpd'];
				$rumus = '';
			}

			$target = (int) $target;
			$satuan =  (string) trim(substr($target, strlen($target) ));

			return $this->db->query("
				INSERT INTO SAKIP_INDIKATOR_SASARAN   (id_indikator,id_sasaran,kode_indikatorsasaran, rkpdid, nama_indikator, target_indikator,satuan_indikator, tahun ,formula_indikator, tipe, id_jenisanggaran)
				SELECT 
					convert(nvarchar(50), newid()) newid,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?,
					?
			", array(
				$id,
				$value['id_indikator'],
				$value['id_indikator'],
				$nama_idk ,
				$target,
				$satuan,
				$value['tahun'],
				$rumus,
				$tipe,
				$jenis
			));
		
		}
	}

}