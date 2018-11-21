/**
 * @class Traspac.components.tree.Jurusan
 * @extends Ext.tree.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 30 Sep 2014 19:13:29
 *
 * @Description
 * Building component Jurusan for traspac application
 * This Jurusan is created to be show jurusan data with tree component. 
 *
 **/

Ext.define("Traspac.components.tree.Jurusan",{
	extend		: "Traspac.abstract.Tree",
	alias: 'widget.treejurusan',
	
	fields:["id","text","KETERANGAN"],
	
	rootVisible	:	false,
	
	PENDIDIKANID:'',
	
	initComponent	: function(a) {
		this.callParent([arguments]);
	},
	
	getIdroot:function(){
		return this.idRoot;
	},
	
	getURL:function(){
		return Traspac.Constants.MASTER_URL+'/c_pendidikan/getListJurusan';
	},
	
	getColumns:function(){
		if(this.columns=='unknown')
			return [{
				xtype: 'treecolumn', 
				text: 'Jurusan',
				width: 200,
				sortable: true,
				dataIndex: 'text',
			},{
				text: 'Keterangan',
				width: 160,
				dataIndex: 'KETERANGAN',
			}];
		else return this.columns;
	},
	
	onBeforeLoaded :function(a){
		a.proxy.extraParams.pendidikan_id=this.PENDIDIKANID
	}
});