/**
 * @class Traspac.components.tree.Hukuman
 * @extends Ext.tree.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component Hukuman for traspac application
 * This Hukuman is created to be show Hukumans data jabatan with tree component. 
 * @example
 * 		var window=Ext.create('Traspac.components.window.Hukuman', {
 *			isUnitKerja		:true,
 *			listeners		:{
 *				itemclick:function(a,record,c){
 *					console.log(record.get('text'));
 *					console.log(record.get('id'));
 *				}
 *			}	
 *		}).show();
 **/

Ext.define("Traspac.components.window.Hukuman",{
	extend		: "Traspac.components.window.Pilih",
	alias		: 'widget.windowhukuman',
	
	requires:['Traspac.components.tree.Hukuman'],
	
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
		tree=Ext.create('Traspac.components.tree.Hukuman',{
			width:540,
			height:400,
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