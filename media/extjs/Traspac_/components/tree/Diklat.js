/**
 * @class Traspac.components.tree.Jabatan
 * @extends Ext.tree.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component Jabatan for traspac application
 * This Jabatan is created to be show strukturals data jabatan with tree component. 
 *
 **/

Ext.define("Traspac.components.tree.Diklat",{
	extend		: "Traspac.abstract.Tree",
	alias: 'widget.treediklat',
	
	fields:["id","text","keterangan"],
	
	rootVisible:false,
	
	
	initComponent	: function(a) {
		this.callParent([arguments]);
	},
	
	getIdroot:function(){
		return this.idRoot;
	},
	
	getURL:function(){
		return Traspac.Constants.MASTER_URL+'/c_diklat/getTreeDiklat';
	},
	
	getColumns:function(){
		if(this.columns=='unknown')
			return [{
				xtype: 'treecolumn', 
				text: 'Diklat',
				width: 200,
				sortable: true,
				dataIndex: 'text',
			},{
				text: 'Keterangan',
				width: 160,
				dataIndex: 'keterangan',
			}];
		else return this.columns;
	}
});