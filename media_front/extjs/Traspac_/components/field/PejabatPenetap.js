/**
 * @class Traspac.components.field.PejabatPenetap
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component PejabatPenetap combo for traspac application
 * This PejabatPenetap combo is created to be input in application form
 **/

Ext.define('Traspac.components.field.PejabatPenetap', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.pejabatpenetapfield',
  
  
  initComponent	: function(a) {
    this.initConfig(a);
	this.callParent([arguments]);
  },
  getFields:function(){
	return ['PEJABATPENETAPID','JABATAN'];
  },
  getURL:function(){
	return Traspac.Constants.MASTER_URL+'/c_pejabat_penetap/get_pejabat_penetap';
  },
  getName:function(){
	if(this.name=='unknown')
		return 'PENETAP';
	else return this.name;
  },
  getLabel:function(){
	if(this.label=='unknown')
		return 'Pejabat Penetap';
	else return this.label;
  },
  getRoot:function(){
	return 'results';
  }
});