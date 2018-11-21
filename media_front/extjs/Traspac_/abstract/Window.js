/**
 * @class Traspac.ui.ModalPanel
 * @extends Ext.Panel
 * @autor Rizky Atmawijaya
 * @date Rabu 16 Sep 2014 10 16:29:08 
 *
 * A modal panel that appears in top of everything
 *
 **/

Ext.define("Traspac.abstract.Window",{
	extend 			: "Ext.window.Window",
	
	closeAction		:'destroy',
	layout			: "fit",
	cls				: "traspac-window",
	modal			: true,
	resizable		: true,
	bodyPadding		: 10,
});