/**
 * @class Traspac.components.field.JenisKelamin
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component JenisKelamin combo for traspac application
 * This JenisKelamin combo is created to be input in application form
 **/

Ext.define('Traspac.components.field.StatusSuamiIstri', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.statussuamiistrifield',
  initComponent	: function() {
	
    this.callParent([arguments]);
	
	this.store = Ext.create('Ext.data.Store', {
		fields: ['ID', 'TEXT'],
		data : [
			{"ID":"1", "TEXT":"PNS Internal"},
			{"ID":"2", "TEXT":"PNS Eksternal"},
			{"ID":"3", "TEXT":"Non PNS"},
		]
	});
	
  },
  
  getFields:function(){
	return ['ID','TEXT'];
  },
  
  getURL:function(){
	return null;
  },
  
  getName:function(){
	if(this.name=='unknown')
		return 'STATUSSUAMIISTRI';
	else return this.name;
  },
  
  getLabel:function(){
	if(this.label=='unknown')
		return 'Status Suami/Istri';
	else return this.label;
  },
});