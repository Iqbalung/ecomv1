/**
 * @class Traspac.abstract.Combo
 * @extends Ext.form.field.ComboBox
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component abstract combo for traspac application
 * This combo is created to be parent for field component. Example: PangkatField, AgamaField etc.
 * @params
 * The Abstract combo have been four service configs:
 * URL  		: setting url for data combo
 * fields  		: fields is name output data
 *  			  index 0 for valueField
 *  			  index 1 for displayField
 * name         : for this name component 
 * label        : for this label component 
 *
 * @event
 * This abstract add event like this:
 * afterload    : callback function if combo store was loaded
 * example      :
 *                listeners:{
 * 					
 *				      afterload:function(me){
 *							callAfterLoad();
 *					  }	
 *				 }
 **/

Ext.define('Traspac.abstract.Combo', {
  extend: 'Ext.form.field.ComboBox',
  alias: 'widget.abstractcombo',
  config:{
		URL:'unknown',
		name:'unknown',
		fields:'unknown',
		label:'unknown',
		root:'data',
		totalProperty: 'total',
		isLoad:true,
		queryMode: 'local',
		pageSize: ''
  },
  method: 'POST',
  constructor: function(config) {
	var me=this;
	this.addEvents({
		"afterload"	: true,
		"beforeload"	: true,
	});
	this.initConfig(config);
	
	if(this.getURL()){
		var store =Ext.create('Ext.data.Store', {
			autoLoad:me.isLoad,
			fields:this.getFields(),
			listeners:{
				load:function(a,b){
					if( !b || b.length==0){
						this.load();
					}
					me.fireEvent("afterload", this,me);
				},
				beforeload:function(a,b){
					me.fireEvent("beforeload", this,me);
				}
			},
			proxy: {
				type: 'ajax',
				actionMethods: {
					read   : this.method,
				},
				api: {
					read: this.getURL()
				},
				reader: {
					type: 'json',
					root: this.getRoot(),
					totalProperty: this.totalProperty,
					successProperty: 'success'
				}
			},
			pageSize: this.pageSize, 
		});
	}

    Ext.apply(this, config, {
        store: store,
        displayField: this.getFields()[1],
        valueField: this.getFields()[0],
        queryMode: this.queryMode,
        name: this.getName(),
        itemId: this.getName(),
        fieldLabel: this.getLabel(),
		pageSize: this.pageSize,
       // emptyText:'Pilih '+this.getLabel()+'...'
    });

    this.callParent([arguments]);

  },
  
  

});