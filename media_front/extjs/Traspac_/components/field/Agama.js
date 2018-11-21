/**
 * @class Traspac.components.field.Agama
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Agama combo for traspac application
 * This Agama combo is created to be input in application form
 **/

Ext.define('Traspac.components.field.Agama', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.agamafield',
  initComponent	: function() {
    this.callParent([arguments]);
  },
  getFields:function(){
	return ['ID','AGAMA'];
  },
  getURL:function(){
	return Traspac.Constants.MASTER_URL+'/c_agama/getAgamaCombo';
  },
  getName:function(){
	if(this.name=='unknown')
		return 'AGAMA';
	else return this.name;
  },
  getLabel:function(){
	if(this.label=='unknown')
		return 'Agama';
	else return this.label;
  },

});