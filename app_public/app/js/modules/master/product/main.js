$(document).ready(function() {
	var master_product = {
		load: {
			css: [

			],
			js: [

			],
			success: function() {
				master_product.init();
				master_product.listeners();
			}		
		},
		init: function() {
			var me = this,
				params = me.get_params();
			  $('#table-product').DataTable({
			  	"processing": true,
		        "serverSide": true,
		        "paging":   true,
		        "ordering": false,
		        "info":     false,
		        "bFilter" : false,               
				"bLengthChange": false,
		        "ajax": {
		        	"url" : app.data.site_url+"/master/product/get",
		        	"data" : function(d){
						d.f_search = $(".f-search").val();
					},
		        },
		        "columns":[
			      {
			      	"data":"no",			      				      	
			      }, {
			      	"data":"prod_code",			      	
			      }, {
			      	"data":"prod_name",			      	
			      }, {
			      	"data":"prod_suplier",			      	
			      }, {
			      	"data":"prod_desc",			      	
			      }, {
			      	"data":"no",			      	
			      	"render":function(ths,type,row,setting){
			      		var view = `
			      		<div class="grup-btn-action">
			      			<button class="table-btn-action btn-transparant btn-update"><i class="fa fa-pencil"></i></button>
							<button class="table-btn-action btn-transparant btn-delete"><i class="fa fa-trash"></i></button>
			      		</div>`;			      					      		
			      		setTimeout(function(){
			      			$("#table-product tbody tr:nth-child("+ (setting.row+1) +")").data(row);	      		
			      		},500);
			      		
			      		return view;
			      	}
			      }			      
			    ],
			  });			
		},
		listeners: function() {
			var me = this;

			/*$('#btn-add-product').on('click', function(event) {
				event.preventDefault();
				$('#modal-form-product').modal({backdrop:'static'});
				$('#modal-form-product').find(".modal-title").html("Add Product");
				app.clear_form("#form-product");
			});*/

			$("#btn-add-product").on('click', function(e) {
				e.preventDefault();
			    master_product.generated_kesehatan(function(data){
			    	window.location.href = app.data.site_url+"/product/form/index/"+data;
			    });
			});

			$("#modal-form-product").delegate('.btn-save', 'click', function(event) {
				me.save();
			});



			$("#table-product").delegate('.grup-btn-action .btn-update', 'click', function(event) {
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

			$("#table-product").delegate('.grup-btn-action .btn-delete', 'click', function(event) {
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
						me.delete(data.prod_id);						
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
				
				$("#table-product").data(params);
				$("#table-product").DataTable().ajax.reload();
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
				form = $("#form-product"),
				formData = form.serializeArray();
				
			app.body_mask();
			app.requestAjax(app.data.site_url+"/master/product/save",formData,"POST",function(result){
				try
				{
					if (result.success)
					{
						swal("Information",result.msg,"success");
						$("#modal-form-product").modal("hide");
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
			$('#modal-form-product').modal({backdrop:'static'});
			$('#modal-form-product').find(".modal-title").html("Update Product");						
			app.set_form_value("#form-product",args);

		},
		generated_kesehatan:function(callback){			
			var me = this;
			app.requestAjax(app.data.site_url+"/product/Form/create_wf",{},"POST",function(result) {
				if (result.success)
				{
					callback(result.data);
				}
			});
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
				app.requestAjax(app.data.site_url+"/master/product/delete",params,"POST",function(result){
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

	app.loader(master_product);
});