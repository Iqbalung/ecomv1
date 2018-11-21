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

Ext.define('Traspac.components.field.GolDarah', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.goldarahfield',
  initComponent	: function() {
	
    this.callParent([arguments]);
	
	this.store = Ext.create('Ext.data.Store', {
		fields: ['ID', 'TEXT'],
		data : [
			{"ID":"A", "TEXT":"A"},
			{"ID":"B", "TEXT":"B"},
			{"ID":"AB", "TEXT":"AB"},
			{"ID":"O", "TEXT":"O"},
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
		return 'GOLDARAH';
	else return this.name;
  },
  
  getLabel:function(){
	if(this.label=='unknown')
		return 'Gol Darah';
	else return this.label;
  },
});