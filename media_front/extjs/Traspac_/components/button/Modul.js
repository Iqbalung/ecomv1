/**
 * @class Traspac.components.button.Fitur
 * @extends Ext.button.Button
 * requires 
 * @autor Saifulloh Rifai
 * @date Senin, 10/11/2014
 *
 * @Description
 * Building component to create link for all Modul in traspac application
 *
 **/

Ext.define("Traspac.components.button.Modul",{
	extend		: "Ext.button.Button",
	alias		: 'widget.buttonModul',
	
	alternateClassName: ['Traspac.components.button.Modul', 'Traspac.button.Modul'],
   	
	initComponent	: function(a) {
		var me=this;
		me.callParent(arguments);
	},		
	iconCls :'icon_modul', scale:'large', text :'Modul', plain: true, style: 'background-color: transparent; background-image: none; border: none;',
	menu :[
			{	
				xtype :'panel', width:250,height:'auto',
				items :[
						Ext.create('Ext.view.View', {
								store: Ext.create('Ext.data.Store', {
									fields: ['MODULID','MODUL','URL_IMAGE','URL_MODUL','LONG_NAME'],
									autoLoad:true,
									proxy: {
										type: 'ajax',
										url: Traspac.BASE_URL+'index.php/app/get_modul',
										reader: {
											type: 'json',
											root: 'data'
										}
									}
								}),	//'<div style="margin:auto;text-transform: uppercase;">{MODUL}</div>',
								tpl: [
									'<div style="text-align:left;margin:10px">',
									'<tpl for=".">',
										'<div style="display:inline-block;margin:5px;padding:5px;background:#EAEAEA;">',
											'<a href="{URL_MODUL}" ><img style="width:50px" src="{URL_IMAGE}" title="{LONG_NAME}"></a>',											
										'</div>',
									'</tpl>',
									'</div>',
									'<div class="x-clear"></div>'
								],
								trackOver: true,
								itemSelector: 'div.thumb-wrap',
								overItemCls: 'x-item-over',
								emptyText: 'No images to display',
							})
						]
			}
		]
/**
 *
 * 
 *
 **/
	
});