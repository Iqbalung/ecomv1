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

Ext.define('Traspac.components.field.StatusPegawai', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.statuspegawaifield',
  
  config:{
	isFilter:false,
  },
  
  initComponent	: function() {
    this.callParent([arguments]);
  },
  getFields:function(){
	return ['ID','STATUS'];
  },
  getURL:function(){
	if(this.isFilter)
		return Traspac.Constants.MASTER_URL+'/c_status_pegawai/getStatusPegawaiFilter/';
	else
		return Traspac.Constants.MASTER_URL+'/c_status_pegawai/getStatusPegawai/';
  },
  getName:function(){
	if(this.name=='unknown')
		return 'STATUSPEGAWAI';
	else return this.name;
  },
  getLabel:function(){
	if(this.label=='unknown')
		return 'Status Pegawai';
	else return this.label;
  },
});