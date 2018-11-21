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

Ext.define('Traspac.components.field.StatusKawin', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.statuskawinfield',
  initComponent	: function() {
	
    this.callParent([arguments]);
	
	this.store = Ext.create('Ext.data.Store', {
		fields: ['ID', 'TEXT'],
		data : [
			{"ID":"B", "TEXT":"Belum Kawin"},
			{"ID":"K", "TEXT":"Kawin"},
			{"ID":"J", "TEXT":"Janda"},
			{"ID":"D", "TEXT":"Duda"},
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
		return 'STATUSKAWIN';
	else return this.name;
  },
  
  getLabel:function(){
	if(this.label=='unknown')
		return 'Status Kawin';
	else return this.label;
  },
});