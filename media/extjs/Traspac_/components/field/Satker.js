/**
 * @class Traspac.components.field.Satker
 * @extends Traspac.abstract.FieldButton
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Satker field for traspac application
 * This Satker field is created to be input in application form
 *
 * # Example
 * 		
 *		@example
 * 		Ext.create('Traspac.components.field.Satker', {
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

Ext.define('Traspac.components.field.Satker', {
	extend: 'Traspac.abstract.FieldButton',
	alias: 'widget.satkerfield',
	
	requires:['Traspac.components.window.Struktural'],
	
	HISTORY_ID		:	'',
	
	getURL:function(){
		if(this.URL=='unknown')
			return Traspac.Constants.MASTER_URL+'/c_unit_kerja/get_tree_satker';
		else{
			return this.URL;
		}
	},
	
	IS_ID:'id',

	
	initComponent	: function() {
	
	var me = this;
	this.addEvents({
		"itemclick"	: true,
		'celldblclick': true,
		"pilih"		: true,
		"batal"		: true
	});
	
	this.fieldLabel=this.getFieldLabel();
	this.name=this.getName();
	this.emptyText = this.getEmptyText();
	this.autoHeight=true;
  
    this.callParent([arguments]);
	
	},
	getName:function(){
		if(this.name=='unknown')
			return 'SATKER';
		else return this.name;
	},
	getEmptyText: function(){
		return this.emptyText;
	},
	getFieldLabel:function(){
		if(this.fieldLabel=='unknown')
			return 'Unit Kerja';
		else return this.fieldLabel;
	},
	
	createWindow:function(){
		var me=this;

		return Ext.create('Traspac.components.window.Struktural', {
			title: me.title,
			isUnitKerja: true,
			HISTORY_ID: me.HISTORY_ID,
			URL: me.URL,
			height: me.height || 500,
			listeners: {
				itemclick:function(a,b,c){
					me.fireEvent('itemclick',a,b,c);
				},
				celldblclick: function(tree, record, td, rowIndex){
					me.fireEvent('celldblclick',tree, record, td, rowIndex);
					me.field.setValue(record.get('text'));
					me.fieldid.setValue(record.get(me.IS_ID));
					me.value=record.get('text');
					
				},
				pilih:function(e,a){
				console.log(a);	
					var id_=''
					var text_='';
					for (b in a){
						if(b!=0){
							id_+=','+a[b].get(me.IS_ID);
							text_+=','+a[b].get('unitkerja') || a[b].get('text');
						}else{
							id_+=a[b].get(me.IS_ID);
							text_+=a[b].get('unitkerja') || a[b].get('text');
						}
					}
				
					me.field.setValue(text_);
					me.fieldid.setValue(id_);
					me.value=text_;
					me.fireEvent('pilih',a);
					
					
					if(me.up('grid')){
						var grid=me.up('grid');
						var rec=grid.getSelectionModel().getSelection()[0];
						console.log(me.name);
						if(me.isSetStore)
							rec.set(me.name+'ID',id_);
					}
					
				},
				batal:function(a){
					me.fireEvent('batal',me);
				}
			}
		});
	}

});