/**
 * @class Traspac.components.form.Fitur
 * @extends Traspac.abstract.Form
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component Fitur for traspac application
 * This Fitur is created to be filter input for window.CariPegawai. 
 *
 **/

Ext.define("Traspac.components.button.Fitur",{
	extend		: "Ext.button.Button",
	alias		: 'widget.buttonfitur',
	
	alternateClassName: ['Traspac.components.button.Fitur', 'Traspac.button.Fitur'],
   
	requires: ['Traspac.securities.HakAkses'],
	
	mixins: {
        checkFiturSecurities: 'Traspac.securities.HakAkses'
    },
	
	config:{
		fiturId:'unknown',
	},
	
	initComponent	: function(a) {
		var me=this;

		me.initConfig(a);
		
		//if tidak memiliki fitur maka di hidden
		me.checkFiturSecurities(me,this.fiturId);
		
		me.callParent(arguments);
	},
	
	
/**
 *
 * automatically checks if the user has fitur
 *
 **/
	
});