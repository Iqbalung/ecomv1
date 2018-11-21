/**
 * @class Traspac.components.tree.Struktural
 * @extends Ext.tree.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component Struktural for traspac application
 * This Struktural is created to be show strukturals data jabatan with tree component. 
 * @example
 * 		var window=Ext.create('Traspac.components.window.StrukturalSidang', {
 *			isUnitKerja		:true,
 *			listeners		:{
 *				itemclick:function(a,record,c){
 *					console.log(record.get('text'));
 *					console.log(record.get('id'));
 *				}
 *			}	
 *		}).show();
 **/

Ext.define("Traspac.components.window.StrukturalSidang",{
	extend		: "Traspac.components.window.Pilih",
	alias: 'widget.windowstruktural',
	
	requires:['Traspac.components.tree.UnitKerja','Traspac.components.tree.Jabatan'],
	
	config:{
		isUnitKerja			:	true,
		tree				:	null
	},
	URL:'',
	HISTORY_ID:'',
	
	initComponent	: function(a) {
		var me=this;
		
		this.addEvents({
			"itemclick"	: true,
			'celldblclick': true,
			"batal"		: true,
			"pilih"		: true,
		});
		
		
		this.callParent([arguments]);
	
	
	},
	
	buildContent:function(){
		var me=this;
		this.grid= Ext.create('Traspac.abstract.Grid', {
			name:'grid',
			isLoad:true,
			URL:Traspac.BAPERJAKAT_URL+'/anjab/get_data_sidang',
			fields:['NAMAJABATAN','SATKER','ESELON','JMLTERPILIH','SATKERID'],
			viewConfig: {
				getRowClass: function(record, rowIndex, rowParams, store) {
					if (record.get('JMLTERPILIH')>=1)
						return 'hide';

				}
			},
			columns:[
				{header: "Nama Jabatan", dataIndex: 'NAMAJABATAN', sortable: true,width:270},
				{header: "Eselon", dataIndex: 'ESELON',	sortable: true, width: 70,
					
				}
			],
			listeners:{
				beforeload:function(){
					//me.onbeforepostdata();
				},
				itemclick:function(a,b,c){
					me.fireEvent('itemclick',a,b,c,'grid');
				}
			}
		});
		
		return Ext.create('Ext.panel.Panel', {
			width:340,
			height:500,
			layout:'fit',
			items:[this.grid]
		});
	},
	
	onPilih:function(){
		var me=this;
		var e=me.grid.getSelectionModel().getSelection();
		if(e.length>0){
			me.fireEvent("pilih", e[0],e);
			me.hide();
		}else{
			Traspac.Msg.alert("Tidak ada data yang dipilih");
		}
	},
	
	onBatal:function(){
		var me=this;
		me.fireEvent("batal", me);
	}
});