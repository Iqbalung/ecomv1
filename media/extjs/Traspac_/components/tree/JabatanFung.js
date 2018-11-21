/**
 * @class Traspac.components.tree.JabatanFung
 * @extends Ext.tree.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 18 Sep 2014 19:13:29
 *
 * @Description
 * Building component JabatanFung for traspac application
 * This JabatanFung is created to be show strukturals data JabatanFung with tree component. 
 *
 **/

Ext.define("Traspac.components.tree.JabatanFung",{
	extend		: "Traspac.abstract.Tree",
	alias: 'widget.treejabatanfung',
	
	fields:['id','text','kepala','nip','FN_ID'],
	
	URL:Traspac.Constants.MASTER_URL+'/c_jabatan/getDataSatker',
	idroot:'0',
	
	initComponent	: function(a) {
		this.callParent([arguments]);
	},
	
	getColumns:function(){
		if(this.columns=='unknown')
			return [{
				xtype: 'treecolumn', 
				text: 'JabatanFung Fungsional',
				flex: 1,
				sortable: true,
				dataIndex: 'text',
			}];
		else return this.columns;
	},
	
	onBeforeLoaded:function(s){
		s.proxy.extraParams.HISTORY_ID=this.HISTORY_ID;
	}
});