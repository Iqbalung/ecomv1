$(document).ready(function() {
	var master_user = {
		load: {
			css: [

			],
			js: [

			],
			success: function() {
				master_user.init();
				master_user.listeners();
			}		
		},
		init: function() {
			var me = this,
				params = me.get_params();

			$('#form-user').validate({
				ignore: [],
				rules: {
					password2: {
						equalTo: '#password'
					}
				},
				errorPlacement: function(error, element) {
					error.insertAfter(element.parent());
				}
			});

			  $('#table-user').DataTable({
			  	"processing": true,
		        "serverSide": true,
		        "paging":   true,
		        "ordering": false,
		        "info":     false,
		        "bFilter" : false,               
				"bLengthChange": false,
		        "ajax": {
		        	"url" : app.data.site_url+"/master/user/get",
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
			      	"data":"urg_name",
			      }, {
			      	"data":"no",			      	
			      	"render":function(ths,type,row,setting){			      					      		
			      		var view = `
			      		<div class="grup-btn-action">
			      			<button class="table-btn-action btn-transparant btn-update"><i class="fa fa-pencil"></i></button>
							<button class="table-btn-action btn-transparant btn-delete"><i class="fa fa-trash"></i></button>
			      		</div>`;			      					      		
			      		setTimeout(function(){
			      			$("#table-user tbody tr:nth-child("+ (setting.row+1) +")").data(row);	      		
			      		},500);
			      		
			      		return view;
			      	}
			      }			      
			    ],
			  });

			  app.get_data_list("[name=user_usergroup]",app.data.site_url+"/master/user/get_usergroup",{},{
			  	display_value:'urg_name',
			  	value:'urg_id'
			  });
		},
		listeners: function() {
			var me = this;

			$('#btn-add-user').on('click', function(event) {
				event.preventDefault();
				$('#modal-form-user').modal({backdrop:'static'});
				$('#modal-form-user').find(".modal-title").html("Add User");
				app.clear_form("#form-user");
			});

			$("#modal-form-user").delegate('.btn-save', 'click', function(event) {
				me.save('add');
			});

			$("#modal-form-update-user").delegate('.btn-save', 'click', function(event) {
				me.save('update');
			});

			$("#table-user").delegate('.grup-btn-action .btn-update', 'click', function(event) {
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

			$("#table-user").delegate('.grup-btn-action .btn-delete', 'click', function(event) {
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
						me.delete(data.user_userid);						
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
		save: function(flag)
		{
			var me = this;

			if (flag == "update")
			{
				var form = $("#form-update-user");
			}
			else
			{
				var form = $("#form-user");
			}

				
			var formData = form.serializeArray();
				
			app.body_mask();
			app.requestAjax(app.data.site_url+"/master/user/save",formData,"POST",function(result){
				try
				{
					if (result.success)
					{
						swal("Information",result.msg,"success");						
						me.load_list();					
						if (flag == "update")
						{
							app.clear_form("#form-update-user");
							$('#modal-form-update-user').modal("hide");
						}
						else
						{
							app.clear_form("#form-user");
							$('#modal-form-user').modal("hide");
						}
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
			$('#modal-form-update-user').modal({backdrop:'static'});
			$('#modal-form-update-user').find(".modal-title").html("Update User");						
			app.set_form_value("#form-update-user",args);

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
				app.requestAjax(app.data.site_url+"/master/user/delete",params,"POST",function(result){
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

	app.loader(master_user);
});