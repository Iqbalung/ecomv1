/**
 * @class Traspac.components.tree.UnitKerja
 * @extends Ext.tree.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component UnitKerja for traspac application
 * This UnitKerja is created to be show strukturals data unit with tree component. 
 *
 **/

Ext.define("Traspac.components.tree.UnitKerja",{
	extend		: "Traspac.abstract.Tree",
	alias: 'widget.treeunitkerja',
	
	mixins : {
		search:'Traspac.components.mixins.SearchProccess'
	},
	
	title			:'Unit Kerja',
	HISTORY_ID		:'',
	
	URL_SEARCH		:Traspac.MASTER_URL + '/c_unit_kerja/cari_id',
	
	fields:['id','text','eselonid','eselon','namajabatan','unitkerja','UK_ID','focus_node','kepala','nip'],
	initComponent	: function() {
		var me=this;
		me.tbar=[{
			xtype:'searchfield',
			width:'100%',
			listeners:{
				search:function(val){
					var tree=me;
					if(!tree.store.isLoading()){
						tree.key=val;
						tree.mixins.search.initSearch.call(tree);
					}
				},
				reset:function(val){
					var tree=me;
					if(!tree.store.isLoading()){
						tree.key="";
						tree.mixins.search.initSearch.call(tree);
					}
				}
			}
			
		}];
		this.callParent([arguments]);
	},
	getIdroot:function(){
		return '0';
	},
	getURL:function(){
		if (this.URL=='unknown' || !this.URL)
			return Traspac.Constants.MASTER_URL+'/c_unit_kerja/get_tree_satker';
		else{
			return this.URL;
		}
	},
	getColumns:function(){
		if(this.columns=='unknown')
			return [{
				xtype: 'treecolumn', 
				text: 'Unit Kerja',
				flex:1,
				sortable: true,
				dataIndex: 'text',
			}];
		else return this.columns;
	},
	
	onBeforeLoaded:function(s){		
		s.proxy.extraParams.HISTORY_ID=this.HISTORY_ID;
		s.proxy.extraParams.modulname=Traspac.module_name;
	},
	
	autoNodeFocus:function(s,record,succeses,me){
		var focus_node=record.get('focus_node');
		
		if(focus_node)
			if(focus_node.length==2){
				var bool=record.get('id').length==focus_node.length;
			}else{
				var bool=record.get('id').length<focus_node.length;
			}
		
		if(s.getNodeById(focus_node) && bool ){
			var node = s.getNodeById(focus_node);
			//me.fireEvent('itemclick',s, record, this);
			var c={data:{id:focus_node},get:function(id){return this.data[id];}};
			this.events.itemclick.listeners[0].fn(s, c);

			this.getSelectionModel().select([node]);
			
		}
	},
	setFocus:function(from,id,callback){
		Ext.Ajax.request({
			url: Traspac.MASTER_URL + '/c_unit_kerja/set_detail_session',
			params: {
				from: from,
				treesatker: id,
				modulname:Traspac.module_name,
			},
			method: 'POST',
			success: function(){
				if(callback)
					callback();
			}
		});
	}
	
});