/**
 * @class Traspac.ui.Form
 * @extends Ext.form.Panel
 * @autor Rizky Atmawijaya
 * @date Senin 10 Sep 2014
 *
 * Form panel
 *
 **/


Ext.define("Traspac.abstract.Form",{
	extend 			: "Ext.form.Panel",
	
	//columns			: 1,
	autoHeight		: true,
	border			: false,
	defaultType		: 'textfield',
	defaults: {
		anchor: '100%',
		labelWidth: 100
	},
	bodyPadding		: 5,
	//autoScroll		: true,

	initComponent	: function(){
		this.callParent([arguments]);
	}
});