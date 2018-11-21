/**
 * @class Traspac.components.field.Pangkat
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Pangkat combo for traspac application
 * This Pangkat combo is created to be input in application form
 **/

Ext.define('Traspac.components.field.Pangkat', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.pangkatfield',
  
  config:{
	onlyCode:false,
  },
  
  initComponent	: function(a) {
    this.callParent([arguments]);
  },
  getFields:function(){
	return ['ID','PANGKAT','KODEPANGKAT','PANGKATTEXT'];
  },
  getURL:function(){
	if(this.onlyCode)
		return Traspac.Constants.MASTER_URL+'/c_pangkat/getPangkatCombo/onlyCode';
	else
		return Traspac.Constants.MASTER_URL+'/c_pangkat/getPangkatCombo';
  },
  getName:function(){
	if(this.name=='unknown')
		return 'PANGKAT';
	else return this.name;
  },
  getLabel:function(){
	if(this.label=='unknown')
		return 'Pangkat';
	else return this.label;
  },

});