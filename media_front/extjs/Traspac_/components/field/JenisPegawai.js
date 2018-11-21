/**
 * @class Traspac.components.field.Jenis Pegawai
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Jenis Pegawai combo for traspac application
 * This Jenis Pegawai combo is created to be input in application form
 **/

Ext.define('Traspac.components.field.JenisPegawai', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.jenispegawaifield',
  initComponent	: function() {
    this.callParent([arguments]);
  },
  getFields:function(){
	return ['ID','JENIS'];
  },
  getURL:function(){
	return Traspac.Constants.MASTER_URL+'/c_jenis_pegawai/getJenisPegawai';
  },
  getName:function(){
	if(this.name=='unknown')
		return 'JENISPEGAWAI';
	else return this.name;
  },
  getLabel:function(){
	if(this.label=='unknown')
		return 'Jenis Pegawai';
	else return this.label;
  },
});