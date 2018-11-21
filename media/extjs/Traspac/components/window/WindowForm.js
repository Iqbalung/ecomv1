/**
 * @class Traspac.components.window.WindowForm
 * @extends Ext.window.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @params [config.form] this a object form in WindowForm
 *
 * @Description
 * Building component WindowForm for traspac application
 * This WindowForm is built by ....
 * This Class is created to be component for Window Form CRUD proses. like form adding or updating proses
 *
 *
 **/

Ext.define("Traspac.components.window.WindowForm",{

	alternateClassName	: "Traspac.WindowForm" ,
	
	extend				: "Ext.panel.Panel",
	
	alias				: 'widget.windowform',
	
	config:{
		form			:	null,
		fields			:	null,
		url				:	null,
		labelWidth		:	100,
		showNotif		:true
	},
	
	closeAction:'destroy',
	
	textSimpan:'Simpan',
	
	bbar: [],
	
	textBatal:'Batal',
	
	saveQuestion: false,
	
	saveQuestionText: 'Apakah anda yakin?',
	
	infoValid: 'Isi data dengan benar',
	
	frame: false,
	
	floating: true,
	
	bodyPadding: 10,
	
	resizable  : true,
	
	closable : true,
	
	draggable : true,
	
	modal: true,
	
	autoScroll:true,
	
	scroller:true,
	
	initComponent	: function(config) {
		
		var me=this;
		this.addEvents({
			"batal"			: true,
			"simpan"		: true,
			"success"		: true
		});
		
		me.addListener('hide', function(){
			me.down('form').getForm().reset();
		});
		
		me.initConfig(config);
		me.form=Ext.create('Traspac.abstract.Form',{
			autoHeight:true,
			defaults:{
				labelWidth:me.labelWidth,
				anchor:'100%',
			},
			width:500,
			items:me.fields
		});

		me.layout='fit';
		me.border=false;
		me.items=[
			me.form
		];
		
		if(me.bbar.length==0){
			me.bbar=['->',{
				xtype:'button',
				hidden : me.hiddenSimpan,
				text:me.textSimpan,
				//iconCls:'simpan',
				itemId:'simpan',
				handler:function(){
					me.onSimpan();
				}
			},{
				xtype:'button',
				text:me.textBatal,
				//iconCls:'batal',
				itemId:'batal',
				handler:function(){
					me.onBatal();
				}
			}];
		}
		
		
		me.callParent([arguments]);
		
	},
	
	buildForm:function(){
		
	},
	
	onBatal:function(){
		this.fireEvent('batal',this);
		if(this.closeAction=='destroy'){
			this.destroy();	
		}else
			this.hide();	
	},
	
	onSimpan:function(){
		var me=this;
		var form =me.form;
		if(form.getForm().isValid()){
			if(me.saveQuestion==true){
				Ext.Msg.show({
					title:'Perhatian',
					msg: me.saveQuestionText,
					buttonText: {
						yes: 'Ya', no: 'Tidak'
					},
					buttons: Ext.Msg.YESNO,
					fn: function (btn){
						if(btn == 'yes'){
							me.sendData();
						}
					}
				});
			} else {
				me.sendData();
			}
		} else {
			Traspac.Msg.info(me.infoValid);
		}
		
	},
	
	sendData: function(){
		var me=this;
		var form =me.form;
		form.getForm().submit({
			url: me.url,
			waitTitle:'Menyimpan...', 
			waitMsg:'Sedang menyimpan data, mohon tunggu...',
			success: function(data,e) {
				me.onSukses(data,e);
				if(me.closeAction=='destroy'){
					me.destroy();	
				}else
					me.hide();
			},
			failure: function(form, action) {
					switch (action.failureType) {
						case Ext.form.action.Action.CLIENT_INVALID:
							Traspac.Msg.alert('Harap isi semua data');
							break;
						case Ext.form.action.Action.CONNECT_FAILURE:
							Traspac.Msg.alert('Terjadi kesalahan');
							break;
						case Ext.form.action.Action.SERVER_INVALID:
							Traspac.Msg.alert(action.result.message);
				   }
			}
		});
	},
	
	onDestroy:function(){
		this.form.destroy();
		this.callParent([arguments]);
	},
	
	
	onSukses:function(data,e){
		if(this.showNotif)
			Traspac.Msg.success("Berhasil disimpan");
		this.fireEvent('success',data,e);

	}
});