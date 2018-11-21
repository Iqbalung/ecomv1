/**
 * @class Traspac.components.window.CariPendidikan
 * @extends Ext.window.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component CariPendidikan for traspac application
 * This CariPendidikan is built by two basic components. FilterCariPendidikan and grid.Pegawai.
 * This Class is created to be component for searcing in data pegawai  
 *
 **/

Ext.define("Traspac.components.window.CariPendidikan",{
	extend		: "Traspac.components.window.Pilih",
	alias: 'widget.caripendidikan',
	
	requires:['Traspac.components.field.SearchField','Traspac.components.tree.Pendidikan'],
	
	config:{
	
		keyPendidikan		:	'',
		grid				:	'',
		tree				:	'',
		
	},
	
	title:'Kamus Pendidikan',
	
	initComponent	: function(a) {
		
		var me=this;
		this.addEvents({
			"onbeforepostdata"	: true,
			"pilih"				: true,
			"itemclick"			: true,
			"batal"				: true
		});
		

		this.callParent([arguments]);
		
	},
	
	onbeforepostdata:function(){
	
		var params=this.grid.store.proxy.extraParams;
	
		params.srcKey	=	this.keyPendidikan;
		
		this.fireEvent("onbeforepostdata", this);
		
	},

	updateKeyPendidikan:function(val,v){
		this.grid.down('#keyPendidikan').setValue(val);
	},

	buildContent:function(){
		var me=this;
		this.grid= Ext.create('Traspac.abstract.Grid', {
			tbar:[
				{
					xtype:'searchfield',
					itemId:'keyPendidikan',
					width:300,
					listeners:{
						search:function(val,a){
							me.keyPendidikan=val;
							me.grid.getStore().load();
						}
					}
				}
			],
			title:'Cari Pendidikan',
			name:'grid',
			isLoad:true,
			URL:Traspac.Constants.SIAP_URL+'/treependidikan/getSrcPendidikan',
			fields:['PENDIDIKANID','PENDIDIKAN','TINGKATPENDIDIKANID','TINGKATPENDIDIKAN','JURUSAN'],
			columns:[
				{header: "Pendidikan ID", dataIndex: 'PENDIDIKANID',	hidden:true, sortable: true},
				{header: "Pendidikan", dataIndex: 'PENDIDIKAN', sortable: true, flex: 1},
				{header: "Jurusan", dataIndex: 'JURUSAN',	sortable: true, flex: 1}
			],
			listeners:{
				beforeload:function(){
					me.onbeforepostdata();
				},
				itemclick:function(a,b,c){
					me.fireEvent('itemclick',a,b,c,'grid');
				}
			}
		});
		
		this.tree= Ext.create('Traspac.components.tree.Pendidikan', {
			title:'Master Pendidikan',
			name:'tree',
			listeners:{
				itemclick:function(a,b,c){
					me.fireEvent('itemclick',a,b,c,'tree');
				}
			}
		});
		
		return Ext.create('Ext.tab.Panel', {
			width:400,
			height:500,
			layout:'fit',
			items:[this.tree,this.grid]
		});
	},
	
	onPilih:function(){
		var me=this;
		var content		=	me.content.getActiveTab(),
			name	=	content.name,
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

