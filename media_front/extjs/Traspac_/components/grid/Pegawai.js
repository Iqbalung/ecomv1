/**
 * @class Traspac.components.grid.Pegawai
 * @extends Ext.grid.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component Pegawai for traspac application
 * This Pegawai is created to be show data pegawai. 
 *
 **/

Ext.define("Traspac.components.grid.Pegawai",{
	extend		: "Traspac.abstract.Grid",
	alias: 'widget.gridpegawai',
	
	requires:['Traspac.abstract.Grid'],
	
	
	initComponent	: function(a) {
		this.callParent(arguments);
	},
	getTotalProperty:function(){
		if(this.totalProperty=='unknown')
			return 'results';
		else return this.totalProperty;
	},
	getRoot:function(){
		if(this.root=='unknown')
			return 'rows';
		else return this.root;
	},
	getURL:function(){
		if(this.URL=='unknown')
			return Traspac.Constants.SIAP_URL+'/pegawai/getPegawaiBySatker';
		else return this.URL;
	},
	getFields:function(){
		if(this.fields=='unknown')
			return this.getDefaultFields();
		else return this.fields;
	},
	getColumns:function(){
		if(this.columns=='unknown'){
			return this.getDefaultColumns();
		}else return this.columns;
	},
	getIsLoad:function(){
		if(this.isLoad=='unknown'){
			return false;
		}else return this.isLoad;
	},
	
	getDefaultColumns:function(){
		return [
			{xtype: 'rownumberer',text: 'No',width:45},
			{header: 'ID PEGAWAI', dataIndex: 'PEGAWAIID', hidden: true, hideable: false,locked: true}, 
			{header: 'satkerid', dataIndex: 'SATKERID', hidden: true, hideable: false,locked: true}, 
			{
				header:"NIP Pegawai",
				locked: true,
				columns:[
					{header: "NIP Lama", dataIndex: 'NIPLAMA', width: 150},
					{header: "NIP Baru", dataIndex: 'NIP', width: 150},
				]
			},
			{header: "Nama", dataIndex: 'NAMA',	sortable: true,	width: 200,locked: true},
			{header: "Jabatan",	dataIndex: 'NAMAJABATAN', sortable: true, width: 200},
			{
				header:"Unit Kerja",
				dataIndex: 'SATKER',
				width:500,
			},	
			{header: "Tempat Lahir", dataIndex: 'TEMPATLAHIR',	sortable: true,	width: 100},
			{header: "Tgl Lahir", dataIndex: 'TANGGALLAHIR', sortable: true, width: 80},
			{header: "Tgl Wafat", dataIndex: 'TANGGALMATI',	sortable: true, width: 80, hidden : true},
			{header: "L/P",	dataIndex: 'JENISKELAMIN',	align: 'center', sortable: true, width: 30},
			{header: "Status",	dataIndex: 'STATUSPEGAWAI',	align: 'center', sortable: true, width: 80},
			{header: "Gol. Ruang",	dataIndex: 'KODEPANGKAT', align: 'center', sortable: true, width: 80},
			{header: "Pangkat",	dataIndex: 'PANGKAT', align: 'left', sortable: true, width: 100},
			{header: "TMT Pangkat",	dataIndex: 'TMTPANGKAT', sortable: true, width: 80},
			{header: "Eselon", dataIndex: 'ESELON',	align: 'center', sortable: true, width: 50},
			{header: "Agama", dataIndex: 'AGAMA', sortable: true, width: 90},
			{header: "Telepon",	dataIndex: 'TELEPON', sortable: true, width: 100},
			{header: "Alamat", dataIndex: 'ALAMAT',	sortable: true, width: 300}
		];
	},
	fields:[
		'RNUM','PEGAWAIID', 'NIP','NIPLAMA',  'NAMA', 'TEMPATLAHIR', 'TANGGALLAHIR','TANGGALMATI', 'JENISKELAMIN', 'STATUSPEGAWAI', 
		'KODEPANGKAT', 'ISPEJABAT','TMTPANGKAT', 'ESELON', 'NAMAJABATAN', 'SATKER', 'TELEPON', 'ALAMAT', 'AGAMA', 'ESSELON2',
		'ESSELON3', 'ESSELON4','PANGKAT','TIPEPEGAWAI','SATKERID','JABATANID'
	]
});