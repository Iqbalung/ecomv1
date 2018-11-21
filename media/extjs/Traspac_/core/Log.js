/**
 * @class Traspac.core.Log
 * @extends Object
 * @autor Rizky Atmawijaya
 * @date Rabu, 16 Sep 2014
 *
 * Class for logging
 *
 **/

Ext.define("Traspac.core.Log",{
	extend 		: "Object",
	singleton	: true,
	log			: function(object){
		if(console){
			console.log(object);
		}
	}
});

Traspac.log = Traspac.core.Log.log;