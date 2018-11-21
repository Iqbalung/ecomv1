/**
 * @class Traspac.components.field.Diklat
 * @extends Traspac.abstract.FieldButton
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Diklat field for traspac application
 * This Diklat field is created to be input in application form
 *
 * # Example
 * 		
 *		@example
 * 		Ext.create('Traspac.components.field.Diklat', {
 *			width:400,
 * 			jenis:'STRUKTURAL',
 *			fieldLabel:'Diklat Strkturals',
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

Ext.define('Traspac.components.field.Diklat', {
	extend: 'Traspac.abstract.FieldButton',
	alias: 'widget.diklatfield',
	
	requires:['Traspac.components.window.Diklat'],
	
	config:{
		jenis:'',
	},
	
	initComponent	: function() {
		var me=this;
		
		if(me.jenis=='STRUKTURAL'){
			me.idRoot='1.';
		}else if(me.jenis=='FUNGSIONAL'){
			me.idRoot='2.';
		}else if(me.jenis=='TEKNIS'){
			me.idRoot='3.';
		}else{
			me.idRoot=me.jenis;
		}
		
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
			return 'DIKLAT'+this.jenis;
		else return this.name;
	},
	

	
	updateValue:function(val,v){
		if(this.field.setValue)
			this.field.setValue(val);
	},
	
	createWindow:function(){
		var me=this;
		return Ext.create('Traspac.components.window.Diklat', {
			jenis:me.jenis,
			idRoot:me.idRoot,
			listeners		:{
				itemclick:function(a,b,c){
					me.fireEvent('itemclick',a,b,c);
				},
				pilih:function(e){
					me.fireEvent('pilih',e);
					me.field.setValue(e.get('text'));
					me.fieldid.setValue(e.get('id'));
					me.value=e.get('text');
					
					if(me.up('grid')){
						var grid=me.up('grid');
						var rec=grid.getSelectionModel().getSelection()[0];
						rec.set(me.name+'ID',e.get('id'));
					}
				},
				batal:function(a){
					me.fireEvent('batal',me);
				}
			}
		});
	}
	

});