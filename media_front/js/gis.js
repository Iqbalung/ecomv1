
toolbar_path=Traspac.IMG_URL+'gis/';


var map;
var marker;
var myLatlng= new google.maps.LatLng(-1.537901237431487, 115.5322265625 );
var markersArray=[];
function clearOverlays() {
  for (var i = 0; i < markersArray.length; i++ ) {
    markersArray[i].setMap(null);
  }
  markersArray = [];
}
var currentMark=null;
var canvas=null;
var ajax =null;

var infobox = null;
function initialize() { 
	 
	 var mapOptions = {
		zoom: 5,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	google.maps.Map.prototype.clearMarkers = function() {
    for(var i=0; i < this.markers.length; i++){
        this.markers[i].setMap(null);
    }
    this.markers = new Array();
	};
	map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
	
	
	google.maps.event.addListener(map, 'click', function(event) {
		console.log(event.latLng);	
		if(set_map){
				tplib.Ajax.request({
					url: App.online_url+'gis/save_koordinat',
					params: {
						'satkerid'	:satker_id_global,
						'latitude'	:event.latLng.lat(),
						'longitude'	:event.latLng.lng()
					},
					el:Ext.getCmp('id_gis').el,
					msg:'Sedang memuat data..',
					success: function(data){
							marker.setPosition( new google.maps.LatLng( 0, 0 ) );
							map.panTo( new google.maps.LatLng( 0, 0 ) );		
					}
				});
		}
	});
	
	
	infobox = new InfoBox({
    content: document.getElementById("infobox1"),
    disableAutoPan: false,
    maxWidth: 150,
    pixelOffset: new google.maps.Size(-140, 0),
    zIndex: null,
    boxStyle: {
                background: "url('http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/examples/tipbox.gif') no-repeat",
                opacity: 0.75,
                width: "280px"
        },
    closeBoxMargin: "12px 4px 2px 2px",
    closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
    infoBoxClearance: new google.maps.Size(1, 1)
	});

	 
	 google.maps.event.addListener(infobox,'open',function(){});

	showMarkerOnMap('');

	
}


function placeMarker(location) {
	marker.setPosition(location);
	map.setCenter(location);

}


function showMarkerOnMap(id){
	
	clearOverlays();
	
	Ext.Ajax.request({
		url: Traspac.SITE_URL+'/rekap/peta/expand',
		params: {
			'satkerid'		:'0',
			//'jeniskantor'	:jeniskantor_select
		},
		//el:Ext.getCmp('id_gis').el,
		msg:'Sedang memuat data..',
		success: function(data){

			var obj=Ext.decode(data.responseText);
			for(var i=0;i< obj.length;i++){
				
				var icon = obj[i].ICON;
				
				var lat=parseFloat(obj[i].LATITUDE);
				var lng=parseFloat(obj[i].LONGITUDE);
					
				var latlng=new google.maps.LatLng(lat,lng);

				markersArray[i] = new google.maps.Marker({
					map			:	map,
					icon		: 	toolbar_path+icon+'-marker.png',
					title		: 	"[ Personil ]",
					satker		: 	"Satker",
					satkerid	: 	"03",
					jmlpegawai	: 	"30",
					position	:	latlng
				});	
				
				
				google.maps.event.addListener(markersArray[i], 'click', function(event) {
					//infobox.open(map,this);
					currentMark=this;
					var x=Ext.getCmp('id_gis').showWindowPegawai();
					x.show();
					x.setTitle(''+currentMark.satker);
					x.down('grid').getStore().proxy.extraParams.satkerid=currentMark.satkerid;
					x.down('grid').getStore().load();
					//setTimeout(function(){
						//document.getElementById('nama_utp').innerHTML="Nama Unit Kerja : "+currentMark.satker;
						//document.getElementById('jumlah_personil').innerHTML="Jumlah Personil : "+currentMark.jmlpegawai;
					//},100);
				 });

			}
		}
	});

}