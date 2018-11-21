<?php

class M_App extends CI_Model{
	function __construct(){
		$this->load->database();
	}

	function do_login($params=array())
	{
		$this->db->select('*');
		$this->db->where('U.UNAME', $params['USERNAMA']);
		$this->db->where('U.PASS', $params['USERPASSWORD']);
		$res = $this->db->get('ADMIN  U');
		return $res;
	}

	function do_login2($params=array())
	{
		$this->db->select('*');
		$this->db->where('U.USERNAME', $params['USERNAMA']);
		$this->db->where('U.PASSWORD', $params['USERPASSWORD']);
		$res = $this->db->get('MEMBER  U');
		return $res;
	}

	/*function cek_login($email,$password) {
		$q=$this->db->query("SELECT
			-- 0 AS PEGAWAIID,
			-- A.USERID, A.NIP, A.NAMA, A.INSTANSIID, A.TELP, A.HP, A.EMAIL, A.USERGROUPID,
			A.USERID, A.USERNIP, A.USERNAMA,
			ifnull(B.SATKERID, A.SATKERID) as SATKERID,
			C.USRGROUP_NAME, C.USERGROUPID,
			D.MODULID, D.MODUL, D.LONG_NAME
		FROM userlogin A
			LEFT JOIN SAKIP_USERGROUP C ON B.USERGROUPID = C.USERGROUPID
			-- LEFT JOIN ESURTA_MASTER_INSTANSI D ON A.INSTANSIID = D.INSTANSIID
		WHERE
			A.USERLOGIN = '".$email."'
			AND A.USERPASSWORD = '".md5($password)."'");
		return $q;		
	}
*/
	function cek_user($email,$password) {
		if (strpos($email, '@') === FALSE) {
			$email = $email.'@big.go.id';
		}
		$q=$this->db->query("SELECT
			-- 0 AS PEGAWAIID,
			-- A.USERID, A.NIP, A.NAMA, A.INSTANSIID, A.TELP, A.HP, A.EMAIL, A.USERGROUPID,
			A.USERID, A.USERNIP, A.USERNAMA, A.AKTIF, 
			C.USRGROUP_NAME, C.USERGROUPID,
			D.MODULID, D.MODUL, D.LONG_NAME,
			E.EMAIL, E.PELAPORID
		FROM USERLOGIN A
			LEFT JOIN USER_USERGROUP B ON A.USERID = B.USERID
			LEFT JOIN USERGROUP C ON B.USERGROUPID = C.USERGROUPID
			LEFT JOIN USERMNG_MODUL D ON C.MODULID = D.MODULID
			LEFT JOIN MASTER_PELAPOR E ON A.PELAPORID = E.PELAPORID
			-- LEFT JOIN ESURTA_MASTER_INSTANSI D ON A.INSTANSIID = D.INSTANSIID
		WHERE
			A.USERLOGIN = '".$email."'
			AND A.USERPASSWORD = '".$password."'");
		return $q;		
	}

	function get_hakakses($userid)
	{
		$sp = 'DUMAS_GET_HAKAKSESUSER';
		$res = execute_sp_return($sp, array('USERID' => $userid));

		return $res;
	}

	function upd_password($params)
	{
		$sp = 'Call dumas_upd_password(?,?)';
		$res = $this->db->query($sp, $params);

		return $res;
	}
		
	function cek_login_ldap ($email,$password) {
		$db = $this->config->item('db_mdm_name');
		$q = $this->cek_login($email, $password);
		$q->ldap = false;

		if (($this->config->item('use_ldap')) && $q->num_rows() < 1) {
			$nip='';
			$ds = ldap_connect(config_item("ldap_server"));
			ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
			if($ds){
				$username=explode("@",$email);
				$uid=$username[0];
				$ldaprdn="uid=$uid,".config_item('root_dn');
				$ldapbind=@ldap_bind($ds,$ldaprdn,$password);
				if($ldapbind){
					$sr=ldap_search($ds,config_item('base_dn'),"uid=$uid");
					
					if(ldap_count_entries($ds,$sr)==1){
						$info=ldap_get_entries($ds,$sr);
						$nip=@$info[0]["employeenumber"][0]; 
						$q=$this->db->query("
						SELECT P.SATKER_ID AS SATKERID_PEGAWAI, P.PEGAWAI_ID, P.NIP_BARU USERNIP, P.NAMA USERNAMA, P.EMAIL, P.ALAMAT,
								J.JABATAN
							FROM $db.PEGAWAI P
							LEFT JOIN $db.JABATAN J ON P.JABATAN_ID = J.JABATAN_ID
						WHERE nip_baru=? or lower(email)=lower(?)
						",array($nip,$uid."@big.go.id"));

						$q->password = @$info[0]["userPassword"][0];
						$q->ldap = true;
					}
				}
			}
		}

		return $q;
	}

	function get_userbyemail($params)
	{
		$sp = "SELECT * FROM USERLOGIN WHERE USERLOGIN = ?";
		$res = $this->db->query($sp, $params);

		return $res;
	}
}