/**
 * @class Traspac.components.field.JabatanSidang
 * @extends Traspac.abstract.FieldButton
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Jabatan field for traspac application
 * This Jabatan field is created to be input in application form
 *
 * # Example
 * 		
 *		@example
 * 		Ext.create('Traspac.components.field.JabatanSidang', {
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

Ext.define('Traspac.components.field.JabatanSidang', {
  extend: 'Traspac.abstract.FieldButton',
  alias: 'widget.jabatansidangfield',
  
  requires:['Traspac.components.window.StrukturalSidang'],
  
  isSetStore:true,
  
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
		return 'JABATAN';
	else return this.name;
  },
  getFieldLabel:function(){
	if(this.fieldLabel=='unknown')
		return 'Jabatan';
	else return this.fieldLabel;
  },
  
  createWindow:function(){
	var me=this;
	return Ext.create('Traspac.components.window.StrukturalSidang', {
		isUnitKerja		:false,
		listeners		:{
			itemclick:function(a,b,c){
				me.fireEvent('itemclick',a,b,c);
			},pilih:function(e){
				me.fireEvent('pilih',e);
				me.field.setValue(e.get('NAMAJABATAN'));
				me.fieldid.setValue(e.get('SATKERID'));
				
				if(me.up('grid')){
					var grid=me.up('grid');
					var rec=grid.getSelectionModel().getSelection()[0];
					if(me.isSetStore)
						rec.set(me.name,e.get('SATKERID'));
				}
				
			},batal:function(a){
				me.fireEvent('batal',me);
			}
		}
	});
  }

});