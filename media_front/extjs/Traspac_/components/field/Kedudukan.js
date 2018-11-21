/**
 * @class Traspac.components.field.Bank
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Bank combo for traspac application
 * This Bank combo is created to be input in application form
 **/

Ext.define('Traspac.components.field.Kedudukan', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.kedudukanfield',
  initComponent	: function() {
    this.callParent([arguments]);
  },
  getFields:function(){
	return ['ID','KEDUDUKAN'];
  },
  getURL:function(){
	return Traspac.Constants.MASTER_URL+'/c_kedudukan/getKedudukan';
  },
  getName:function(){
	if(this.name=='unknown')
		return 'KEDUDUKAN';
	else return this.name;
  },
  getLabel:function(){
	if(this.label=='unknown')
		return 'Kedudukan';
	else return this.label;
  },
});