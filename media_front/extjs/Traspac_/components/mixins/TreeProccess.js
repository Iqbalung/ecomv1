/**
 * @class Manjab.modules.TreeProccess
 * @extends Traspac.abstract.Combo
 * requires 
 * @autor Rizky Atmawijaya
 * @date 17 Sep  2014, 01:10:24 WIB
 *
 * @Description
 * Building component TreeProccess combo for Traspac.application
 * This TreeProccess combo is created to be input in application form
 **/

Ext.define('Traspac.components.mixins.TreeProccess', {
	
	ID_IS		:'id',
	EXTRA_ID	:{id:'',value:''},
	isCRUD		:true,
	max_level	:100,
	
	constructor:function(){
		this.addEvents({
			'detail':true,
			'tambah':true,
			'hapus':true
		});
	},
	
	
	onTambah:function(record,rowIndex,me){
		me.fireEvent('tambah',me);
		
		if(record.get('LVL')>=me.max_level){
			return;
		}
		
		me.getSelectionModel().select(rowIndex);  
		var rootNode = me.getSelectionModel().getSelection()[0];
		
		
		if(!rootNode.isExpanded()){
			rootNode.expand(false, function(oChildren) {
				rootNode.insertChild(0,{ID:rootNode.get('id'),HISTORY_ID:me.HISTORY_ID,TAHUN:rootNode.get('TAHUN'),ISUBAH:true}); 
				me.getSelectionModel().select(rowIndex+1);  
				var rec=me.getSelectionModel().getSelection()[0];
				
				
				
				
				
				var editor = me.plugins[0];
				editor.startEdit(rec,0);
				setTimeout(function(){
					me.getSelectionModel().select(rowIndex); 
				},0);
				
			});

		}else{
			rootNode.insertChild(0,{ID:rootNode.get('id'),HISTORY_ID:me.HISTORY_ID,TAHUN:rootNode.get('TAHUN'),ISUBAH:true});
			
			me.getSelectionModel().select(rowIndex+1);  
			var rec=me.getSelectionModel().getSelection()[0];
			var editor = me.plugins[0];
			editor.startEdit(rec,0);
		}
		
	},
	
	onHapus:function(record,me){
		var me=this;
		me.fireEvent('hapus',me);
		Ext.Msg.show({
		    title:'Hapus',
		    msg: 'Yakin akan menghapus data ini?',
		    buttons: Ext.Msg.YESNO,
		    fn: function (btn){
				if(btn == 'yes'){
					Traspac.Ajax.request({
						url		: me.crud.hapus,
						scope	: me,
						params	: {
							id 			: record.get(me.ID_IS),
							id_second 	: record.get(me.EXTRA_ID.id)
						},
						success	: function(data){
							Traspac.Msg.success("Data berhasil dihapus");
							me.store.load({node:(record.parentNode=='0')?me.getNodeById(me.idroot): record.parentNode  });
						},
						failure	: Traspac.onErrorAlert
					});
				}
			}
		});
		
	},
	onBatal		:function(rowEditing, context){
		var record = context.record.data;
		if(!record.id || record.id=='')
			context.record.remove(true);
	},
	
	onSimpan	:function(editor, context, node){
	
		function replaceAll(find, replace, str) {
		  return str.replace(new RegExp(find, 'g'), replace);
		}
		
		var me=this;
		var record = context.record.data;
		var params="{";
		for(var k in record) {
			var s=Object.byString(record,k);
			if(k==me.EXTRA_ID.id){
				s=me.EXTRA_ID.value;
			}
				params+="'"+k+"':'"+ (s||'')  +"',";
		}
		params+="}";
		
		var url=me.crud.ubah;
		if(!record.id || record.id==''){
			url= me.crud.tambah;
		}

		Traspac.Ajax.request({
			url		: url,
			scope	: me,
			el		: me.el,
			msg		:'sedang proses menyimpan',
			params	: Ext.decode(params),
			success	: function(data){
				Traspac.Msg.success("Data berhasil disimpan");
				if(!record.id || record.id==''){
					me.store.load({node:node});
				}else{
					me.store.load({node:node.parentNode});
				}
			},
			failure	: Traspac.onErrorAlert
		});
		
	},
	
	
	getAction:function(){
		var me =this;
		
		
		var action=[];
		
		var i=0;
		if(!me.isHiddenTambah|| true){
			action[i]={
				iconCls: 'tambah',
				tooltip: 'Tambah',
                getClass: function(value, metaData, record){
					if(  (me.condisional_tambah && me.condisional_tambah(value, metaData, record)) || me.isHiddenTambah)
                        metaData.css = 'hide-icon';
                    else
                        return 'tambah';
                },
				handler: function(grid, rowIndex, colIndex) {
					var rec = grid.getStore().getAt(rowIndex);
					if(  (me.condisional_tambah && me.condisional_tambah('', '', rec)) || me.isHiddenTambah){
						return ;
					}
					me.onTambah(rec,rowIndex,me);
				}
			};
			i++;
		}
		if(!me.isHiddenDetail){
			action[i]={
				iconCls: 'detail',
				tooltip: 'Detail',
				getClass: function(value, metaData, record){
					console.log(me.isHiddenDetail);
					if( record.get('root')==true || me.isHiddenDetail  )
						metaData.css = 'hide-icon';
					else
						return 'detail';
				},
				handler: function(grid, rowIndex, colIndex) {
					var rec = grid.getStore().getAt(rowIndex);
					me.onDetail(rec,me);
				}
			};
			i++;
		}
		
		if(!me.isHiddenHapus || true){
			action[i]={
				iconCls: 'hapus',
				tooltip: 'Hapus',
				getClass: function(value, metaData, record){
					if( record.get('root')==true||me.isHiddenHapus ||  (me.condisional_hapus && me.condisional_hapus(value, metaData, record)) )
						metaData.css = 'hide-icon';
					else
						return 'hapus';
				},
				handler: function(grid, rowIndex, colIndex) {
					var rec = grid.getStore().getAt(rowIndex);
					me.onHapus(rec,me);
					
				}
			};
		}
		
		return action;
	},
	
	onDetail:function(rec,me){
		this.fireEvent('detail',rec,me);
	},
	
	onBeforeEdit:function(editor,context){
		var rec=context.record;
						
		function removeTags(txt){
			var rex = /(<([^>]+)>)/ig;
			if(txt)
				return txt.replace(rex , "");
			else return "";
		}
		rec.set('text',removeTags(rec.get('text')));
		
		
		if(rec.get('id')==0 || this.isRowEditorUbah==false){
			return false;
		}
	}
  
  
});