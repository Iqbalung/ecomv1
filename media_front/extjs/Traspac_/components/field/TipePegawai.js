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

Ext.define('Traspac.components.field.TipePegawai', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.tipepegawaifield',
  
  config:{
	isFilter:false,
  },
  
  initComponent	: function() {
    this.callParent([arguments]);
  },
  getFields:function(){
	return ['ID','TIPE'];
  },
  getURL:function(){
	if(this.isFilter)
		return Traspac.Constants.MASTER_URL+'/c_tipe_pegawai/getTipePegawaiFilter/';
	else
		return Traspac.Constants.MASTER_URL+'/c_tipe_pegawai/getTipePegawai/';
  },
  getName:function(){
	if(this.name=='unknown')
		return 'TIPEPEGAWAI';
	else return this.name;
  },
  getLabel:function(){
	if(this.label=='unknown')
		return 'Tipe Pegawai';
	else return this.label;
  },
});