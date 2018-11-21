Ext.define("Traspac.components.window.SearchPejabatPenetap",{
	extend		: "Traspac.components.window.Pilih",
	alias: 'widget.searchpejabatpenetapwindow',	
	requires:['Traspac.components.grid.PejabatPenetap'],	
	config:{	
		satkerid			:	'',
		formFilter			:	null,
		gridCari			:	null,
		tree				:	null,
		URL					:	''
	},
	initComponent	: function(a) {
		
		var me=this;
		this.addEvents({
			"onbeforepostdata"	: true,
			"batal"				: true,
			"pilih"				: true
		});
		
		this.layout='auto';
		this.title = 'Pejabat Penetap';
		this.callParent([arguments]);
		
	},	
	buildGrid:function(){
		var me=this;
		var TahunStore = new Ext.data.SimpleStore( { 
			fields: [ 'value', 'text' ], 
			data: [] 
		});		
		var tahun = new Array();
		for(i=0;i<50;i++){
			var id_th = new Array();
			var date = new Date();
			var item = date.getFullYear() - i;
			id_th[0] = item;
			id_th[1] = item;
			tahun[i] = id_th;
		}		
		return Ext.create('Traspac.components.grid.PejabatPenetap', {
			width:700,
			region: 'center',
			height:300,
			border:true,
			id:'gridcari',
			URL: me.getURL(),
			autoScroll:true,
			isLoad:true,
			root: 'results',			
			columns:[
				{header: 'No',align: 'center',xtype: 'rownumberer',width: 30},
				{header: "Jabatan",	dataIndex: 'JABATAN', sortable: true,width: 200},
				{header: "Nama", dataIndex: 'NAMA',	sortable: true,	width: 200},
				{header: "NIP", dataIndex: 'NIP', sortable: true,width: 120},
				{header: "Awal", dataIndex: 'TAHUNAWAL', sortable: true, width: 80},
				{header: "Akhir", dataIndex: 'TAHUNAKHIR', sortable: true, width: 80},
			],
			listeners:{
				beforeload:function(){					
					me.onbeforepostdata();	
				}
			},
			tbar: [
				{
					xtype :'textfield', itemId :'key', emptyText :'Kata kunci ..', width :200,
				},'-',
				{ 	
					xtype:'combo',
					fieldLabel: 'Tahun',
					labelWidth: 40,
					width:100,
					value: '2015',
					name: 'tahun',
					itemId:'tahun',
					queryMode: 'local',
					triggerAction: 'all',
					selectOnFocus:true,
					store:TahunStore,
					listeners:{
						render:{fn:function(thisCombo){
						   TahunStore.loadData(tahun);
						}}
					}
				},				
				{
					iconCls :'cari',
					handler: function(){
						me.gridCari.getStore().load();
					}
				},
			]
		});
	},
	
	buildContent:function(){
		var gridCari=this.buildGrid();	
		this.setGridCari(gridCari);		
		return [gridCari];
	},
	
	onPilih:function(){
		var m = this.gridCari.getSelectionModel().getSelection();
		if(m.length>0){
			this.fireEvent("pilih", m[0]);
		}
		else{
			Traspac.Msg.alert("Tidak ada data yang dipilih");
		}		
	},

	onBatal:function(){
		this.fireEvent("batal", this);
	},
	
	onbeforepostdata:function(){
		this.params = this.gridCari.store.proxy.extraParams;
		this.params.key = this.gridCari.down('#key').getValue();
		this.params.tahun = this.gridCari.down('#tahun').getValue();
	},
	getURL:function(){
		if(!this.config.URL || this.config.URL == ''){
			return Traspac.MASTER_URL+'/c_pejabat_penetap/get_pejabat_penetap';
		}
		else{
			return this.config.URL;
		}
	},
	getFields:function(){
		return ['PEJABATPENETAPID','JABATAN'];
	},
	getTitle:function(){
		if(!this.title){
			return 'Pejabat Penetap';
		}
		else 
			return this.title;		
	},
	getColumns:function(){
	},
});

