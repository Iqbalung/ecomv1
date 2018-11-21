/**
 * @class Traspac.components.field.TingkatPendidikan
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Ary Kurniadi
 * @date 26 Agustus  2015, 01:10:24 WIB
 *
 * @Description
 * Building component SearchUniversitas
 * Example:
	Ext.create('searchuniversitas',{
		fieldLabel: 'Universitas',
		name: 'UNIVERSITAS',
		listeners: {
			select: function(c,r,e){
				console.log(r);
			}
		},												
	 
	})
 **/

Ext.define('Traspac.components.field.SearchUniversitas', {
	extend: 'Traspac.abstract.Combo',
	method: 'GET',
	alias: 'widget.searchuniversitas',	
	initComponent: function(){
		var me = this;		
		Ext.apply(me,{
			listConfig: {
				loadingText: 'Sedang mencari ...',
				emptyText: 'Tidak ada data',
				getInnerTpl: function() {
					return '<a><span>{'+me.getFields()[1]+'}</span>' + '</a>';
				}
			},
			totalProperty: 'total',
			root: 'data',
			isLoad: false,
			queryMode: 'remote',
			minChars: 1,
			pageSize: 10, 
			forceSelection: true, 
			typeAhead: false,
			trigger1Cls: Ext.baseCSSPrefix + 'form-search-trigger',			
			displayField: 'UNIVERSITAS',
			enableKeyEvents:true,
			valueField: 'UNIVERSITASID'												
		});
		this.callParent([arguments]);
	},
	getFields:function(){
		return ['UNIVERSITASID','UNIVERSITAS'];
	},
	getURL:function(){
		return Traspac.Constants.MASTER_URL+'/c_universitas/getListUniversitas';
	},
	getName:function(){
		if(this.name=='unknown')
			return 'TINGKATPENDIDIKAN';
		else return this.name;
	},
	getLabel:function(){
		return this.label;
	},
});