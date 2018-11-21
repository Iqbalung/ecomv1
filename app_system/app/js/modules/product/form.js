$(document).ready(function() {
	var form_product = {
		load: {
			css: [

			],
			js: [

			],
			success: function() {
				form_product.init();
				form_product.listeners();
			}		
		},
		init: function() {
			var me = this;				

			var id = app.data.segment[4];
			form_product.selected.id = id;
			form_product.load_variant(id);
			$("input[name=prod_id]").val(id);
			console.log(id);
			app.get_data_list("[name=category_id]",app.data.site_url+"/master/category/get",{},{
			  	display_value:'category_name',
			  	value:'category_id'
			});

			app.get_data_list("[name=prod_suplier]",app.data.site_url+"/master/suplier/get",{},{
			  	display_value:'suplier_name',
			  	value:'suplier_name'
			});			
			 
		},
		listeners: function() {
			var me = this;			

			$('#btn-action-simpan').on('click', function(event) {
				event.preventDefault();
				me.save();
			});

			$("#variant").delegate('.btn-action-simpan-variant', 'click', function(event) {
				event.preventDefault();
				
				value = $(".input-value-"+$(this).data("idx")).val();
				stock = $(".input-stock-"+$(this).data("idx")).val();
				form_product.upd_variant(value,stock,$(this).data("idx"));
			});

			$("#variant").delegate('.btn-action-hapus-variant', 'click', function(event) {
				event.preventDefault();
				
				value = $(".input-value-"+$(this).data("idx")).val();
				stock = $(".input-stock-"+$(this).data("idx")).val();
				form_product.del_variant(value,stock,$(this).data("idx"));
			});

			$('#btn-action-simpan-variant').on('click', function(event) {
				event.preventDefault();
				me.save_variant();
			});

			$('#btn-action-batal').on('click', function(event) {
				event.preventDefault();
				swal({
				  	title: "Batal menambah produk?",					  
				  	icon: "warning",
				  	buttons: true,
				  	buttons: ["Tidak", "Batal"],				  	
				})
				.then((isCancel) => {
				  if (isCancel) {					    
					me.reset_form();
				  }
				});
			});
			
		},
	

		reset_form:function() {
			var me = this;
			app.clear_form("#form-produck");
			$("[name=category_id]").select2("val", "");
			$("[name=prod_suplier]").select2("val", "");
		},
		save: function()
		{
			var me = this;
				form = $("#form-produck"),
				formData = new FormData(form[0]);

			app.body_mask();
			app.requestAjaxForm(app.data.site_url+"/product/form/save",formData,"POST",function(result){
				try
				{
					if (result.success)
					{
						swal("Information",result.msg,"success");
						me.reset_form();
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
		save_variant: function()
		{
			var me = this;
				id = form_product.selected.id,
				value = $(".input-value").val(),
				stock = $(".input-stock").val(),
				

			app.body_mask();
			console.log();
			app.requestAjax(app.data.site_url+"/product/form/save_variant",{prod_id:id,value:value,stock:stock},"POST",function(result){
				try
				{
					if (result.success)
					{
						swal("Information",result.msg,"success");
						me.reset_form();
						form_product.load_variant();
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
		del_variant: function(value,stock,varian_id)
		{
			var me = this;
				id = form_product.selected.id,
				value = $(".input-value").val(),
				stock = $(".input-stock").val(),
				

			app.body_mask();
			console.log();
			app.requestAjax(app.data.site_url+"/product/form/del_variant",{prod_id:id,value:value,stock:stock,varian_id:varian_id},"POST",function(result){
				try
				{
					if (result.success)
					{
						swal("Information",result.msg,"success");
						me.reset_form();
						form_product.load_variant();
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
		upd_variant: function(value,stock,varian_id)
		{
			var me = this;
			id = form_product.selected.id;
				
			console.log(value);
			app.body_mask();
			console.log();
			app.requestAjax(app.data.site_url+"/product/form/save_variant",{prod_id:id,value:value,stock:stock,varian_id:varian_id},"POST",function(result){
				try
				{
					if (result.success)
					{
						swal("Information",result.msg,"success");
						me.reset_form();
						form_product.load_variant();
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


		load_variant:function()
		{
			id = form_product.selected.id;
			var me = this,
				title = 'data_list';

			try
			{
				var is_load = is_load;
			}
			catch(e)
			{
				var is_load = false;
			}

			app.body_mask();
						
				

				$.ajax({
					url: app.data.site_url + '/product/form/get_variant',
					type: 'GET',
					dataType: 'json',
					data: {prod_id:id},
				})
				.done(function(result) {
					var content = "";
					$('#variant').html('');
					if ("data" in result)
					{
						if (result.data.length == 0)
						{
							$('#table-transaction tbody').html(`
								<tr class="data-kosong">
		                            <td colspan="11" class="col-md-12" align="center">Data tidak ditemukan</td>
		                        </tr>
								`);
						} 
						else
						{
							
							result.data.forEach(function(row) {
								

								var content = `
									<div class="row">
					                	<div class="col-md-4">
						                	<div class="form-group">
						                		<input type="text" class="input-value-`+row.varian_id+` form-control" placeholder="Varian" value="`+row.varian_value+`" name="value">
						                	</div>
					                	</div>
					                	<div class="col-md-4">
						                	<div class="form-group">
						                		<input type="number" class="input-stock-`+row.varian_id+` form-control" placeholder="Stock" value="`+row.varian_stock+`" name="stock">
						                	</div>
					                	</div>
					                	<div class="col-md-4">
					                		<button type="button" data-idx="`+row.varian_id+`" class="btn btn-lg btn-action btn-dark bg-dark btn-action-simpan-variant" id="">S</button>
					                		<button type="button" data-idx="`+row.varian_id+`" class="btn btn-lg btn-action btn-danger btn-action-hapus-variant" id="">D</button>
					                	</div>
						            </div>
								`;
								$('#variant').append(content);
								
							});
						}
					}
				})
				.fail(function(result) {						
					swal({
						title: "Informasi!",
						text: '('+result.status+') '+result.statusText,							
						icon: "warning",
					});
				})
				.always(function() {
					setTimeout(function() {
						app.body_unmask();
					},500);
				});		
			
			

		},
		selected: {},
		id: '',
		url: '',
		firstLoad:{
			list:false,
		},
		isLoad: false,
	};

	app.loader(form_product);
});