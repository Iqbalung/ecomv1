/**
 * @class Traspac.components.field.Pegawai
 * @extends Traspac.abstract.FieldButton
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Pegawai field for traspac application
 * This Pegawai field is created to be input in application form
 *
 * # Example
 * 		
 *		@example
 * 		Ext.create('Traspac.components.field.Pegawai', {
 *			width:400,
 *			fieldLabel:'Pegawai',
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

Ext.define('Traspac.components.field.Pegawai', {
	extend: 'Traspac.abstract.FieldButton',
	alias: 'widget.pegawaifield',
	
	requires:['Traspac.abstract.FieldButton','Traspac.components.window.CariPegawai'],
	
	isShowFocus :false,
	isShowEnter :true,
	
	isSeluruhInstansi : true,
	isOnlyOpsiUnit : false,
	isOnlyOpsiSeluruhUnit : true,
	isPilihDblClick : false,
			
	initComponent	: function() {
	
		var me = this;
		this.addEvents({
			"itemclick"	: true,
			"pilih"		: true,
			"batal"		: true
		});
		
		this.triggerCls		='form-search-pegawai-trigger';
		this.fieldLabel=this.getFieldLabel();
		this.name=this.getName();
		this.autoHeight=true;
  
		this.callParent([arguments]);
	
	},
	getName:function(){
		if(this.name=='unknown')
			return 'PEGAWAI';
		else return this.name;
	},
	
	getFieldLabel:function(){
	if(this.fieldLabel=='unknown')
		return 'Jabatan';
	else return this.fieldLabel;
   },
  
	onClick:function(value,me){
	
	},
	onFocus:function(value,me){
	
	},
	onEnter:function(value,me){
		this.window.setNip(value);
		this.window.gridCari.store.load();
	},
	
	createWindow:function(){
		var me=this;
		return Ext.create('Traspac.components.window.CariPegawai', {
			isSeluruhInstansi		: me.isSeluruhInstansi,
			isOnlyOpsiUnit			: me.isOnlyOpsiUnit,
			isOnlyOpsiSeluruhUnit	: me.isOnlyOpsiSeluruhUnit,
			isPilihDblClick: me.isPilihDblClick,
			listeners		:{
				pilih	:function(e){
					me.field.setValue(e.get('NIP'));
					me.fieldid.setValue(e.get('PEGAWAIID'));
					me.fireEvent('pilih',e);
				},
			}
		});
	}

});