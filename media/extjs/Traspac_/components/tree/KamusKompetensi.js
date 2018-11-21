

/**
 * @class Traspac.components.tree.KamusKompetensi
 * @extends Ext.tree.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component KamusKompetensi for traspac application
 * This KamusKompetensi is created to be show strukturals data KamusKompetensi with tree component. 
 *
 **/

Ext.define("Traspac.components.tree.KamusKompetensi",{
	extend		: "Traspac.abstract.Tree",
	alias: 'widget.treekamuskompetensi',
	
	fields:["id","text","TINGKAT_MAX",'LVL','TIPE'],
	
	rootVisible:false,
	initComponent	: function(a) {
		this.callParent([arguments]);
	},
	getIdroot:function(){
		return '0';
	},
	getURL:function(){
		if(this.URL=='unknown')
			return Traspac.MANJAB_URL+'/kompetensi/c_kompetensi/get_kamus';
		else
			return this.URL;
	},
	getColumns:function(){
		if(this.columns=='unknown')
			return [{
				xtype: 'treecolumn', 
				text: 'Kelompok Kompetensi',
				flex: 1,
				sortable: true,
				dataIndex: 'text',
			}];
		else return this.columns;
	}
});

