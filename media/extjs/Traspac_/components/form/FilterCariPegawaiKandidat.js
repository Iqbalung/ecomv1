/**
 * @class Traspac.components.form.FilterCariPegawaiKandidat
 * @extends Traspac.abstract.Form
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component FilterCariPegawai for traspac application
 * This FilterCariPegawai is created to be filter input for window.CariPegawai. 
 *
 **/

Ext.define("Traspac.components.form.FilterCariPegawaiKandidat",{
	extend		: "Traspac.abstract.Form",
	alias: 'widget.filtercaripegawaikandidat',
	
	initComponent	: function(a) {
		var me=this;
		
		me.addEvents({
			"clickcari"	: true
		});
		
		this.items=[
			{
				xtype: 'fieldcontainer',
                msgTarget : 'side',
                layout: 'hbox',
				items:[{
					xtype: 'fieldcontainer',
					flex:1,
					height:100,
					layout:'form',
					margins:'0 10 0 0',
					items:[{
						xtype: 'fieldcontainer',
						msgTarget : 'side',
						layout: 'hbox',
						items: [
							 {
								xtype		: 'checkbox',
								width		: 50,
								name		: 'cek_nip',
								itemId		: 'cek_nip',
								inputValue	: '1'
							},
							{
								xtype      : 'textfield',
								fieldLabel : 'NIP',
								name       : 'nip',
								itemId     : 'nip',
								//flex	   : 1,
								width      : 350,
								listeners  : {
									change:function(val){
										me.checkAuto ({
											id				:'cek_nip',
											field			:this.getValue()
										});
									}
								},
								margin	   : '0 10 0 0'
							}
						]
					},
					{
						xtype: 'fieldcontainer',
						msgTarget : 'side',
						layout: 'hbox',
						items: [
							 {
								xtype		: 'checkbox',
								width		: 50,
								name		: 'cek_nama',
								itemId		: 'cek_nama',
								inputValue	: '1'
							},
							{
								xtype      : 'textfield',
								fieldLabel : 'Nama',
								name       : 'nama',
								itemId     : 'nama',
								margin	   : '0 10 0 0',
								//flex	   : 1,
								width      : 350,
								listeners  : {
									change:function(val){
										me.checkAuto ({
											id				:'cek_nama',
											field			:this.getValue()
										});
									}
								},
							}
						]
					},
					{
						xtype: 'fieldcontainer',
						msgTarget : 'side',
						layout: 'hbox',
						items: [
							 {
								xtype		: 'checkbox',
								width		: 50,
								name		: 'cek_umur',
								itemId		: 'cek_umur',
								inputValue	: '1'
							},
							{
								xtype      : 'numberfield',
								fieldLabel : 'Umur',
								hideTrigger:true,
								name       : 'umur1',
								itemId     : 'umur1',
								margin	   : '0 10 0 0',
								width	   : 160,
								listeners  : {
									change:function(val){
										me.checkAuto ({
											combineChecking :true,
											id				:'cek_umur',
											field1			:this.getValue() || '',
											field2			:this.up().down('#umur2').getValue() ||'',
										});
									}
								},
							},{
								xtype      : 'numberfield',
								fieldLabel : 's/d',
								hideTrigger:true,
								labelWidth : 30,
								name       : 'umur2',
								itemId     : 'umur2',
								margin	   : '0 10 0 0',
								//flex	   : 1,
								width	   : 100,
								listeners  : {
									change:function(val){
										me.checkAuto ({
											combineChecking :true,
											id				:'cek_umur',
											field1			:this.getValue()||'',
											field2			:this.up().down('#umur1').getValue()||'',
										});
										
									}
								},
							},{
								xtype		: 'label',
								margin	   : '0 0 50 0',
								width		: 70
							},
						]
					}]
				},{
					xtype: 'fieldset',
					width:300,
					title:'Asal',
					margins:'0 10 0 0',
					items:[{
						xtype: 'fieldcontainer',
						defaultType: 'checkboxfield',
						items: [
							{
								boxLabel   : 'Seluruh Instansi',
								name       : 'topping',
								checked    : true,
								inputValue : 1,
								itemId     : 'seluruh_instansi'
							}, {
								boxLabel   : 'Satker dan Sub Satker dibawahnya',
								name       : 'topping',
								inputValue : 2,
								itemId     : 'sub_instansi'
							}, {
								boxLabel   : 'Non Job Sementara',
								name       : 'topping',
								inputValue : 3,
								itemId     : 'non_job'
							}, {
								boxLabel   : 'Pernah Non Job',
								name       : 'topping',
								inputValue : 4,
								hidden	   :true,
								itemId     : 'pernah_non_job'
							}
						]
					}]
				},{
					xtype		: 'button',
					width		: 60,
					text		: 'Cari',
					margins		:'10 70 10 10',
					handler		:function(){
						me.fireEvent("clickcari", me);
					}
				}]
			}];
		this.callParent(arguments);
	},
	
	
	/**
	*
	* automatically checks if the field is filled.
	* This method contains configuration:
    * combineChecking	: if true then there checking field1 and field2.
    * Id				: itemId checkbox that will be checked automatically. 
	*
	**/
	
	checkAuto:function(config){
	
		if(config.combineChecking==true){
			
			if(config.field1==''||config.field2==''){
				this.down('#'+config.id).setValue(false);
			}else{
				this.down('#'+config.id).setValue(true);
			}
		
		}else{
			if(config.field.trim()==''){
				this.down('#'+config.id).setValue(false);
			}else{
				this.down('#'+config.id).setValue(true);
			}
		}
		
	}
});