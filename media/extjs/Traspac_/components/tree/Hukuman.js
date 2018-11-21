/**
 * @class Traspac.components.tree.Hukuman
 * @extends Ext.tree.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 9 Sep 2015 9:34:00
 *
 * @Description
 * Building component Hukuman for traspac application
 * This Hukuman is created to be show hukuman data with tree component. 
 *
 **/
 

Ext.define("Traspac.components.tree.Hukuman",{
	extend			: "Traspac.abstract.Tree",
	alias			: 'widget.treehukuman',
	
	title			: 'Master Hukuman',
	
	fields			: ['id','text','jenis','jumlah','keterangan'],
	initComponent	: function() {
		var me=this;
		this.callParent([arguments]);
	},
	getIdroot:function(){
		return '0';
	},
	getURL:function(){
		if (this.URL=='unknown' || !this.URL)
			return Traspac.MASTER_URL+'/c_hukuman/getTreeRiwHukuman';
		else{
			return this.URL;
		}
	},
	getColumns:function(){
		if(this.columns=='unknown')
			return [{
				xtype: 'treecolumn', 
				text: 'Nama Hukuman',
				width:210,
				sortable: true,
				dataIndex: 'text',
			},{
				header: 'Jenis',
				width: 100,
				dataIndex:'jenis'
			},{
				header: 'Jumlah',
				width: 80,
				dataIndex:'jumlah'
			},{
				header: 'Keterangan',
				width: 150,
				dataIndex:'keterangan'
			}];
		else return this.columns;
	}
	
});