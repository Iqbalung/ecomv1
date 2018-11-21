/**
 * @class Traspac.components.window.CariPegawaiPromosi
 * @extends Ext.window.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component CariPegawaiPromosi for traspac application
 * This CariPegawaiPromosi is built by two basic components. FilterCariPegawaiPromosi and grid.Pegawai.
 * This Class is created to be component for searcing in data pegawai  
 *
 **/

Ext.define("Traspac.components.window.CariPegawaiPromosi",{
	extend		: "Traspac.components.window.Pilih",
	alias		: 'widget.CariPegawaiPromosi',
	
	requires:['Traspac.components.form.FilterCariPegawaiPromosi','Traspac.components.grid.Pegawai'],
	title:'Cari Pegawai Promosi',
	config:{
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
		return Ext.create('Traspac.components.form.FilterCariPegawaiPromosi', {
			width:950,
			listeners:{
				clickcari:function(){
				
					me.organisasi		=	me.formFilter.down('#organisasi').getValue();
					me.jenispromosi		=	me.formFilter.down('#jenispromosi').getValue();
					me.satkerid='';
					
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
			/*bbar:{
				xtype  	: 	'container',
				html 	: 	'<div class="legend">'+
							'<span class="blue-ap item ">Sedang Menduduki</span>'+
							'<span class="green-ap item ">Pernah Menduduki</span></div>'
			},*/
			border:true,
			id:'gridcari',
			URL: me.getURL(),
			autoScroll:true,
			isLoad:false,
			selModel:Ext.create('Ext.selection.CheckboxModel',{
				enableKeyNav:false, 
				allowDeselect:true
			}),
			/*viewConfig: {
				getRowClass: function(record, rowIndex, rowParams, store) {
					if (record.get('PERNAH_MENDUDUKI')==1 )
						return 'pernah_menduduki';
					else if (record.get('SEDANG_MENDUDUKI')==1)
						return 'sedang_menduduki';
				}
			},*/
			
			fields : ['SATKERID','PEGAWAIID','PERNAH_MENDUDUKI','DEMOSI','SATKER','NIP','GOL','NAMA','NAMAJABATAN','TIPEJABATAN','USIA','MASAJABATAN','MASAKERJA','JENISPROMOSI','RN'],
			columns:[
			{xtype: 'rownumberer',text: 'No',width:30},
			{
				header : 'NIP Pegawai',
				dataIndex:'NIP',
				flex:1,
			},{
				header : 'Nama Pegawai',
				dataIndex:'NAMA',
				flex:1,
			},{
				header : 'Gol',
				dataIndex:'GOL',
				flex:1,
			},{
				header : 'Jabatan',
				dataIndex:'NAMAJABATAN',
				flex:1,
			},{
				header : 'Unit Kerja',
				dataIndex:'SATKER',
				flex:1,
			},{
				header : 'Tipe Jab',
				dataIndex:'TIPEJABATAN',
				flex:1,
			},{
				header : 'Usia',
				dataIndex:'USIA',
				flex:1,
			},{
				header : 'Masa Jabatan',
				dataIndex:'MASAJABATAN',
				flex:1,
			},{
				header : 'Masa Kerja',
				dataIndex:'MASAKERJA',
				flex:1,
			},{
				header : 'Jenis Promosi',
				dataIndex:'JENISPROMOSI',
				flex:1,
			}],
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
		this.params.jenispromosi		=	this.formFilter.down('#jenispromosi').getValue();
	
		var a=0,b=0,c=0,d=0;
		if(this.organisasi.indexOf('1')!=-1)a=1;
		if(this.organisasi.indexOf('2')!=-1)b=1;
		if(this.organisasi.indexOf('3')!=-1)c=1;
		if(this.organisasi.indexOf('4')!=-1)d=1;
		
		if(a==0&&b==0)
			a=1;
		
		this.params.a	=	a;
		this.params.b	=	b;
		this.params.c	=	c;
		this.params.d	=	d;

		this.fireEvent("onbeforepostdata", this);
		
	},

	getURL:function(){
		if(!this.config.URL || this.config.URL == ''){
			return Traspac.BAPERJAKAT_URL+'/anjab/getkandidatpromosi';
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

