/**
 * @class Traspac.components.window.CariPegawai
 * @extends Ext.window.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component CariPegawai for traspac application
 * This CariPegawai is built by two basic components. FilterCariPegawai and grid.Pegawai.
 * This Class is created to be component for searcing in data pegawai  
 *
 **/

Ext.define("Traspac.components.window.CariPegawai",{
	extend		: "Traspac.components.window.Pilih",
	alias: 'widget.caripegawai',
	
	requires:['Traspac.components.form.FilterCariPegawai','Traspac.components.grid.Pegawai'],
	
	config:{	
		nama				:	'',
		nip					:	'',
		umur1				:	'',
		umur2				:	'',
		satkerid			:	'',
		isSeluruhInstansi	:	false,
		isHideRadioInstansiUnitkerja	: false,
		isPilihDblClick		: false,
		isOnlyOpsiUnit		:	false,
		isOnlyOpsiSeluruhUnit:	false,
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
		return Ext.create('Traspac.components.form.FilterCariPegawai', {
			width:900,
			listeners:{
				afterrender: function(){
					if(me.isHideRadioInstansiUnitkerja){
						this.down('#seluruh_instansi').hide();
						this.down('#unit_kerja').hide();
						me.isSeluruhInstansi=true;
					}
				},
				clickcari:function(){
					
					me.nip=me.formFilter.down('#nip').getValue();
					me.nama=me.formFilter.down('#nama').getValue();
					me.umur1=me.formFilter.down('#umur1').getValue();
					me.umur2=me.formFilter.down('#umur2').getValue();
					me.satkerid='';
					
					if(me.formFilter.down('#seluruh_instansi').getValue()===true){
						me.isSeluruhInstansi=true;
					}else{
						me.isSeluruhInstansi=false;
						if(me.tree){
									
							
							
						}
					}
					Traspac.log(me.isSeluruhInstansi);
					/**
					* validasi default
					* disini sebelum event click caripegawai dipanggil
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
			id:'gridcari',
			URL: me.getURL(),
			autoScroll:true,
			isLoad:false,
			columns:[
				{header: 'No',width:36, dataIndex: 'RNUM',},
				{
					header:"NIP Pegawai",
					columns:[
						{header: "NIP Lama", dataIndex: 'NIPLAMA', width: 150},
						{header: "NIP Baru", dataIndex: 'NIP', width: 150},
					]
				},
				{header: "Nama", dataIndex: 'NAMA',	sortable: true,	width: 200},
				{header: "Jabatan",	dataIndex: 'NAMAJABATAN', sortable: true,width: 200},
				{header: "Tempat Lahir", dataIndex: 'TEMPATLAHIR',	sortable: true,width: 200},
				{header: "Tgl Lahir", dataIndex: 'TANGGALLAHIR', sortable: true, width: 80}
			],
			listeners:{
				beforeload:function(){
					
					me.onbeforepostdata();
	
				},
				celldblclick: function(ths, td, cellIndex, record, tr, rowIndex, e, eOpts){
					console.log(me.isPilihDblClick);
					if(me.isPilihDblClick==true){
						var a=me.onPilih();
						if(a!==false) me.destroy();
					}
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
			this.fireEvent("pilih", e[0]);
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
	setIsOnlyOpsiUnit:function(val){
		if(this.isOnlyOpsiUnit==true){
			if(this.formFilter){
				this.formFilter.down('#seluruh_instansi').setDisabled(true);
				this.isOnlyOpsiUnit=true;
			}
		}else {
			if(this.formFilter){
				this.formFilter.down('#seluruh_instansi').setDisabled(false);
				this.isOnlyOpsiUnit=false;
			}
		}
		
		
    },
	setIsOnlyOpsiSeluruhUnit:function(val){
		if(this.isOnlyOpsiSeluruhUnit==true){
			if(this.formFilter){
				this.formFilter.down('#unit_kerja').setDisabled(true);
				this.isOnlyOpsiSeluruhUnit=true;
			}
		}else {
			if(this.formFilter){
				this.formFilter.down('#unit_kerja').setDisabled(false);
				this.isOnlyOpsiSeluruhUnit=false;
			}
		}
		
		
    },
	getURL:function(){
		if(!this.config.URL || this.config.URL == ''){
			return Traspac.Constants.SIAP_URL+'/pegawai/cariPegawai';
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
		if(this.formFilter.down('#nip'))
			this.formFilter.down('#nip').setValue(val);
	},
	
	onShow:function(){
		this.setIsSeluruhInstansi(this.isSeluruhInstansi);
		this.setIsOnlyOpsiSeluruhUnit(this.isOnlyOpsiSeluruhUnit);
		this.setIsOnlyOpsiUnit(this.isOnlyOpsiUnit);
		this.callParent([arguments]);
	},
});

