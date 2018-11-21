/**
 * @class Traspac.components.grid.Pegawai
 * @extends Ext.grid.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component Pegawai for traspac application
 * This LogAktivitas is created to be show data log activity. 
 *
 **/

Ext.define("Traspac.components.grid.LogAktivitas",{
	extend		: "Traspac.abstract.Grid",
	alias: 'widget.gridlogaktivitas',
	
	requires:['Traspac.abstract.Grid'],
	
	isLogSemua:false,
	USERID:'',
	MODULID:'',
	isHideFilterModul:false,
	
	initComponent	: function(a) {
		var me=this;
		var modul='';
		
		if(me.isHideFilterModul==false){
			modul={
				xtype:'combobox',
				emptyText:'Modul',
				store:Ext.create('Ext.data.Store',{
					fields: ['FITURID','FITUR','MENUID','ISMENU','DATAFITUR'],
					proxy:{
						type:'ajax',
						url:Traspac.MASTER_URL+'/c_log_aktivitas/modul/'
					}
				}),
				displayField:'FITUR',
				valueField:'DATAFITUR',
				id:'comboModul',
			};
		}
		
		this.tbar=[
			modul,
			{
				xtype:'datefield',
				emptyText:'Dari',
				format:'d/m/Y',
				id:'dari',
			},
			's.d.',
			{
				xtype:'datefield',
				emptyText:'Sampai',
				format:'d/m/Y',
				id:'sampai',
			},
			{
				xtype:'textfield',
				emptyText:'Kata Kunci',
				id:'keyword',
			},
			{
				text:'Tampilkan',
				iconCls:'cari',
				handler:function()
				{
					me.getStore().loadPage(1);
				}
			},
			'->',
			{
				text:'Cetak',
				iconCls:'pelayanan_cetak',
				handler:function(){
					var i = me.getStore().proxy.extraParams;
					var start = (i.start == undefined) ? '0' : i.start;
					var limit = (i.limit == undefined) ? '1000000' : i.limit;
					var modulId = (i.modulId == null) ? '' : i.modulId;
					
					start = (parseInt(me.getStore().currentPage) - 1) * 25;
					window.open(Traspac.MASTER_URL+'/c_log_aktivitas/cetak/?userid='+i.userid+'&start='+start+'&limit='+limit+'&dari='+i.dari+'&sampai='+i.sampai+'&modulId='+modulId+'&kataKunci='+i.kataKunci);
				}
			}
		];
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
			return Traspac.Constants.MASTER_URL+'/c_log_aktivitas/getLogAktivitas';
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
	fields:[
		'HOSTNAME', 'USERLOGIN', 'IPADDRESS', {name:'JAM'}, 'JENIS', 'HASIL', 'KETERANGAN',
		'NOMOR','USERID','USERLOGID','MODUL','MODULID'
	],
	getDefaultColumns:function(){
		return [
			{header: 'No', xtype:'rownumberer',width:35},
			{header: 'Modul', dataIndex: 'MODUL',width:120, renderer: wrap_text}, 
			{header: "Waktu", dataIndex: 'JAM', width:150},
			{header: 'User Login', dataIndex: 'USERLOGIN',width:150, renderer : wrap_text}, 
			{header: 'Alamat IP', dataIndex: 'IPADDRESS'},
			{header: "Jenis", dataIndex: 'JENIS',width:150, renderer : wrap_text},
			{header: "Hasil", dataIndex: 'HASIL',width:150, renderer : wrap_text},
			{header: "Keterangan",	dataIndex: 'KETERANGAN', renderer : wrap_text, flex:1},
		];
	},
	autoScroll:true,
	isLoad:true,
	root:'data',
	totalProperty:'total',
	onBeforeLoad:function(){
		var me=this;
		
		var value = (me.isLogSemua == true) ? '' : me.USERID;
		me.getStore().proxy.extraParams.userid = value;
		if(me.isHideFilterModul==true){
			me.getStore().proxy.extraParams.modulId = me.MODULID;
		}
		else{
			var modulid = Ext.getCmp('comboModul').getValue();
			console.log(modulid);
			if(modulid=="" || modulid==null){modulid="9"};
			me.getStore().proxy.extraParams.modulId = modulid;
		}
		me.getStore().proxy.extraParams.kataKunci = Ext.getCmp('keyword').getValue();
		me.getStore().proxy.extraParams.dari = Ext.getCmp('dari').rawValue;
		me.getStore().proxy.extraParams.sampai = Ext.getCmp('sampai').rawValue;
		
		
	}

	
});