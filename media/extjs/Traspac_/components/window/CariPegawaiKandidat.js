/**
 * @class Traspac.components.window.CariPegawaiKandidat
 * @extends Ext.window.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component CariPegawaiKandidat for traspac application
 * This CariPegawaiKandidat is built by two basic components. FilterCariPegawaiKandidat and grid.Pegawai.
 * This Class is created to be component for searcing in data pegawai  
 *
 **/

Ext.define("Traspac.components.window.CariPegawaiKandidat",{
	extend		: "Traspac.components.window.Pilih",
	alias: 'widget.caripegawaikandidat',
	
	requires:['Traspac.components.form.FilterCariPegawaiKandidat','Traspac.components.grid.Pegawai'],
	title:'Cari Pegawai',
	config:{	
		nama				:	'',
		nip					:	'',
		umur1				:	'',
		umur2				:	'',
		satkerid			:	'',
		isSeluruhInstansi	:	true,
		formFilter			:	null,
		gridCari			:	null,
		tree				:	null,
		URL					:	''
	},
	initComponent	: function(a) {
		
		var me=this;
		this.addEvents({
			"onbeforepostdata"	: true,
			"batal"				: true,
			"pilih"				: true
		});
		
		this.layout='auto';
		
		this.callParent([arguments]);
		
	},
	buildFilterForm:function(){
		var me=this;
		return Ext.create('Traspac.components.form.FilterCariPegawaiKandidat', {
			width:900,
			listeners:{
				clickcari:function(){
				
					me.nip=me.formFilter.down('#nip').getValue();
					me.nama=me.formFilter.down('#nama').getValue();
					me.umur1=me.formFilter.down('#umur1').getValue();
					me.umur2=me.formFilter.down('#umur2').getValue();
					
					me.seluruh_instansi	=me.formFilter.down('#seluruh_instansi').getValue();
					me.sub_instansi		=me.formFilter.down('#sub_instansi').getValue();
					me.non_job			=me.formFilter.down('#non_job').getValue();
					me.pernah_non_job	=me.formFilter.down('#pernah_non_job').getValue();
					
					me.satkerid='';
					
					if(me.formFilter.down('#seluruh_instansi').getValue()===1){
						me.isSeluruhInstansi=true;
					}else{
						me.isSeluruhInstansi=false;
						if(me.tree){
									
							
							
						}
					}
					Traspac.log(me.isSeluruhInstansi);
					/**
					* validasi default
					* disini sebelum event click CariPegawaiKandidat dipanggil
					* kita sudah membuat definisi validasi default
					* jika semua input form kosong maka event tidak akan dipanggil
					* jika umur2 lebih dari umur1 maka juga tidak akan dipanggil
					*/
					
					if (me.nip.length==0 && me.nama.length==0 && (me.umur1==null || me.umur2==null)) {
						return;
					}
						
					if (me.umur1 > me.umur2) {					
						return;
					}
						
					me.gridCari.store.loadPage(1);
					
					
				}
			},
		});
	},
	buildGrid:function(){
		var me=this;
		return Ext.create('Traspac.components.grid.Pegawai', {
			width:900,
			height:300,
			border:true,
			URL: me.getURL(),
			autoScroll:true,
			isLoad:false,
			fields:['PEGAWAIID',
					'NIP',
					'NAMA',
					'NAMAASLI',
					'TEMPATLAHIR',
					'TANGGALLAHIR',
					'JENISKELAMIN',
					'SATKERID',
					'SATKER',
					'PERNAH_MENDUDUKI',
					'DEMOSI'],
			columns:[
				{header: 'No',width:36, dataIndex: 'RNUM',},
				{header: "NIP", dataIndex: 'NIP',	sortable: true,	width: 200},
				{header: "Nama", dataIndex: 'NAMA',	sortable: true,	width: 200},
				{header: "Nama Asli", dataIndex: 'NAMAASLI',	sortable: true,	width: 200},
				{header: "Tempat Lahir",	dataIndex: 'TEMPATLAHIR', sortable: true,width: 130},
				{header: "Tgl Lahir", dataIndex: 'TANGGALLAHIR',	sortable: true,width: 130},
				{header: "Jenis Kelamin", dataIndex: 'JENISKELAMIN', sortable: true, width: 80},
				{header: "Unit Kerja", dataIndex: 'SATKER', sortable: true, flex: 1},
			],
			listeners:{
				beforeload:function(){
					
					me.onbeforepostdata();
	
				}
			}
		});
	},
	
	buildContent:function(){
		var formFilter=this.buildFilterForm();
		
		this.setFormFilter(formFilter);
		
		var gridCari=this.buildGrid();
	
		this.setGridCari(gridCari);
		
		return [formFilter,gridCari];
	},
	
	onPilih:function(){
		var e=this.gridCari.getSelectionModel().getSelection();
		if(e.length>0){
			this.fireEvent("pilih", e[0],e);
		}else{
			Traspac.Msg.alert("Tidak ada data yang dipilih");
		}
	},

	onBatal:function(){
		this.fireEvent("batal", this);
	},
	
	onbeforepostdata:function(){
	
		this.params=this.gridCari.store.proxy.extraParams;
	
		this.params.nama	=	this.nama;
		this.params.nip	=	this.nip;
		
		
		this.params.umur1=this.umur1;
		this.params.umur2=this.umur2;
		this.params.umur2=this.umur2;
		
		this.params.a=0;
		this.params.b=0;
		this.params.c=0;
		this.params.d=0;
		
		if(this.seluruh_instansi==1){
			this.params.a=1;
		}
		
		if(this.sub_instansi==2){
			this.params.b=1;
		}
		
		if(this.non_job==3){
			this.params.c=1;
		}
		
		if(this.pernah_non_job==4){
			this.params.d=1;
		}
		
		this.params.satkerid=this.satkerid;
		
		
		this.fireEvent("onbeforepostdata", this);
		
	},
	setIsSeluruhInstansi : function(val){
		if(this.isSeluruhInstansi==true){
			if(this.formFilter){
				this.formFilter.down('#seluruh_instansi').setValue(true);
				this.isSeluruhInstansi=true;
			}
		}else {
			if(this.formFilter){
				this.formFilter.down('#unit_kerja').setValue(true);
				this.isSeluruhInstansi=false;
			}
		}
		
		
    },
	getURL:function(){
		if(!this.config.URL || this.config.URL == ''){
			return Traspac.BAPERJAKAT_URL+'/pegawai/cariPegawaiKandidat';
		}
		else{
			return this.config.URL;
		}
	},
	getFields:function(){
		return ['NAMA','JABATAN'];
	},
	getTitle:function(){
		if(!this.title){
			return 'Cari Pegawai';
		}else return this.title;
	},
	getColumns:function(){
		if(this.columns=='unknown')
			return [{
				text: 'NAMA',
				flex: 1,
				sortable: true,
				dataIndex: 'NAMA',
			},{
				text: 'JABATAN',
				flex: 1,
				sortable: true,
				dataIndex: 'JABATAN',
			}];
		else return this.columns;
	},
	
	
	updateNip:function(val,v){
		this.formFilter.down('#nip').setValue(val);
	},
	
	onShow:function(){
		
		this.callParent([arguments]);
	},
});

