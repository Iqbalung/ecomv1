/**
 * @class Traspac.components.window.Penghargaan
 * @extends Ext.window.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component Penghargaan for traspac application
 * This Penghargaan is built by two basic components. FilterPenghargaan and grid.Pegawai.
 * This Class is created to be component for searcing in data pegawai  
 *
 **/

Ext.define("Traspac.components.window.Penghargaan",{
	extend		: "Traspac.components.window.Pilih",
	alias		: "widget.windowpenghargaan",
	
	requires:['Traspac.components.tree.Penghargaan'],

	
	title:'Daftar Penghargaan',
	
	initComponent	: function(a) {
		
		var me=this;
		this.addEvents({
			"pilih"				: true,
			"itemclick"			: true,
			"batal"				: true
		});

		
		this.callParent([arguments]);
		
	},
	
	buildContent:function(){
		var me=this;
		return Ext.create('Traspac.components.tree.Penghargaan', {
			width:400,
			height:500,
			itemclick:function(a,b,c){
				me.fireEvent('itemclick',a,b,c);
			}
		});
	},
	
	onPilih:function(){
		var me=this;
		var e=me.content.getSelectionModel().getSelection();
		if(e.length>0){
			me.fireEvent("pilih", e[0]);
			me.hide();
		}else{
			Traspac.Msg.alert("Tidak ada data yang dipilih");
		}
	},
	
	onBatal:function(){
		var me = this;
		me.fireEvent("batal", me);
	}

});

