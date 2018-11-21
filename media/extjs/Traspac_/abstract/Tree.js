/**
 * @class Traspac.abstract.Tree
 * @extends Ext.tree.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component abstract Tree for traspac application
 * This Tree is created to be parent for satker and jabatan tree component. Example: TreeJabatan, TreeUnitKerja etc.
 * The Abstract Tree have been three service configs:
 * URL  		: setting url for data combo
 * columns  	: fields is name output data
 *  			  index 0 for valueField
 *  			  index 1 for displayField
 * idroot       : for this id root tree 
 * textroot     : for this text root tree 
 * title        : for this title component 
 *
 **/

Ext.define("Traspac.abstract.Tree",{
	extend		: "Ext.tree.Panel",

	
	config:{
		idroot 	  	: 'unknown',
		URL 	  	: 'unknown',
		title 	  	: 'unknown',
		multiSelect	: true,         
		fields 		: 'unknown',
		columns 	: 'unknown',
		ismask 		: true,
		textroot 	: Traspac.NAMA_CLIENT,
		isLoad		: true,
	},
	method 		: 'POST',
	
	initComponent	: function(a) {
		var me = this;
		me.i=0;

		me.columns=me.getColumns();
		me.store=Ext.create('Ext.data.TreeStore',{
			fields: me.fields,
			autoLoad : me.isLoad,
			listeners : {
				beforeload : function(a,b,c){
					me.isloading=1;
					if(me.onBeforeLoaded)
						me.onBeforeLoaded(this,b,c);
					try{
						if(me.ismask && Ext.get(me.el)){
							me.mask = new Ext.LoadMask(Ext.get(me.el), {msg:'Mohon Tunggu...'});
							me.mask.show();
						}

						
					}catch (e){
						
					}
				},
				load:function(s,record,succeses){
					me.isloading=0;
					if(me.onAfterLoaded)
						me.onAfterLoaded(s,record,succeses,this);
					if(me.autoNodeFocus)
						me.autoNodeFocus(s,record,succeses,this);
					if(me.ismask){
						if(me.mask.hide)
							me.mask.hide();
					}
				}
			},
			proxy: {
				type: 'ajax',
				actionMethods: {
					create : me.method,
					read   : me.method,
				},
				url:me.getURL()
			},
			root: {
				text		: me.getTextroot(),
				iconCls 	:'rootnode',
				draggable	: false,
				id			: me.getIdroot(),
				expanded    : false
			}
		});
		
		me.autoScroll=true;
		me.callParent([arguments]);
	},
	
	listeners:{
			afterrender:function(){
				var me=this;
				if(me.ismask && Ext.get(me.el)){
					setTimeout(function(){
						me.mask = new Ext.LoadMask(Ext.get(me.el), {msg:'Mohon Tunggu...'});
						me.mask.show();
						
						setTimeout(function(){
							if(me.ismask){
								if(me.mask.hide && me.isloading==0)
									me.mask.hide();
							}
							},6000
						);
						
						},100
					);
				}
			}
	}
	
});