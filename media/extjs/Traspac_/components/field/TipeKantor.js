/**
 * @class Traspac.components.field.TipeKantor
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component TipeKantor combo for traspac application
 * This TipeKantor combo is created to be input in application form
 **/

Ext.define('Traspac.components.field.TipeKantor', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.tipekantorfield',
  initComponent	: function() {
	
    this.callParent([arguments]);
	
	this.store = Ext.create('Ext.data.Store', {
		fields: ['ID', 'TEXT'],
		data : [
			{"ID":"A", "TEXT":"A"},
			{"ID":"B", "TEXT":"B"},
			{"ID":"C", "TEXT":"C"}
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
		return 'TIPEKANTOR';
	else return this.name;
  },
  
  getLabel:function(){
	if(this.label=='unknown')
		return 'Tipe Kantor';
	else return this.label;
  },
});