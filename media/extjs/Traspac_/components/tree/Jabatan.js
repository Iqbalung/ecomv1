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

Ext.define("Traspac.components.tree.Jabatan",{
	extend		: "Traspac.abstract.Tree",
	alias: 'widget.treejabatan',

	fields:['id','text','eselonid','eselon','namajabatan','unitkerja','UK_ID','focus_node','kepala','nip','PANGKAT','KODEPANGKAT','PEGAWAIID'],
	
	URL:Traspac.Constants.MASTER_URL+'/c_unit_kerja/get_tree_satker',
	idroot:'0',
	
	initComponent	: function(a) {
		this.callParent([arguments]);
	},

	getColumns:function(){
		if(this.columns=='unknown')
			return [{
				xtype: 'treecolumn', 
				text: 'Jabatan Struktural',
				flex: 1,
				sortable: true,
				dataIndex: 'text',
			}];
		else return this.columns;
	},
	
	onBeforeLoaded:function(s){
		s.proxy.extraParams.HISTORY_ID=this.HISTORY_ID;
		s.proxy.extraParams.modulname=Traspac.module_name;
		s.proxy.extraParams.mode=1;
	}
});