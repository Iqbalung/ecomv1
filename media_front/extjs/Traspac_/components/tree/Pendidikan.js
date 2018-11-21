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

Ext.define("Traspac.components.tree.Pendidikan",{
	extend		: "Traspac.abstract.Tree",
	alias: 'widget.treependidikan',
	
	fields:["id","text","PENDIDIKAN","TINGKATPENDIDIKAN","TINGKATPENDIDIKANID","PANGKATMIN","PANGKATMAX",'KETERANGAN'],
	
	rootVisible:false,
	initComponent	: function(a) {
		this.callParent([arguments]);
	},
	getIdroot:function(){
		return '0';
	},
	getURL:function(){
		return Traspac.Constants.SIAP_URL+'/treependidikan/getDataPendidikan';
	},
	
	getColumns:function(){
		if(this.columns=='unknown')
			return [{
				xtype: 'treecolumn', 
				text: 'Pendidikan',
				width: 200,
				sortable: true,
				dataIndex: 'text',
			},{
				text: 'Pk. Min',
				width: 160,
				dataIndex: 'PANGKATMIN',
			},{
				text: 'Pk. Maks',
				width: 160,
				dataIndex: 'PANGKATMAX'
			},{
				text: 'Keterangan',
				width: 100,
				dataIndex: 'KETERANGAN'
			}];
		else return this.columns;
	}
});