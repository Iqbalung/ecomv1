/**
 * @class Traspac.components.window.CariPegawaiKriteria
 * @extends Ext.window.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component CariPegawaiKriteria for traspac application
 * This CariPegawaiKriteria is built by two basic components. FilterCariPegawaiKriteria and grid.Pegawai.
 * This Class is created to be component for searcing in data pegawai  
 *
 **/

Ext.define("Traspac.components.window.CariPegawaiKriteria",{
	extend		: "Traspac.components.window.Pilih",
	alias		: 'widget.caripegawaikriteria',
	
	requires:['Traspac.components.form.FilterCariPegawaiKriteria','Traspac.components.grid.Pegawai'],
	title:'Cari Pegawai Kriteria',
	config:{	
		nama				:	'',
		nip					:	'',
		umur1				:	'',
		umur2				:	'',
		satkerid			:	'',
		isSeluruhInstansi	:	false,
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
		return Ext.create('Traspac.components.form.FilterCariPegawaiKriteria', {
			width:950,
			listeners:{
				clickcari:function(){
				
					me.organisasi		=	me.formFilter.down('#organisasi').getValue();
					//me.opeselon			=	me.formFilter.down('#opeselon').getValue();
					me.eselon			=	me.formFilter.down('#eselon').getValue();
					me.jabatan			=	me.formFilter.down('#jabatan').getValue();
					me.golongan			=	me.formFilter.down('#golongan').getValue();
					me.pendidikan		=	me.formFilter.down('#pendidikan').getValue();
					me.jurusan			=	me.formFilter.down('#jurusan').getValue();
					me.diklatpimpinan	=	me.formFilter.down('#diklatpimpinan').getValue();
					
					if(me.organisasi.indexOf('1')!=-1){
						me.isSeluruhInstansi=true;
					}else{
						me.isSeluruhInstansi=false;
						if(me.tree){
									
							
							
						}
					}

					
					me.gridCari.store.loadPage(1);
					
					
				}
			},
		});
	},
	buildGrid:function(){
		var me=this;
		return Ext.create('Traspac.components.grid.Pegawai', {
			width:950,
			height:300,
			bbar:{
				xtype  	: 	'container',
				html 	: 	'<div class="legend">'+
							'<span class="blue-ap item ">Sedang Menduduki</span>'+
							'<span class="green-ap item ">Pernah Menduduki</span></div>'
			},
			border:true,
			id:'gridcari',
			URL: me.getURL(),
			autoScroll:true,
			isLoad:false,
			selModel:Ext.create('Ext.selection.CheckboxModel',{
				enableKeyNav:false, 
				allowDeselect:true
			}),
			viewConfig: {
				getRowClass: function(record, rowIndex, rowParams, store) {
					if (record.get('PERNAH_MENDUDUKI')==1 )
						return 'pernah_menduduki';
					else if (record.get('SEDANG_MENDUDUKI')==1)
						return 'sedang_menduduki';
				}
			},
			fields:['PEGAWAIID', 'NIP', 'NAMA', 'FOTO','PERNAH_MENDUDUKI','DEMOSI','SEDANG_MENDUDUKI',
				'USIA', 'GOLONGAN', 'JABATAN','DIKLAT','PENDIDIKAN','SATKERID', 'ESELON', 'HUKUMAN', 'PRESTASIKERJA','jurusan','pendidikanid'],
			columns:[
			{header: 'No',width:36, dataIndex: 'RNUM'},
			{
				header : 'Nama',
				dataIndex : 'NAMA',
				width : 150
			}, {
				header : "Usia",
				dataIndex : 'USIA',
				width : 140
			}, {
				header : "Gol / Ruang",
				dataIndex : 'GOLONGAN',
				width : 70
			}, {
				header : "Jabatan",
				dataIndex : 'JABATAN',
				width : 150
			}, {
				header : "Diklat",
				dataIndex : 'DIKLAT',
				align : 'center',
				width : 100
			}, {
				header : "Pendidikan",
				dataIndex : 'PENDIDIKAN',
				width : 150
			}, {
				header : "Prestasi Kerja",
				dataIndex : 'PRESTASIKERJA',
				width : 150
			}, {
				header : "Hukuman",
				dataIndex : 'HUKUMAN',
				width : 200
			},{
				header: 'ID PEGAWAI',
				dataIndex: 'PEGAWAIID',
				hidden: true,
				hideable: false
			},{
				header: 'SATKER ID',
				dataIndex: 'SATKERID',
				hidden: true,
				hideable: false
			}
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
	
		this.organisasi			=	this.formFilter.down('#organisasi').getValue();
		this.eselon				=	this.formFilter.down('#eselon').getValue();
		this.jabatan			=	this.formFilter.down('#jabatan').getValue();
		this.golongan			=	this.formFilter.down('#golongan').getValue();
		this.pendidikan			=	this.formFilter.down('#pendidikan').getValue();
		this.jurusan			=	this.formFilter.down('#jurusan').getValue();
		this.diklatpimpinan		=	this.formFilter.down('#diklatpimpinan').getValue();
		
		this.params.SatkerID		=	this.satkerid;
		this.params.DiklatId		=	this.formFilter.down('#diklatpimpinan').getValue();
		this.params.Eselon			=	this.formFilter.down('#eselon').getValue();
		this.params.JabatanNama		=	this.formFilter.down('#jabatan').getValue();
		this.params.JenisJabatan	=	this.formFilter.down('#jenisjabatan').getValue();
		this.params.PendidikanId	=	this.formFilter.down('#pendidikan').getValue();
		this.params.NamaJurusan		=	this.formFilter.down('#jurusan').getRawValue();
		this.params.gol				=	this.formFilter.down('#golongan').getValue();
		this.params.isPLT			=	0;
		
		var a=0,b=0,c=0,d=0;
		if(this.organisasi.indexOf('1')!=-1)a=1;
		if(this.organisasi.indexOf('2')!=-1)b=1;
		if(this.organisasi.indexOf('3')!=-1)c=1;
		if(this.organisasi.indexOf('4')!=-1)d=1;
		if(a==0 && b==0) {a=1;}
		
		this.params.a	=	a;
		this.params.b	=	b;
		this.params.c	=	c;
		this.params.d	=	d;

		this.fireEvent("onbeforepostdata", this);
		
	},

	getURL:function(){
		if(!this.config.URL || this.config.URL == ''){
			return Traspac.BAPERJAKAT_URL+'/anjab/getKriteria';
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

	
	onShow:function(){
		this.callParent([arguments]);
	},
});

