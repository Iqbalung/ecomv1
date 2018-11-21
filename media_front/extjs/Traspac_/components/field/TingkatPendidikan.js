/**
 * @class Traspac.components.field.TingkatPendidikan
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component TingkatPendidikan combo for traspac application
 * This TingkatPendidikan combo is created to be input in application form
 **/

Ext.define('Traspac.components.field.TingkatPendidikan', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.tingkatpendidikanfield',
  initComponent	: function() {
    this.callParent([arguments]);
  },
  getFields:function(){
	return ['PENDIDIKANID','PENDIDIKAN'];
  },
  getURL:function(){
	return Traspac.Constants.MASTER_URL+'/c_pendidikan/getTingkatPendidikan';
  },
  getName:function(){
	if(this.name=='unknown')
		return 'TINGKATPENDIDIKAN';
	else return this.name;
  },
  getLabel:function(){
	return this.label;
  },
});