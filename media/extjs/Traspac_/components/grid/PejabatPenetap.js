Ext.define("Traspac.components.grid.PejabatPenetap",{
	extend		: "Traspac.abstract.Grid",
	alias: 'widget.pejabatpenetapgrid',	
	requires:['Traspac.abstract.Grid'],	
	initComponent	: function(a) {
		this.callParent(arguments);
	},
	getTotalProperty:function(){
		if(this.totalProperty=='unknown')
			return 'total';
		else return this.totalProperty;
	},
	getRoot:function(){
		if(this.root=='unknown')
			return 'results';
		else return this.root;
	},
	getURL:function(){
		if(this.URL=='unknown')
			return Traspac.MASTER_URL+'/c_pejabat_penetap/get_pejabat_penetap';
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
			{header: 'No',align: 'center',xtype: 'rownumberer',width: 30},
			{header: "Jabatan",	dataIndex: 'JABATAN', sortable: true,width: 200},
			{header: "Nama", dataIndex: 'NAMA',	sortable: true,	width: 200},
			{header: "NIP", dataIndex: 'NIP', sortable: true,width: 120},
			{header: "Awal", dataIndex: 'TAHUNAWAL', sortable: true, width: 80},
			{header: "Akhir", dataIndex: 'TAHUNAKHIR', sortable: true, width: 80},		
		];
	},
	fields:[
		'PEJABATPENETAPID','JABATAN','NAMA','NIP','GOL','PANGKAT','TAHUNAWAL','TAHUNAKHIR','SATKERID'
	]
});