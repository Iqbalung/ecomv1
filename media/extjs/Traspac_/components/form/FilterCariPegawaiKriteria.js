/**
 * @class Traspac.components.form.FilterCariPegawaiKriteria
 * @extends Traspac.abstract.Form
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component FilterCariPegawaiKriteria for traspac application
 * This FilterCariPegawaiKriteria is created to be filter input for window.CariPegawai. 
 *
 **/

Ext.define("Traspac.components.form.FilterCariPegawaiKriteria",{
	extend		: "Traspac.abstract.Form",
	alias: 'widget.filtercaripegawaikriteria',
	
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
						xtype		: 'eselonfield',
						label		:'Eselon',
						width		: 260,
						name		: 'eselon',
						margin	   : '0 10 0 0',
						itemId		: 'eselon'
					},{
						xtype		: 'combo',
						itemId		: 'jenisjabatan',
						width      	: 230,
						labelWidth	: 80,
						margin	   : '0 10 0 0',
						store: Ext.create('Ext.data.Store',{
							fields: ['jenisid','jenis'],
							data: [
								{"jenisid":'0', "jenis":"Semua"},
								{"jenisid":'1', "jenis":"Pernah Menduduki"},
								{"jenisid":'2', "jenis":"Sedang Menduduki"}
							]
						}),
						displayField: 'jenis', queryMode: 'local',
						valueField: 'jenisid',
						name: 'jenisjabatan',
						emptyText:'Jenis Jabatan',
						fieldLabel:'Jenis Jabatan'
					},{
						xtype		: 'button',
						width		: 60,
						text		: 'Cari',
						handler		:function(){
							me.fireEvent("clickcari", me);
						}
					},
                ]
            },
            {
                xtype: 'fieldcontainer',
                msgTarget : 'side',
                layout: 'hbox',
                items: [{
                        xtype      : 'diklatfield',
						jenis	   : 'STRUKTURAL',
						fieldLabel : 'Diklat Pimpinan',
                        name       : 'diklatpimpinan',
						itemId     : 'diklatpimpinan',
						margin	   : '0 10 0 0',
						width      : 350,
						listeners  : {
							change:function(val){
							}
						},
                    },{
						xtype       : 'pangkatfield',
						onlyCode  :true,
						width		: 260,
						fieldLabel  : 'Gol',
                        name        : 'golongan',
						itemId      : 'golongan',
						margin	   : '0 10 0 0',
						inputValue	: '1'
					},{
						xtype		: 'textfield',
						width		: 230,
						labelWidth	: 80,
						fieldLabel  : 'Jabatan',
						name		: 'jabatan',
						itemId		: 'jabatan'
					}
                ]
            },
            {
                xtype: 'fieldcontainer',
                msgTarget : 'side',
                layout: 'hbox',
                items: [{
                        xtype      : 'tingkatpendidikanfield',
						fieldLabel : 'Pendidikan',
                        name       : 'pendidikan',
						itemId     : 'pendidikan',
						margin	   : '0 10 0 0',
						width      : 350
                    },{
						xtype      : 'jurusanfield',
						width		: 260,
						fieldLabel : 'Jurusan',
                        name       : 'jurusan',
						itemId     : 'jurusan',
						inputValue	: '1',
						listeners :{
							click:function(val,m){
                                   m.PENDIDIKANID=me.down('#pendidikan').getValue();
                            },
                            focus :function(val,m){
                                   m.PENDIDIKANID=me.down('#pendidikan').getValue();
                            }
						}
					}
                ]
            }];
		this.callParent(arguments);
	}
	
	
});