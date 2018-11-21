Ext.define('Traspac.components.field.SearchPejabatPenetap', {
	extend: 'Traspac.abstract.FieldButton',
	alias: 'widget.searchpejabatpenetapfield',	
	requires:['Traspac.abstract.FieldButton','Traspac.components.window.SearchPejabatPenetap'],	
	isShowFocus :true,
	isShowEnter :true,	
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
			return 'jabatan';
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
	},	
	createWindow:function(){
		var me=this;
		return Ext.create('Traspac.components.window.SearchPejabatPenetap', {
			listeners: {
				pilih: function(rec){
					me.field.setValue(rec.get('JABATAN'));
					me.fieldid.setValue(rec.get('PEJABATPENETAPID'));
					me.fireEvent('pilih',rec);					
				}
			}
		});		
	}

});