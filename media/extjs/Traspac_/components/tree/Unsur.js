/**
 * @class Traspac.components.tree.Jabatan
 * @extends Ext.tree.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 18 Sep 2015 19:13:29
 *
 * @Description
 * Building component Unsur for traspac application
 * This Unsur is created to be show data Unsur with tree component. 
 *
 **/

Ext.define("Traspac.components.tree.Unsur",{
	extend		: "Traspac.abstract.Tree",
	alias: 'widget.treeUnsur',
	
	fields:["id","text","keterangan","KELOMPOK","SATUAN",{name:"ANGKA_KREDIT",type:"float"},"KODE"],
	method:'GET',
	rootVisible:false,
	initComponent	: function(a) {
		this.callParent([arguments]);
	},
	getIdroot:function(){
		return this.idroot;
	},
	getURL:function(){
		// return this.url;
		return Traspac.FPAK_URL+'/master/unsur/get/?tingkat=2';
	},
	getColumns:function(){
		if(this.columns=='unknown')
			return [
				{
					xtype: 'treecolumn', 
					text: 'Unsur',
					flex: 1,
					sortable: true,
					dataIndex: 'text',
				},
				{
					header: 'Nilai AK',
					width: 60,
					align: 'center',
					dataIndex: 'ANGKA_KREDIT',
					renderer: function(a,b,c){
						if(a==0){
							return '';
						} else {
							return a;
						}
					}
				}
			];
		else return this.columns;
	}
});