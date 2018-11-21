/**
 * @class Traspac.components.field.Pendidikan
 * @extends Traspac.abstract.FieldButton
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Pendidikan field for traspac application
 * This Pendidikan field is created to be input in application form
 *
 * @Modified by ary kurniadi
 * @Description
 * Add flag to create tingkatpendidikan or jurusan
 * 
 
 * @date 03 Sep  2015, 01:10:24 WIB
 * # Example
 * 		
 *		@example menampilkan jurusan
 * 		Ext.create('Traspac.components.field.Pendidikan', {
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
 *		@example menampilkan tingkatpendidikan
 * 		Ext.create('Traspac.components.field.Pendidikan', {
 *			width:400,
 *			fieldLabel:'Unit Kerja',
 *			mode: 'tingkatpendidikan',
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

Ext.define('Traspac.components.field.Pendidikan', {
	extend: 'Traspac.abstract.FieldButton',
	alias: 'widget.pendidikanfield',
	
	requires:['Traspac.components.window.CariPendidikan'],
	config: {
		mode: 'tingkatpendidikan', //Definisikan flag untuk menampilka  tingkat pendidikan atau jurusannya
	},	
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
			return 'PENDIDIKAN';
		else return this.name;
	},
	
	getFieldLabel:function(){
		if(this.fieldLabel=='unknown')
			return 'Pendidikan';
		else return this.fieldLabel;
	},
	
	createWindow:function(){
		var me=this;
		return Ext.create('Traspac.components.window.CariPendidikan', {
			listeners		:{
				itemclick:function(a,b,c,d){
					me.fireEvent('itemclick',a,b,c,d);
				},
				pilih:function(e,name){
					me.fireEvent('pilih',e,name);
					console.log(me);
					var id='';
					if(name=='tree'){
						if(me.mode == 'tingkatpendidikan'){
							me.field.setValue(e.get('TINGKATPENDIDIKAN'));
							me.fieldid.setValue(e.get('TINGKATPENDIDIKANID'));
						}
						else{
							me.field.setValue(e.get('text'));
							me.fieldid.setValue(e.get('id'));							
						}
						id='id';
					}else{
						if(me.mode == 'tingkatpendidikan'){
							me.field.setValue(e.get('TINGKATPENDIDIKAN'));
							me.fieldid.setValue(e.get('TINGKATPENDIDIKANID'));							
						}
						else{
							me.field.setValue(e.get('PENDIDIKAN'));
							me.fieldid.setValue(e.get('PENDIDIKANID'));							
						}
						id='PENDIDIKANID';
					}
					
					if(me.up('grid')){
						var grid=me.up('grid');
						var rec=grid.getSelectionModel().getSelection()[0];
						rec.set(me.name,e.get('PENDIDIKANID'));
					}
				},
				batal:function(a){
					me.fireEvent('batal',me);
				}
			}
		});
	}

});