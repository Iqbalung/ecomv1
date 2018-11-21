/**
 * @class Traspac.components.field.Number
 * @extends Ext.form.field.Date
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component abstract Number for traspac application
 * This Number is created to be parent for field component. Example: PangkatField, AgamaField etc.
 * @params
 * The Abstract Number have been four service configs:
 * URL  		: setting url for data Number
 * fields  		: fields is name output data
 *  			  index 0 for valueField
 *  			  index 1 for displayField
 * name         : for this name component 
 * label        : for this label component 
 *
 * @event
 * This abstract add event like this:
 * afterload    : callback function if Number store was loaded
 * example      :
 *                listeners:{
 * 					
 *				      afterload:function(me){
 *							callAfterLoad();
 *					  }	
 *				 }
 **/

Ext.define('Traspac.components.field.Tanggal', {
	extend: 'Ext.form.field.Date',
	alias: 'widget.tanggalfield',
	
	name:'TANGGAL',
	format:'d/m/Y',
	initComponents: function(config) {
		this.format=Traspac.Constants.DEFAULT_FORMAT_DATE;
		this.callParent([arguments]);
	},
  
});