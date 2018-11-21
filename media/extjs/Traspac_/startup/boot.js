
function startup_traspac(){
	if(Ext.isEmpty(Traspac.BASE_URL)){
		Traspac.log("Please set a correct value for the 'Traspac.BASE_URL' constant!");
		Ext.Msg.alert("Error!!","Please set a correct value for the 'Traspac.BASE_URL' constant!");
	}

	Ext.require("Traspac");  
	Ext.require('Traspac.core.Log');
	Ext.require('Traspac.components.Constants');
	Ext.require("Traspac.abstract.Window");  
	Ext.require("Traspac.abstract.Grid");  
	Ext.require('Traspac.components.grid.Pegawai');
	Ext.require('Traspac.abstract.CariPegawai');
	Ext.require('Traspac.abstract.Window');
	Ext.require('Traspac.abstract.FieldButton');
	Ext.require('Traspac.securities.Constants');
	Ext.require('Traspac.components.form.FilterCariPegawai');
	Ext.require('Traspac.components.tree.UnitKerja');
	Ext.require('Traspac.components.field.Pegawai');
	Ext.require('Traspac.components.field.Jabatan');
	Ext.require('Traspac_.components.field.SearchField');
	Ext.require('Traspac.components.window.CariPegawai');
	Ext.require("Traspac.abstract.MessageBox");
	
}