/**
 * @class Traspac.components.window.MessageBox
 * @extends Ext.Msg
 * @autor Rizky Atmawijaya
 * @date 17 Sep 2014 10:15:49
 *
 * Description
 *
 *
 **/

Ext.define("Traspac.components.window.MessageBox",{
	extend 				: "Ext.window.MessageBox",
	alternateClassName	: "Traspac.Msg",
	singleton			: true,
	
	alert	: function(message){
		this.show({
			title	: "Perhatian",
			modal	: true,
			icon	: Ext.Msg.WARNING,
			buttons	: Ext.Msg.OK,
			msg		: message
		});
	},
	
	info	: function(message){
		this.show({
			title	: "Informasi",
			modal	: true,
			icon	: Ext.Msg.INFO,
			buttons	: Ext.Msg.OK,
			msg		: message
		});
	},
	
	success	: function(message){
		this.show({
			title	: "Sukses",
			modal	: true,
			icon	: 'x-message-box-success',
			buttons	: Ext.Msg.OK,
			msg		: message
		});
	},
	
	error	: function(message){
		this.show({
			title	: "Kesalahan",
			modal	: true,
			icon	: Ext.Msg.ERROR,
			buttons	: Ext.Msg.OK,
			msg		: message
		});
	},
	
	warning	: function(message){
		this.show({
			title	: "Peringatan",
			modal	: true,
			icon	: Ext.Msg.WARNING,
			buttons	: Ext.Msg.OK,
			msg		: message
		});
	},
	
	confirm	: function(message,callback,scope){
		this.show({
			title	: "Konfirmasi",
			modal	: true,
			icon	: Ext.Msg.QUESTION,
			buttonText: {
                yes: 'Ya', no: 'Tidak'
            },
			buttons	: Ext.Msg.YESNO,
			msg		: message,
			fn		: callback || Ext.emptyFn,
			scope	: scope || this
		});
	}
	
});