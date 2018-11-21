/**
 * @class Traspac.components.field.JenisKenaikanGaji
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component JenisKenaikanGaji combo for traspac application
 * This JenisKenaikanGaji combo is created to be input in application form
 **/

Ext.define('Traspac.components.field.JenisKenaikanGaji', {
  extend: 'Traspac.abstract.Combo',
  alias: 'widget.jeniskenaikangajifield',
  initComponent	: function() {
    this.callParent([arguments]);
  },
  getFields:function(){
	return ['ID','KENAIKAN'];
  },
  getURL:function(){
	return Traspac.MASTER_URL+'/c_jenis_kp/getJenisKenaikan';
  },
  getName:function(){
	if(this.name=='unknown')
		return 'Jenis Kenaikan Gaji';
	else return this.name;
  },
  getLabel:function(){
	return this.label;
  },
});