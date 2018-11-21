/**
 * @class Traspac.components.window.Unsur
 * @extends Ext.window.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 18 Sep 2015 19:13:29
 *
 * @Description
 * Building component Unsur for traspac application
 * This Unsur is built by two basic components. FilterUnsur and grid.Pegawai.
 * This Class is created to be component for searcing in data pegawai  
 *
 **/

Ext.define("Traspac.components.window.Unsur",{
	extend		: "Traspac.components.window.Pilih",
	alias		: "widget.windowUnsur",
	
	requires:['Traspac.components.tree.Unsur'],

	
	title:'Daftar Unsur',
	
	root:'0',
	
	initComponent	: function(a) {
		
		var me=this;
		this.addEvents({
			"pilih"				: true,
			"itemclick"			: true,
			"batal"				: true
		});

		
		this.callParent([arguments]);
		
	},
	
	buildContent:function(){
		var me=this;
		tree = Ext.create('Traspac.components.tree.Unsur', {
			idroot: me.root,
			itemId: 'tree_unsur',
			url: me.url,
			width:500,
			height:500,
			itemclick:function(a,b,c){
				me.fireEvent('itemclick',a,b,c);
			}
		});
		tree.getStore().on({
			beforeload: function(){
				node = me.root;
				id = node.split('.') || 0;
				tree.getStore().getProxy().extraParams.tingkat = id[0];
			}
		});
		return tree;
	},
	
	onPilih:function(){
		var me=this;
		var e=me.content.getSelectionModel().getSelection();
		if(e.length>0){
			if(e[0].get('ANGKA_KREDIT')!=0){
				me.fireEvent("pilih", e[0]);
				me.hide();
			} else {
				Traspac.Msg.alert("Tidak dapat memilih unsur ini");
				me.show();
			}
		}else{
			Traspac.Msg.alert("Tidak ada data yang dipilih");
		}
	},
	
	onBatal:function(){
		var me = this;
		me.fireEvent("batal", me);
	}

});

