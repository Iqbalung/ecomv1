/**
 * @class Traspac.components.window.Pilih
 * @extends Ext.window.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component Pilih for traspac application
 * This Pilih was abstract containing content and options button (Pilih and Batal).
 * This class was built to be a framework for its sub classes, like window.Jabatan, window.Diklat, etc
 *
 **/

Ext.define("Traspac.components.window.Pilih",{
	extend: "Traspac.abstract.Window",
	content:'',
	
	layout:'fit',
	border:false,
	initComponent	: function(a) {
		
		var me=this;

		this.bbar=['->',{
			xtype:'button',
			text:'Pilih',
			itemId:'pilih',
			handler:function(){

				var a=me.onPilih();
				
				if(a!==false)
					me.destroy();
			}
		},{
			xtype:'button',
			text:'Batal',
			itemId:'batal',
			handler:function(){
				me.onBatal();
				me.destroy();
			}
		}];
		
		this.content=me.buildContent();
		this.items=this.content;
		
		this.callParent([arguments]);
		
	},
	
	/**
	 * This Method is overrided by sub class
	 */
	buildContent:function(){
		
	},
	
	/**
	 * This Method is overrides by sub class
	 */
	onPilih:function (){
		
	},
	
	/**
	 * This Method is overrided by sub class
	 */
	onBatal:function (){
		
	},
	
	onDestroy : function(){
        this.callParent(arguments);
    },
 
	
});

