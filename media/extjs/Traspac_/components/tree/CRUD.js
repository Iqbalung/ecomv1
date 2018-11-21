/**
 * @class Manjab.components.Tree
 * @extends Traspac.abstract.Tree
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component manjab_treejabatan for traspac application
 * This manjab_treejabatan is created to be show strukturals data unit with tree component. 
 *
 **/

Ext.define("Traspac.components.tree.CRUD",{
	extend		: "Traspac.abstract.Tree",
	alias		: 'widget.treecrud',
	
	mixins : {
		search:'Traspac.components.mixins.SearchProccess',
		proccessTree:'Traspac.components.mixins.TreeProccess',
	},
	
	fields:['id','text','JOBGRADE','WARNA','BUP','JENIS','UK_ID','FN_ID','KODE','HISTORY_ID','ID','MAP_ID','TIPEJAB'],
	
	isCRUD			:true,
	idroot			:'0',
	isHiddenDetail	:false,
	isHiddenTambah	:false,
	isHiddenAction	:false,
	isHiddenUbah	:false,
	useArrows		:true,
	unselect		:[],
	getChecked: function( prop ){
        var prop = prop || null;
        var checked = [];

        this.getView().getTreeStore().getRootNode().cascadeBy(function(node){
           if( node.data.checked ){
                if( prop && node.data[prop] ) checked.push(node.data[prop]);
                else checked.push(node);
           }
        });

        return checked;
    },
	
	initComponent	: function() {
		var me=this;
	
		this.stripeRows= true;
		
		if(this.isCRUD==false){
			this.isHiddenUbah		= true;
			this.isHiddenTambah		= true;
			this.isHiddenHapus		= true;
			if(this.URL=='unknown')
				this.URL=this.crud.baca;
		}else if(this.crud){
			this.URL=this.crud.baca;
		}

		me.addListener('itemclick',function( self, record, item, index, eventObj, eOpts ) {
			
			var node=self.getTreeStore().getNodeById(record.internalId);
			if (eventObj.getTarget('.x-tree-checkbox',1,true)) {
				record.set('checked',!record.get('checked'));     
				console.log(record.get('checked'));				
				if(!record.get('checked')){
					count=0;
					for (ui in me.unselect){
						if(me.unselect[ui]==record.get('id')){
							count++;
						}
					}
					if(count==0)
						me.unselect.push(record.get('id'));
				}
			}
			
		});
		
		if(me.isCRUD===true){
			var rowEditing = Ext.create('Ext.grid.plugin.RowEditing', {
				listeners: {
					cancelEdit: function(rowEditing, context) {
						me.onBatal(rowEditing, context);
					},
					'beforeedit': function(editor,context) {
						
						var flag=me.onBeforeEdit(editor, context);
						
						if(flag===false){
							return false;
						}
					
						return me.isCRUD;
					},
					edit:function(editor, context){
						
						var rootNode = me.getSelectionModel().getSelection()[0];
						
						me.onSimpan(editor, context,rootNode);
						
					
					}
				}
			});
		
			this.plugins= [rowEditing];
		}
		
		this.callParent([arguments]);
	},
	
	getIdroot:function(){
		return this.idroot;
	},
	
	getTextroot:function(){
		return this.textroot;
	},
	
	getURL:function(){
		
		return this.URL;
	},
	
	getTitle:function(){
		if(this.title=='unknown')
			return 'Unit Kerja';
		else return this.title;
	},
	
	getColumns:function(){
	
		var me =this;
		
		
		var action=me.getAction();
		
		if(!me.isHiddenAction){
			this.columns.push({
				xtype:'actioncolumn',
				itemId:'action',
				width:50,
				menuDisabled: true,
				items:action,
			});
		}
			
		return this.columns;
			
		
	},
	
	getUnchecked:function(){
		var datas=[];
		var select=this.getChecked('id');
		for( up in this.unselect){
			count=0;
			for (down in select){
				if(this.unselect[up]==select[down]){
					count++;
				}
			}
			if(count==0)
				datas.push(this.unselect[up]);
		}
		
		return datas;
	}
	
	
});