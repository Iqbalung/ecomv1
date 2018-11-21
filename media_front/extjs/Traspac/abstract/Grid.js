/**
 * @class Traspac.abstract.Grid
 * @extends Ext.grid.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * Description
 *
 *
 **/

Ext.define("Traspac.abstract.Grid",{
	extend		: "Ext.grid.Panel",
	
	paging		: true,
	border		: true,
	full		: true,
	config		:{
		URL				:	'unknown',
		fields			:	'unknown',
		columns			:	'unknown',
		root			:	'rows',
		totalProperty	:	'results',
		isLoad			:	'unknown',
		
		
		isGrouping		:true	,
		groupField		:null	,
		
	},
	initComponent	: function(a) {
		var me = this;

		me.addEvents({
			"beforeload"	: true,
			"load"			: true
		});
		var store=Ext.create('Ext.data.Store', {
			fields:me.getFields(),
			groupField:me.groupField,
			autoLoad:me.getIsLoad(),
			listeners : {
				beforeload : function(){
					me.fireEvent("beforeload", me,this);
					me.onBeforeLoad();
					
				},
				load:function(store, records, successful, operation, eOpts){
					me.fireEvent("load", store, records, successful, operation, eOpts);
					me.onLoad();
				},
			},
			proxy: {
				type: 'ajax',
				actionMethods: {
					create : 'POST',
					read   : 'POST',
				},
				reader: {
					type: 'json',
					root: this.getRoot(),
					totalProperty: this.getTotalProperty()
				},
				url:me.getURL()
			}
		});
		
		this.store=store;
		this.autoScroll=true;
		this.columns=this.getColumns();
		
		
		if(me.paging){
			me.dockedItems = [{
				xtype		: "pagingtoolbar",
				store		:  me.store,
				dock		: "bottom",
				displayInfo	: true
		    }];
		}
		
        
		me.callParent([arguments]);
	},
	
	
	onBeforeLoad:function(){
		
	},
	
	onLoad:function(){
		
	}
});