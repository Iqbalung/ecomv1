/**
 * @class Traspac.components.field.Eselon
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Eselon combo for traspac application
 * This Eselon combo is created to be input in application form
 **/

Ext.define('Traspac.components.field.Eselon', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.eselonfield',
  initComponent	: function() {
    this.callParent([arguments]);
  },
  getFields:function(){
	return ['ID','ESELON'];
  },
  getURL:function(){
	return Traspac.Constants.MASTER_URL+'/c_eselon/getCmbEselon';
  },
  getName:function(){
	if(this.name=='unknown')
		return 'ESELON';
	else return this.name;
  },
  getLabel:function(){
	if(this.label=='unknown')
		return 'Eselon';
	else return this.label;
  },
  
  root:'results'
});