/**
 * @class Traspac.components.grid.KelasJabatan
 * @extends Ext.grid.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component KelasJabatan for traspac application
 * This KelasJabatan is created to be show data KelasJabatan. 
 *
 **/

Ext.define("Traspac.components.grid.KelasJabatan",{
	extend		: "Traspac.abstract.Grid",
	alias: 'widget.gridkelasjabatan',
	
	requires:['Traspac.abstract.Grid'],
	
	
	initComponent	: function(a) {
		this.callParent(arguments);
	},
	
	getTotalProperty:function(){
		if(this.totalProperty=='unknown')
			return 'results';
		else return this.totalProperty;
	},
	
	getRoot:function(){
		if(this.root=='unknown')
			return 'rows';
		else return this.root;
	},
	getURL:function(){
		if(this.URL=='unknown')
			return Traspac.Constants.MASTER_URL+'/c_kelas_jabatan/getKelasJabatan';
		else return this.URL;
	},
	
	getFields:function(){
		if(this.fields=='unknown')
			return this.getDefaultFields();
		else return this.fields;
	},
	
	getColumns:function(){
		if(this.columns=='unknown'){
			return this.getDefaultColumns();
		}else return this.columns;
	},
	
	getIsLoad:function(){
		if(this.isLoad=='unknown'){
			return false;
		}else return this.isLoad;
	},
	
	getDefaultColumns:function(){
		return [
			{xtype: 'rownumberer',text: 'No',width:45},
			{header: 'Kelas Jabatan', dataIndex: 'KELASJABATAN',flex:1 }, 
			{header: 'Tunjangan', dataIndex: 'KELASJABATAN',flex:1}
		];
	},
	
	getDefaultFields:function(){
		return [
			'ID','KELASJABATAN', 'TUNJANGAN'
		];
	}
});