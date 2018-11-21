/**
 * @class Traspac.components.tree.Struktural
 * @extends Ext.tree.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component Struktural for traspac application
 * This Struktural is created to be show strukturals data jabatan with tree component. 
 * @example
 * 		var window=Ext.create('Traspac.components.window.Struktural', {
 *			isUnitKerja		:true,
 *			listeners		:{
 *				itemclick:function(a,record,c){
 *					console.log(record.get('text'));
 *					console.log(record.get('id'));
 *				}
 *			}	
 *		}).show();
 **/

Ext.define("Traspac.components.window.Struktural",{
	extend		: "Traspac.components.window.Pilih",
	alias: 'widget.windowstruktural',
	
	requires:['Traspac.components.tree.UnitKerja','Traspac.components.tree.Jabatan'],
	
	config:{
		isUnitKerja			:	true,
		tree				:	null
	},
	URL:'',
	HISTORY_ID:'',
	
	initComponent	: function(a) {
		var me=this;
		
		this.addEvents({
			"itemclick"	: true,
			'celldblclick': true,
			"batal"		: true,
			"pilih"		: true,
		});
		
		
		this.callParent([arguments]);
	
	
	},
	
	buildContent:function(){
		var me=this,tree=null;
		if(this.isUnitKerja==true){
			if(me.URL=='')
				me.URL=Traspac.Constants.MASTER_URL+'/c_unit_kerja/get_tree_satker';
		
			tree=Ext.create('Traspac.components.tree.UnitKerja', {
				width	:400,
				height	:500,
				URL		:me.URL,
				HISTORY_ID:me.HISTORY_ID,
				listeners:{
					itemclick:function(a,b,c){
						me.fireEvent("itemclick", a,b,c);
					},
					celldblclick: function(tree, td, cellIndex, record, tr, rowIndex, e, eOpts){
						me.fireEvent('celldblclick', tree, record, td, rowIndex);
						me.destroy();
					}
				}
			});
		}else{
			if(me.URL=='')
				me.URL=Traspac.Constants.MASTER_URL+'/c_unit_kerja/get_tree_satker',
				
			tree=Ext.create('Traspac.components.tree.Jabatan',{
				width:400,
				height:500,
				URL:me.URL,
				HISTORY_ID:me.HISTORY_ID,
				listeners:{
					itemclick:function(a,b,c){
						me.fireEvent("itemclick", a,b,c);
					},
					celldblclick: function(tree, td, cellIndex, record, tr, rowIndex, e, eOpts){
						me.fireEvent('celldblclick', tree, record, td, rowIndex);
						me.destroy();
					}					
				}
			});
		}
	
		return tree;
	},
	onPilih:function(){
		var me=this;
		var e=me.content.getSelectionModel().getSelection();
		if(e.length>0){
			me.fireEvent("pilih", e[0],e);
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