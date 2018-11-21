$(document).ready(function() {
	var master_region = {
		load: {
			css: [

			],
			js: [

			],
			success: function() {
				master_region.init();
				master_region.listeners();
			}		
		},
		init: function() {
			var me = this,
				params = me.get_params();
			  $('#table-region').DataTable({
			  	"processing": true,
		        "serverSide": true,
		        "paging":   true,
		        "ordering": false,
		        "info":     false,
		        "bFilter" : false,               
				"bLengthChange": false,
		        "ajax": {
		        	"url" : app.data.site_url+"/master/region/get",
		        	"data" : function(d){
						d.f_search = $(".f-search").val();
					},
		        },
		        "columns":[
			      {
			      	"data":"no",			      				      	
			      }, {
			      	"data":"reg_name",			      	
			      }, {
			      	"data":"no",			      	
			      	"render":function(ths,type,row,setting){			      					      					      		
			      		var view = `
			      		<div class="grup-btn-action">
			      			<button class="table-btn-action btn-transparant btn-update"><i class="fa fa-pencil"></i></button>
							<button class="table-btn-action btn-transparant btn-delete"><i class="fa fa-trash"></i></button>
			      		</div>`;			      					      		
			      		setTimeout(function(){
			      			$("#table-region tbody tr:nth-child("+ (setting.row+1) +")").data(row);	      		
			      		},500);
			      		
			      		return view;
			      	}
			      }			      
			    ],
			  });			
		},
		listeners: function() {
			var me = this;

			$('#btn-add-region').on('click', function(event) {
				event.preventDefault();
				$('#modal-form-region').modal({backdrop:'static'});
				$('#modal-form-region').find(".modal-title").html("Add Media Sale");
				app.clear_form("#form-region");
			});

			$("#modal-form-region").delegate('.btn-save', 'click', function(event) {
				me.save();
			});

			$("#table-region").delegate('.grup-btn-action .btn-update', 'click', function(event) {
				try
				{
					var data = $(this).parents("tr").data();										
					me.form_update(data);
				}
				catch(e)
				{
					console.debug(e);
				}
			});

			$("#table-region").delegate('.grup-btn-action .btn-delete', 'click', function(event) {
				try
				{
					var data = $(this).parents("tr").data();
					swal({
					  	title: "Delete data?",					  
					  	icon: "warning",
					  	buttons: true,
					  	buttons: ["Cancel", "Delete"],
					  	dangerMode: true,
					})
					.then((isDelete) => {
					  if (isDelete) {					    
						me.delete(data.reg_id);						
					  }
					});
				}
				catch(e)
				{
					console.debug(e);
				}
			});

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
				
				$("#table-region").data(params);
				$("#table-region").DataTable().ajax.reload();
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
		save: function()
		{
			var me = this;
				form = $("#form-region"),
				formData = form.serializeArray();
				
			app.body_mask();
			app.requestAjax(app.data.site_url+"/master/region/save",formData,"POST",function(result){
				try
				{
					if (result.success)
					{
						swal("Information",result.msg,"success");
						$("#modal-form-region").modal("hide");
						me.load_list();					
					}
					else
					{
						swal("Information",result.msg,"warning");
					}
				}
				catch(e)
				{
					swal("Information",e,"warning");
				}	
			});
		},
		form_update: function(args)
		{
			var me = this;
			$('#modal-form-region').modal({backdrop:'static'});
			$('#modal-form-region').find(".modal-title").html("Update Media Sale");						
			app.set_form_value("#form-region",args);

		},
		delete:function(id)
		{
			var me = this;
			try
			{
				var params = {
					id:id
				}
				app.body_mask();
				app.requestAjax(app.data.site_url+"/master/region/delete",params,"POST",function(result){
					try
					{
						if (result.success)
						{
							swal("Information",result.msg,"success");	
							me.load_list();					
						}
						else
						{
							swal("Information",result.msg,"warning");
						}
					}
					catch(e)
					{
						swal("Information",e,"warning");
					}					
				});
			}
			catch(e)
			{
				console.debug(e);
			}
		},
		selected: {},
		id: '',
		url: '',
		firstLoad:{
			list:false,
		},
		isLoad: false,
	};

	app.loader(master_region);
});