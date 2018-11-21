/**
 * @class Traspac.components.window.CariKamusJabatan
 * @extends Ext.window.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component CariKamusJabatan for traspac application
 * This CariKamusJabatan is built by two basic components. FilterCariKamusJabatan and grid.Pegawai.
 * This Class is created to be component for searcing in data pegawai  
 *
 **/

Ext.define("Traspac.components.window.KamusJabatan",{
	extend		: "Traspac.components.window.Pilih",
	alias		: 'widget.kamusjabatan',
	
	requires:['Traspac.components.field.SearchField','Traspac.components.tree.JabatanFung','Traspac.components.tree.Jabatan'],
	
	config:{
		keyKamusJabatan		:	'',
		grid				:	'',
		tree_struktural		:	'',
		tree_fungsional		:	'',
		onlyFungsional		:   false,
	},
	
	title:'Kamus Jabatan',
	
	HISTORY_ID_JF:'',
	HISTORY_ID_JS:'',
	URL_FUNGSIONAL	:	Traspac.MASTER_URL+'/c_jabatan/getDataSatker',
	URL_STRUKTURAL	:	Traspac.MASTER_URL+'/c_unit_kerja/get_tree_satker',
	URL_GRID	  	:	Traspac.SIAP_URL+'/tree/get_jabatan',
	
	initComponent	: function(a) {
		
		var me=this;
		this.addEvents({
			"onbeforepostdata"	: true,
			"itemclick"				: true,
			"pilih"				: true,
			"batal"				: true
		});
		
		this.callParent([arguments]);
		
	},
	
	onbeforepostdata:function(){
	
		var params=this.grid.store.proxy.extraParams;
	
		params.nama	=	this.keyKamusJabatan;
		
		this.fireEvent("onbeforepostdata", this);
		
	},
	
	updateKeyKamusJabatan:function(val,v){
		this.grid.down('#keyKamusJabatan').setValue(val);
	},
	
	buildContent:function(){
		var me=this;
		this.grid= Ext.create('Traspac.abstract.Grid', {
			tbar:[
				{
					xtype:'searchfield',
					itemId:'keyKamusJabatan',
					width:300,
					listeners:{
						search:function(val,a){
							me.keyKamusJabatan=val;
							me.grid.getStore().load();
						}
					}
				}
			],
			title:'Cari Kamus Jabatan',
			name:'grid',
			isLoad:true,
			URL:me.URL_GRID,
			fields:["UK_ID","FUNGSIONALID","NAMA","KETERANGAN"],
			columns:[
				{dataIndex: 'FUNGSIONALID',	hidden:true, sortable: true},
				{header: "Jabatan", dataIndex: 'NAMA', sortable: true, flex: 1},
				{header: "Keterangan", dataIndex: 'KETERANGAN',	sortable: true, flex: 1}
			],
			listeners:{
				beforeload:function(){
					this.store.proxy.extraParams.HISTORY_ID=me.HISTORY_ID_JF;
					me.onbeforepostdata();

				},
				itemclick:function(a,b,c){
					me.fireEvent('itemclick',a,b,c,'grid');
				}
			}
		});
		
		this.tree_fungsional=Ext.create('Traspac.components.tree.JabatanFung', {
			title:'Master Jabatan Fungsional',
			URL:me.URL_FUNGSIONAL,
			HISTORY_ID:me.HISTORY_ID_JF,
			name:'tree_fungsional',
			listeners:{
				itemclick:function(a,b,c){
					me.fireEvent('itemclick',a,b,c,'tree_fungsional');
				}
			}
		});
		
		this.tree_struktural=Ext.create('Traspac.components.tree.Jabatan', {
			title:'Master Jabatan Stuktural',
			URL:me.URL_STRUKTURAL,
			HISTORY_ID:me.HISTORY_ID_JS,
			hidden:me.onlyFungsional,
			name:'tree_struktural',
			listeners:{
				itemclick:function(a,b,c){
					me.fireEvent('itemclick',a,b,c,'tree_struktural');
				}
			}
		});
		
		var arrayI=[this.tree_struktural,this.tree_fungsional,this.grid];
		if(me.onlyFungsional==true){
			arrayI=[this.tree_fungsional,this.grid];
		}
		return Ext.create('Ext.tab.Panel', {
			width:500,
			height:500,
			layout:'fit',
			items:arrayI
		});
	},
	
	onPilih:function(){
		var me=this;
		var content		=	me.content.getActiveTab(),
			name		=	content.name,
			e=content.getSelectionModel().getSelection();
		
		if(e.length>0){
			me.fireEvent("pilih", e[0],name);
			me.hide();
		}else{
			Traspac.Msg.alert("Tidak ada data yang dipilih");
		}
	},
	
	onBatal:function(){
		var me=this;
		me.fireEvent("batal", me);
	}
});

