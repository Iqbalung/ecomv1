/**
 * @class Traspac.components.field.KelasJabatan
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component KelasJabatan combo for traspac application
 * This KelasJabatan combo is created to be input in application form
 **/

Ext.define('Traspac.components.field.KelasJabatan', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.kelasjabatanfield',
  
  initComponent	: function() {
    this.callParent([arguments]);
  },
  getFields:function(){
	return ['GRADE','GRADE','TUNJANGAN'];
  },
  getURL:function(){
	return Traspac.MANJAB_URL+'/master/c_kelas_jabatan/get';
  },
  getName:function(){
	if(this.name=='unknown')
		return 'KELASJABATAN';
	else return this.name;
  },
  getLabel:function(){
	if(this.label=='unknown')
		return 'Kelas Jabatan';
	else return this.label;
  },

});