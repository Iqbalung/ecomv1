$(document).ready(function() {
	var master_costumer = {
		load: {
			css: [

			],
			js: [

			],
			success: function() {
				master_costumer.init();
				master_costumer.listeners();
			}		
		},
		init: function() {
			var me = this,
				params = me.get_params();			

			  $('#table-user').DataTable({
			  	"processing": true,
		        "serverSide": true,
		        "paging":   true,
		        "ordering": false,
		        "info":     false,
		        "bFilter" : false,               
				"bLengthChange": false,
		        "ajax": {
		        	"url" : app.data.site_url+"/master/costumer/get",
		        	"data" : function(d){
						d.f_search = $(".f-search").val();
					},
		        },
		        "columns":[
			      {
			      	"data":"no",			      				      	
			      }, {
			      	"data":"user_username",
			      }, {
			      	"data":"no_hp",
			      }, {
			      	"data":"alamat",			      	
			      	"render":function(ths,type,row,setting){			      					      		
			      		var view = `<div>
			      		`+ row.alamat +` - ` + row.kodepos + `
			      		</div>`;			      					      					      		
			      		
			      		return view;
			      	}
			      }			      
			    ],
			  });
			  
		},
		listeners: function() {
			var me = this;

			$(".btn-f-search").on('click', function(event) {
				event.preventDefault();
				me.load_list();
			});

		},
		load_list:function(){
			var me = this,
				title = "list",
				params = me.get_params();
			app.body_mask();
			if (me.firstLoad[title] != JSON.stringify(params) || is_load) 
			{
				
				$("#table-user").data(params);
				$("#table-user").DataTable().ajax.reload();
				setTimeout(function() {					
					app.body_unmask();
				},500);
			}
			else
			{
				setTimeout(function() {					
					app.body_unmask();
				},500);
			}
		},
		get_params: function()
		{
			var params = {
				"f-search":$(".f-search").val()
			};

			return params;
		},	
		selected: {},
		id: '',
		url: '',
		firstLoad:{
			list:false,
		},
		isLoad: false,
	};

	app.loader(master_costumer);
});