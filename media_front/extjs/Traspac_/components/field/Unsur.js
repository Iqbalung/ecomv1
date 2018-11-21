/**
 * @class Traspac.components.field.Unsur
 * @extends Traspac.abstract.FieldButton
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Unsur field for traspac application
 * This Unsur field is created to be input in application form
 *
 * # Example
 * 		
 *		@example
 * 		Ext.create('Traspac.components.field.Unsur', {
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

Ext.define('Traspac.components.field.Unsur', {
	extend: 'Traspac.abstract.FieldButton',
	alias: 'widget.unsurfield',
	
	requires:['Traspac.components.window.Unsur'],
	
	isSetStore:true,
	
	root:'0',
	
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
			return 'KEGIATAN';
		else return this.name;
	},
	
	getFieldLabel:function(){
		return this.fieldLabel;
	},
	
	setIdRoot:function(id){
		this.root=id;
	},
	
	createWindow:function(){
		var me=this;
		return Ext.create('Traspac.components.window.Unsur', {
			root:me.root,
			url:me.url,
			listeners		:{
				itemclick:function(a,b,c){
					me.fireEvent('itemclick',a,b,c);
				},
				pilih:function(e){
					me.field.setValue(e.get('text'));
					me.fieldid.setValue(e.get('id'));
					rec=null;
					if(me.up('grid')){
						var grid=me.up('grid');
						var rec=grid.getSelectionModel().getSelection()[0];
						
						if(me.isSetStore)
							rec.set(me.name+'_ID',e.get('id'));
					}
					s=this.down('#tree_unsur').getStore();
					me.fireEvent('pilih',e,rec,s);
					
				},
				batal:function(a){
					me.fireEvent('batal',me);
				}
			}
		});
	}

});