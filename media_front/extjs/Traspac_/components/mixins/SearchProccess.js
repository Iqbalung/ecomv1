/**
 * @class Traspac.components.mixins.SearchProccess
 * @extends Object
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Plugins SearchProccess mixins to use as proses searching
 **/

Ext.define('Traspac.components.mixins.SearchProccess', {

	key:'',
	url:'',
	
	
	/**
	* Initialize proses searching to collective ID macth with keyword
	*/
	initSearch:function(){
		var me=this;
		
		if(me.key.trim()==''){
			
			me.store.proxy.extraParams.FILTER_KEY='';
			me.store.proxy.extraParams.KEY='';
			me.store.load();
			return ;
		}
		
		var r=me.getSelectionModel().getSelection();
		if(r.length>0){
			me.SCOPE_PENCARIAN=r[0].get('id');
		}
		
		Traspac.Ajax.request({
			url		: me.URL_SEARCH,
			scope	: me,
			params	: {key:me.key, idroot: me.idroot||'',SCOPE_PENCARIAN:me.SCOPE_PENCARIAN||''},
			success	: function(data){
				if(data.data.length>100){
					Traspac.Msg.alert("Terlalu banyak hasil pencarian. Ada "+data.data.length+' hasil pencarian.<br/>Gunakan kata kunci yang lebih spesifik atau filter berdasarkan data tree yang dipilih ');
						return ;
				}
					me.searching(data.data);
			},
			failure	: Traspac.onErrorAlert
		});
	},
	
	/**
	* Search proses on tree model
	*/
	
	searching:function(data){
		var me=this;
		me.store.proxy.extraParams.FILTER_KEY	=	Ext.encode(data);
		me.store.proxy.extraParams.KEY			=	me.key;
		
		me.collapseAll(function(){
			me.getSelectionModel().select(me.getRootNode());
			me.store.load({callback:function(){
					me.getRootNode().expand();
				}
			});
		});

	},
  
  
});