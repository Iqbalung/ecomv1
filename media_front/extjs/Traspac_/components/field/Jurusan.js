/**
 * @class Traspac.components.field.Jurusan
 * @extends Traspac.abstract.FieldButton
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Jurusan field for traspac application
 * This Jurusan field is created to be input in application form
 *
 * # Example
 * 		
 *		@example
 * 		Ext.create('Traspac.components.field.Jurusan', {
 *			width:400,
 * 			jenis:'STRUKTURAL',
 *			fieldLabel:'Jurusan Strkturals',
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

Ext.define('Traspac.components.field.Jurusan', {
	extend: 'Traspac.abstract.FieldButton',
	alias: 'widget.jurusanfield',
	
	requires:['Traspac.components.window.Jurusan'],
	
	config:{
		PENDIDIKANID:'01',
	},
	
	isSetStore:true,
	
	initComponent	: function() {
		var me=this;
		
		var me = this;
		this.addEvents({
			"click"		: true,
			"focus"		: true,
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
			return 'Jurusan'+this.jenis;
		else return this.name;
	},
	

	
	updateValue:function(val,v){
		if(this.field.setValue)
			this.field.setValue(val);
	},
	
	createWindow:function(){
		var me=this;
		return Ext.create('Traspac.components.window.Jurusan', {
			jenis:me.jenis,
			PENDIDIKANID:me.PENDIDIKANID,
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
						if(me.isSetStore)
							rec.set(me.name+'ID',e.get('id'));
					}
				},
				batal:function(a){
					me.fireEvent('batal',me);
				}
			}
		});
	},
	
	onFocus:function(val,me){
		me.fireEvent('focus',val,me);
	},
	onClick:function(val,me){
		me.fireEvent('click',val,me);
	}
	

});