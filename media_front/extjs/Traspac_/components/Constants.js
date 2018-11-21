/**
 * @class Traspac.components.Constants
 * @extends Object
 * requires 
 * @autor Rizky Atmawijaya
 * @date 2014 Sep 1
 *
 * Description
 *
 *
 **/

Ext.define("Traspac.components.Constants",{
	alternateClassName	: "Traspac.Constants" ,
	singleton	: true,
	
	APPLICATION_NAME: 'SISTEM INFORMASI MANAJEMEN JABATAN',
	/* config url */
	LOGIN_URL			: Traspac.LOGIN_URL,
	SIAP_URL			: Traspac.SIAP_URL,
	MASTER_URL			: Traspac.MASTER_URL,
	SITE_URL			: Traspac.SITE_URL,
	BASE_URL			: Traspac.BASE_URL,
	NAMA_CLIENT			: Traspac.NAMA_CLIENT,
	
	/* DEFAULT PROPERTY COMPONENT */
	
	DEFAULT_LIMIT_PAGE    : 20,
	DEFAULT_WINDOW_WIDTH  : 500,
	DEFAULT_WINDOW_HEIGHT : 400,
	
	DEFAULT_DATE_FORMAT   : 'd/m/Y',
	
	/* DEFAULT PROPERTY KLASIFIKASI JENIS PEGAWAI */
	
	ISPENSIUN	:'3',
	ISAKTIF		:'1,2,3,4,5,6,6,7,7',

});