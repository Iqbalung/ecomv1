/**
 * @class Traspac.components.field.Wilayah
 * @extends Traspac.abstract.FieldButton
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Wilayah field for traspac application
 * This Wilayah field is created to be input in application form
 *
 * # Example
 * 		
 *		@example
 * 		Ext.create('Traspac.components.field.Wilayah', {
 *			width:400,
 *			fieldLabel:'Unit Kerja',
 *			listeners:{
 *				pilih:function(record){
 *					alert(record.get('id'));
 *				},
 *				itemclick:function(e,record){
 *					alert(record.get('id'));
 *				},
 *				batal:function(cmp){
 *					alert('event is canceled by me'); 
 *				},
 *			},
 *			renderTo:Ext.getBody()
 *		});
 * 
 **/

Ext.define('Traspac.components.field.Wilayah', {
	extend: 'Traspac.abstract.FieldButton',
	alias: 'widget.wilayahfield',
	
	requires:['Traspac.components.window.Wilayah'],
	
	initComponent	: function() {
	
		var me = this;
		this.addEvents({
			"itemclick"	: true,
			"pilih"		: true,
			"batal"		: true
		});
		

		this.name=this.getName();
		this.autoHeight=true;
	  
		this.callParent([arguments]);
	
	},
	
	getName:function(){
		if(this.name=='unknown')
			return 'WILAYAH';
		else return this.name;
	},
	
	
	createWindow:function(){
		var me=this;
		return Ext.create('Traspac.components.window.Wilayah', {
			listeners		:{
				itemclick:function(a,b,c){
					me.fireEvent('itemclick',a,b,c);
				},
				pilih:function(e){
					me.fireEvent('pilih',e);
					me.field.setValue(e.get('text'));
					me.fieldid.setValue(e.get('id'));
					
					if(me.up('grid')){
						var grid=me.up('grid');
						var rec=grid.getSelectionModel().getSelection()[0];
						rec.set(me.name,e.get('id'));
					}
					
				},
				batal:function(a){
					me.fireEvent('batal',me);
				}
			}
		});
	}

});