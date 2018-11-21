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

Ext.define('Traspac.components.field.Bulan', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.bulanfield',
  
  emptyText: 'Bulan',
  initComponent	: function() {
	
    this.callParent([arguments]);
	this.forceSelection= true;
	this.queryMode= 'local';
	this.store =new Ext.data.Store({
		fields: ['name', 'num'],
		data: (function() {
			var data = [];
				Ext.Array.forEach(Ext.Date.monthNames, function(name, i) {
				data[i] = {name: name, num: i + 1};
			});
			return data;
		})()
	});
  },
  
  getFields:function(){
	return ['num','name'];
  },
  
  getURL:function(){
	return null;
  },
  
  getName:function(){
	if(this.name=='unknown')
		return 'BULAN';
	else return this.name;
  },
  
  getLabel:function(){
	if(this.label=='unknown')
		return 'Bulan';
	else return this.label;
  },
});