/**
 * @class Traspac.components.field.KamusJabatan
 * @extends Traspac.abstract.FieldButton
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component KamusJabatan field for traspac application
 * This KamusJabatan field is created to be input in application form
 *
 * # Example
 * 		
 *		@example
 * 		Ext.create('Traspac.components.field.KamusJabatan', {
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

Ext.define('Traspac.components.field.KamusJabatan', {
	extend: 'Traspac.abstract.FieldButton',
	alias: 'widget.kamusjabatanfield',
	
	requires:['Traspac.components.window.KamusJabatan'],
	
	isSetStore:true,
	
	config:{
		onlyFungsional:false,
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
	
	HISTORY_ID_JS		:'',
	HISTORY_ID_JF		:'',
	URL_FUNGSIONAL		:Traspac.MASTER_URL+'/c_jabatan/getDataSatker',
	URL_STRUKTURAL		:Traspac.MASTER_URL+'/c_unit_kerja/get_tree_satker',
	URL_GRID	  		:Traspac.SIAP_URL+'/tree/get_jabatan',
	
	IS_ID:'id',
	IS_ID_F:'id',
	IS_FUNGSIONALID:'FUNGSIONALID',
	
	getName:function(){
		if(this.name=='unknown')
			return 'KAMUSJABATAN';
		else return this.name;
	},
	
	getFieldLabel:function(){
		if(this.fieldLabel=='unknown')
			return 'Kamus Jabatan';
		else return this.fieldLabel;
	},
	
	createWindow:function(){
		var me=this;
		return Ext.create('Traspac.components.window.KamusJabatan', {
			HISTORY_ID_JS :me.HISTORY_ID_JS,
			HISTORY_ID_JF :me.HISTORY_ID_JF,
			URL_FUNGSIONAL:me.URL_FUNGSIONAL,
			URL_STRUKTURAL:me.URL_STRUKTURAL,
			URL_GRID	  :me.URL_GRID,
			onlyFungsional:me.onlyFungsional,
			listeners		:{
				itemclick:function(a,b,c,d){
					me.fireEvent('itemclick',a,b,c,d);
				},
				pilih:function(e,name){
					me.fireEvent('pilih',e,name);
					var id='';
					if(name=='grid'){
						me.field.setValue(e.get('NAMA'));
						me.fieldid.setValue(e.get(me.IS_FUNGSIONALID));
						id=me.IS_FUNGSIONALID;
					}else if(name=='tree_struktural'){
						me.field.setValue(e.get('text'));
						me.fieldid.setValue(e.get(me.IS_ID));
						id=me.IS_ID;
					}else if(name=='tree_fungsional'){
						me.field.setValue(e.get('text'));
						me.fieldid.setValue(e.get(me.IS_ID_F));
						id=me.IS_ID_F;
					}
					
					if(me.up('grid')){
						var grid=me.up('grid');
						var rec=grid.getSelectionModel().getSelection()[0];
						if(me.isSetStore && rec)
							rec.set(me.name,e.get(id));
					}
					
				},
				batal:function(a){
					me.fireEvent('batal',me);
				}
			}
		});
	}

});