Ext.define("Traspac.components.panel.AppNoModule",{
	extend		: "Ext.panel.Panel",
	alternateClassName	: "Traspac.AppNoModule" ,  
	alias: 'widget.content_no_module',		
	initComponent	: function(a) {
		var me = this;		
		Ext.apply(me,{
			layout: 'anchor',
			items: [
				{					
					xtype: 'panel',
					layout: 'fit',
					height: 400,
					bodyPadding: 15,
					html: '<b>Anda Tidak Mempunyai Hak Akses ke Halaman ini</b>',
				}
			]
		});
		me.callParent([arguments]);		
	},
});