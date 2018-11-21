/**
 * @class Traspac.components.field.Cari
 * @extends Traspac.abstract.FieldButton
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Cari field for traspac application
 * This Cari field is created to be input in application form
 *
 * # Example
 * 		
 *		@example
 * 		Ext.create('Traspac.components.field.Cari', {
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

Ext.define('Traspac.components.field.Cari', {
  extend: 'Traspac.abstract.FieldButton',
  alias: 'widget.carifield',
  
  initComponent	: function() {
	
	var me = this;

	
	this.fieldLabel=this.getFieldLabel();
	this.name=this.getName();
	this.autoHeight=true;
	this.window=null;
  
    this.callParent([arguments]);
	
  },
  getName:function(){
	if(this.name=='unknown')
		return 'KEYWORD';
	else return this.name;
  },
  getFieldLabel:function(){
	if(!this.fieldLabel)
		return 'Cari';
	else return this.fieldLabel;
  }

});