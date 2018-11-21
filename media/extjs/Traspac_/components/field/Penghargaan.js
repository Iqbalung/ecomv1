/**
 * @class Traspac.components.field.Penghargaan
 * @extends Traspac.abstract.FieldButton
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Penghargaan field for traspac application
 * This Penghargaan field is created to be input in application form
 *
 * # Example
 * 		
 *		@example
 * 		Ext.create('Traspac.components.field.Penghargaan', {
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

Ext.define('Traspac.components.field.Penghargaan', {
	extend: 'Traspac.abstract.FieldButton',
	alias: 'widget.penghargaanfield',
	
	requires:['Traspac.components.window.Penghargaan'],
	
	initComponent	: function() {
	
	var me = this;
	this.addEvents({
		"itemclick"	: true,
		"pilih"		: true,
		"batal"		: true
	});
	
	this.fieldLabel=this.getFieldLabel();
	this.name=this.getName();
	this.autoHeight=true;
	
  
    this.callParent([arguments]);
	
	},
	
	getName:function(){
		if(this.name=='unknown')
			return 'PENGHARGAAN';
		else return this.name;
	},
	
	getFieldLabel:function(){
		if(!this.fieldLabel)
			return 'Penghargaan';
		else return this.fieldLabel;
	},
	
	createWindow:function(){
		var me=this;
		return Ext.create('Traspac.components.window.Penghargaan', {
			listeners		:{
				itemclick:function(a,b,c){
					me.fireEvent('itemclick',a,b,c);
				},
				pilih:function(e){
					me.fireEvent('pilih',e);
					me.field.setValue(e.get('text'));
					me.fieldid.setValue(e.get('id'));
				},
				batal:function(a){
					me.fireEvent('batal',me);
				}
			}
		});
	}

});