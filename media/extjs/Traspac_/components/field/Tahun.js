/**
 * @class Traspac.components.field.Tahun
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component Tahun combo for traspac application
 * This Tahun combo is created to be input in application form
 **/

Ext.define('Traspac.components.field.Tahun', {
	extend: 'Ext.form.field.Number',

	alias: 'widget.tahunfield',
  
	fieldLabel:'Tahun',
	name:'TAHUN',
	width:180,
	initComponent	: function() {
		this.maxLength=4;
		this.minValue=1900;
		this.maxValue=3000;
		this.callParent([arguments]);
	},
});