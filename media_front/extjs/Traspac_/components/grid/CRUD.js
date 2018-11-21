/**
 * @class Traspac.components.grid.CRUD
 * @extends Ext.grid.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component CRUD for traspac application
 * This CRUD is created to be show data CRUD. 
 *
 **/

Ext.define("Traspac.components.grid.CRUD",{
	extend		: "Traspac.abstract.Grid",
	alias: 'widget.gridcrud',
	
	config:{
		isHiddenUbah	:false	,
		isHiddenTambah	:false	,
		isHiddenHapus	:false	,
		isCRUD			:true	,
		LOAD_BY_ID		:''	,
		ID				:''		,
		NOURUT			:null		,
		crud			:{}
	},
	changeCount: 0,
	isRowEditing:true,
	isBtnTambahUbah:false,
	isRowEditingUbah:true,
	isRowEditingTambah:true,
	errorSummary:true,
	border:true,
	viewConfig: {
		loadMask: false
	},
	cls:'needWrap',
	cellWrap: true,
	paging:false,
	initComponent	: function() {
		var me=this;
		
		
		me.addEvents({
			'tambah':true,
			'ubah':true,
			'hapus':true,
			'setelahtambah':true,
		});
		
		var tambah='';
		if(this.isCRUD==false){
			this.isHiddenUbah		= true;
			this.isHiddenTambah		= true;
			this.isHiddenHapus		= true;
		}else{
			tambah='<div class=tambah_ onclick=tambah("'+this.id+'") style="height:25px;width:25px;position:absolute;top:-0px;right:20px;cursor:pointer" ></div>';
		}

		
		if(this.isGrouping===true){
			this.features=Ext.create('Ext.grid.feature.Grouping',{
				groupHeaderTpl: '{name}'+tambah,
				hideGroupedHeader: false,
				startCollapsed: true
			});
		}
		
		if(this.isCRUD==true && me.isRowEditing==true){
			var rowEditing = Ext.create('Ext.grid.plugin.RowEditing', {
				errorSummary:me.errorSummary,
				hideButtons: function(){
					var me = this;
					if (me.editor && me.editor.floatingButtons){
						me.editor.floatingButtons.hide();
					} else {
						Ext.defer(me.hideButtons, 10, me);
					}
				},
				listeners: {
					beforeedit: function(){
						if(!me.isBtnTambahUbah){
							this.hideButtons();
						}
					},
					canceledit: function(rowEditing, context) {
						var rec=me.getSelectionModel().getSelection()[0];
						if(typeof rec.get('PEGAWAIID')!="undefined"){
							if(rec.get('PEGAWAIID')==''){
								var row = me.store.indexOf(rec);
								me.store.removeAt(row);
							}
						}
					},
					validateedit: function(editor, context, eOpts){
						
					},
					edit:function(editor, context, eOpts){
							var rec=me.getSelectionModel().getSelection()[0];	
							me.onSimpan(editor, context, eOpts);
					}
				}
			});
			me.plugins= [rowEditing];
		}
		
		if(this.crud.baca)
			this.URL=this.crud.baca;
		
		this.callParent(arguments);
	},
	
	getURL:function(){
		if(this.URL=='unknown')
			return Traspac.Constants.SITE_URL+'/crud/get_example';
		else return this.URL;
	},
	
	getFields:function(){
		if(this.fields=='unknown')
			return this.getDefaultFields();
		else return this.fields;
	},
	getTitleCRUD:function(){
		return 'crud';
	},
	
	getColumns:function(){
		if(this.columns=='unknown'){
			return this.buildColumns(this.getDefaultColumns());
		}else return this.buildColumns(this.columns);
	},
	
	getIsLoad:function(){
		return this.isLoad;
	},
	
	buildColumns :function(columns){
		var me =this;

		var action=[];
		
		var i=0;
		if(!me.isHiddenUbah){
			action[i]={
				iconCls: 'ubah',
				tooltip: 'Ubah',
				handler: function(grid, rowIndex, colIndex) {
					var rec = grid.getStore().getAt(rowIndex);
					me.onUbah(rec,me);
				}
			};
			i++;
		}
		
		if(!me.isHiddenHapus){
			action[i]={
				iconCls: 'hapus',
				tooltip: 'Delete',
				hidden: me.isHiddenHapus,
				handler: function(grid, rowIndex, colIndex){
					var rec = grid.getStore().getAt(rowIndex);
					me.onHapus(rec,me);
				}
			};
		}
		
		var tambah='';
		if(!me.isHiddenTambah){
			tambah='<div class=tambah style="cursor:pointer;height:25px;width:25px;position:absolute;top:-0px;" onclick=tambah("'+this.id+'") > </div>';
		}
		
		columns.push({
			xtype:'actioncolumn',
			width:60,
			menuDisabled: true,
			header:tambah,
			items:action
		});
		
		return columns;

	},
	
	getDefaultColumns:function(){
		
		return [
			{xtype: 'rownumberer',dataIndex: 'NO',text: 'No',width:45},
			{dataIndex: 'TEXTCRUDID',hidden:true},
			{header: 'ID CRUD', dataIndex: 'IDCRUD'},
			{header: 'TEXT CRUD',flex:1, dataIndex: 'TEXTCRUD',editor: {xtype: 'diklatfield',name:'TEXTCRUD', anchor:'90%',jenis:'STRUKTURAL'}}];
	},
	
	getDefaultFields:function(){
		return ['ID','TEXTCRUDID','IDCRUD','TEXTCRUD'];
	},
	onTambah:function(me){
        if(me.isRowEditingTambah==true){
			var store = me.getStore();
			
			var length=store.getCount();

			store.insert(length, {});
			this.getSelectionModel().select(length);  
			var rec=this.getSelectionModel().getSelection()[0];
			var editor = this.plugins[0];
			editor.startEdit(rec,0);
		}
	},
	onUbah:function(rec,me){
	
		var e=me.fireEvent('ubah',rec,me);
		if(e!=false){
			if(me.isRowEditing===true){
				var editor = this.plugins[0];
				editor.startEdit(rec,0);
			}
		}
	},
	
	onHapus:function(rec,me){
		var me=this;
		
		me.fireEvent('hapus',me);
		if(rec.get(me.NOURUT)==''){
			var selectedRecord = me.getSelectionModel().getSelection()[0];
			var row = me.store.indexOf(selectedRecord);
			me.store.removeAt(row);
			return;
		}
		
		Ext.Msg.show({
		    title:'Hapus',
		    msg: 'Yakin akan menghapus data ini?',
			buttonText: {
                yes: 'Ya', no: 'Tidak'
            },
		    buttons: Ext.Msg.YESNO,
		    fn: function (btn){
				if(btn == 'yes'){
		
					var r={};
					r[me.ID]=rec.get(me.ID);
					r[me.NOURUT]=rec.get(me.NOURUT);
		
					Traspac.Ajax.request({
						url		: me.crud.hapus,
						scope	: me,
						el		: me.el,
						msg		:'Sedang Proses Menghapus',
						params	: r,
						success	: function(data){
							Traspac.Msg.success("Data berhasil dihapus");
							me.store.load();
						},
						failure	: function(data){
							Traspac.Msg.warning(data.message);
						}
					});
				}
			}
		});
	},
	
	onSimpan:function(editor, context, eOpts){
		var me=this;
		var record = context.record.data;
		
		
		for(i in record){
			if( typeof(record[i]) == 'object'){
				record[i] = Ext.Date.format(new Date(record[i]),'d/m/Y');
			}
		}
		
		
		if(!context.record.get(me.NOURUT || me.ID) || context.record.get(me.NOURUT || me.ID)==''){
		
			
			Traspac.Ajax.request({
				url		: me.crud.tambah,
				scope	: me,
				el		: me.el,
				msg		:'Sedang Proses Menambah',
				params	: record,
				success	: me.onSuccessInfo,
				failure	: Traspac.onErrorAlert
			});
		} else {
			
			Traspac.Ajax.request({
				url		: me.crud.ubah,
				scope	: me,
				el		: me.el,
				msg		:'Sedang Proses Mengubah',
				params	: record,
				success	: me.onSuccessInfo,
				failure	: Traspac.onErrorAlert
			});
			
		}
		
	},
	
	onSuccessInfo:function(data){
		this.changeCount += 1;
		Traspac.Msg.success("Data berhasil disimpan");
		this.store.load();
	},
	
	onBeforeLoad:function(){
		this.store.proxy.extraParams[this.ID]=this.LOAD_BY_ID;
		var arr=this.PARAMS_EXTRA||[];
		
		for(var i=0; i<arr.length;i++){
			this.store.proxy.extraParams[arr[i].name]=arr[i].value;
		}
	}
	
});

function tambah (a){
	
	var me=Ext.getCmp(a);
	var e=me.fireEvent('tambah',me);
	
	if(me.isRowEditing===true && e!==false){
		var store = me.getStore();
			
		var length=store.getCount();
		var rec={};
		rec[me.ID]=me.LOAD_BY_ID;
		
		store.insert(length, rec);
		me.getSelectionModel().select(length);  
		var rec=me.getSelectionModel().getSelection()[0];
		var editor = me.plugins[0];
		editor.startEdit(rec,0);
		
		me.fireEvent('setelahtambah',me,rec);
	
	}
	
}