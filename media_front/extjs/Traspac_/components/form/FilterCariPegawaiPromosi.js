/**
 * @class Traspac.components.form.FilterCariPegawaiPromosi
 * @extends Traspac.abstract.Form
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component FilterCariPegawaiPromosi for traspac application
 * This FilterCariPegawaiPromosi is created to be filter input for window.CariPegawai. 
 *
 **/

Ext.define("Traspac.components.form.FilterCariPegawaiPromosi",{
	extend		: "Traspac.abstract.Form",
	alias: 'widget.FilterCariPegawaiPromosi',
	
	initComponent	: function(a) {
		var me=this;
		
		me.addEvents({
			"clickcari"	: true
		});
		
		this.items=[{
                xtype: 'fieldcontainer',
                msgTarget 	: 'side',
                layout		: 'hbox',
                items		: [
					{
						xtype: 'checkcombo',
						itemId	: 'organisasi',
						width      : 350,
						margin	   : '0 10 0 0',
						store: Ext.create('Ext.data.Store',{
							fields: ['jenisid','jenis'],
							data: [
								{"jenisid":'1', "jenis":"Seluruh Instansi"},
								{"jenisid":'2', "jenis":"Satker dan Sub Satker dibawahnya"},
								{"jenisid":'3', "jenis":"Non Job Sementara"}
								//{"jenisid":'4', "jenis":"Pernah Non Job"}
							]
						}),
						displayField: 'jenis', queryMode: 'local',
						valueField: 'jenisid',
						name: 'organisasi[]',
						emptyText:'Organisasi...',
						fieldLabel:'Organisasi',
						listeners: {
							select: function(combo, rec, e){
							}
						}
					},
					{
						xtype		: 'combo',
						hidden:true,
						itemId		: 'jenispromosi',
						width      	: 200,
						labelWidth	: 80,
						margin	   : '0 10 0 0',
						store: Ext.create('Ext.data.Store',{
							fields: ['jenisid','jenis'],
							data: [
								{"jenisid": '', "jenis":"Semua"},
								{"jenisid":'1', "jenis":"Rotasi"},
								{"jenisid":'2', "jenis":"Akan Pensiun"},
								{"jenisid":'3', "jenis":"Masa Jabatan"}
							]
						}),
						displayField: 'jenis', queryMode: 'local',
						valueField: 'jenisid',
						name: 'jenispromosi',
						emptyText:'Jenis Promosi',
						fieldLabel:'Jenis Promosi'
					},{
						xtype		: 'button',
						width		: 60,
						text		: 'Cari',
						handler		:function(){
							me.fireEvent("clickcari", me);
						}
					},
                ]
            }];
		this.callParent(arguments);
	}
	
	
});