
/**
 * @class Traspac.components.window.KamusKompetensi
 * @extends Traspac.components.window.Pilih
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @Description
 * Building component window for kelompok Kompetensi for traspac application
 * This KamusKompetensi is built by two basic components. FilterKamusKompetensi and grid.Pegawai.
 * This Class is created to be component for searcing in data pegawai  
 *
 **/

Ext.define("Traspac.components.window.KamusKompetensi",{
	extend		: "Traspac.components.window.Pilih",
	alias		: "widget.windowkamuskompetensi",
	
	requires:['Traspac.components.tree.Wilayah'],
	
	config:{
		tree				:	'',
	},
	
	title:'Daftar Kelompok Kompetensi',
	
	initComponent	: function(a) {
		
		var me=this;
		this.addEvents({
			"pilih"				: true,
			"batal"				: true
		});
		
		this.callParent([arguments]);
		
	},
	
	buildContent:function(){
		return Ext.create('Traspac.components.tree.KamusKompetensi', {
			width:400,
			URL:this.URL,
			height:500,
		});
	},
	
	onPilih:function(){
		var me=this;
		var e=me.content.getSelectionModel().getSelection();
		if(e.length>0){
			return me.fireEvent("pilih", e[0]);
		}else{
			Traspac.Msg.alert("Tidak ada data yang dipilih");
		}
	},
	
	onBatal:function(){
		this.fireEvent("batal", this);
	}
	
});

