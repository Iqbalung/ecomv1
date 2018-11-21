$(document).ready(function() {
	var main_forstok = {
		load: {
			css: [

			],
			js: [

			],
			success: function() {
				main_forstok.init();
				main_forstok.listeners();
			}		
		},
		init: function() {
			var me = this,
				params = me.get_params();
				
					var id = atob(app.data.segment[4]);
					me.get_detail_transaction(id);
					
				
			
		},
		listeners: function() {
			var me = this;

			$('#btn-import').on('click', function(event) {
				event.preventDefault();
				$('#modal-import-forstok').modal({backdrop:'static'});
			});

			$('#modal-import-forstok').delegate('.btn-action-import', 'click', function(event) {
				me.import();
			});

			$('.f-search').on('keyup', function(event) {
				me.load_list();
			});


			$('.f-select').on('change', function(event) {
				me.load_list();
			});

			$('.date-from').on('change', function(event) {
				me.load_list();
			});

			$('.date-to').on('change', function(event) {
				me.load_list();
			});

			$('[aria-label="Page navigation"]').delegate('.pagination a', 'click', function(event) {
				event.preventDefault();
				main_forstok.start = $(this).attr('data-ci-pagination-page');
				me.load_list();
			});	

			$('#table-transaction').delegate('.btn-action-workin', 'click', function(event) {
				event.preventDefault();
				try
				{
					var data = $(this).parents("tr").data();
					me.check_workin_state(data.trx_id,function(result) {
						if ('message' in result) 
						{
							swal("Information",result.message,"warning");
							me.load_list(true);
						}
						else
						{
							me.get_detail_transaction(data.trx_id);
							$('#modal-workin').modal({backdrop:'static'});
							$('#modal-workin').data("trx_id",data.trx_id);
							me.workin_state(data.trx_id,1,function() {
								localStorage.setItem("trx_id",data.trx_id);								
							});		
						}
					});
				}catch(e)
				{
					console.debug(e);
				}

			});			

			$('body').bind('beforeunload',function(){
			   alert("AAA");
			});

			$(window).on('load',function(){
				localStorage.removeItem("trx_id");
				// if (localStorage.getItem("trx_id"))
				// {
				// 	me.workin_state(localStorage.getItem("trx_id"),0,function(){
				// 	});
				// }			     
			});

			$('#modal-workin').on('hidden.bs.modal', function () {
			    var id = $('#modal-workin').data("trx_id");
			    me.workin_state(id,0,function(){
			    	$('#modal-workin').data("trx_id","");
			    	localStorage.removeItem("trx_id");
			    	me.load_list(true);
			    });
			});

			$('#table-transaction').delegate('.btn-action-workin-close', 'click', function(event) {
				event.preventDefault();
				try
				{
					var data = $(this).parents("tr").data();					
					app.clear_form('#modal-workin-close .form-close-transaction');
					app.set_form_value(".form-close-transaction",data);
					$('#modal-workin-close').modal({backdrop:'static'});
				}
				catch(e)
				{
					console.debug(e);
				}

			});			

			$('#modal-workin').delegate('.btn-add-cost-type', 'click', function(event) {
				me.add_cost();
			});

			$('#modal-workin').delegate('.btn-delete-cost-type', 'click', function(event) {
				me.del_cost($(this).parents("tr"));
			});

			$('#modal-workin').delegate('.table-cost-type .field-cost', 'change', function(event) {
				me.change_value_cost($(this));
			});


			$('#modal-workin').delegate('.field-state', 'change', function(event) {
				me.change_state($(this));
			});
			
			$('#modal-workin').delegate('.table-items-transaction .field-item', 'change', function(event) {				
				me.change_value_items($(this));								
			});


			$('#modal-workin').delegate('.btn-action-process', 'click', function(event) {
				me.process_trx();
			});


			$('#modal-workin-close').delegate('.btn-action-close', 'click', function(event) {
				swal({
				  	title: "Close Transaction?",					  
				  	icon: "warning",
				  	buttons: true,
				  	buttons: ["Cancel", "Close"],
				  	dangerMode: true,
				})
				.then((isDelete) => {
				  if (isDelete) {		
						me.close_trx($(this));
					}
				});		
			});
		
		},		
		get_params: function()
		{
			var params = {
				"f_search":$(".f-search").val(),
				"f_state":$(".f-select").val(),
				"f_date_from":$(".date-from").val(),
				"f_date_to":$(".date-to").val(),
				"date-from":$(".date-from").val(),
				"date-to":$(".date-to").val(),
				"f-select":$(".f-select").val(),
				m: main_forstok.start,
				per_page: main_forstok.start
			};

			return params;
		},	
		import:function()
		{
			var me = this;
			form = $("#form-import-forstok"),
			formData = new FormData(form[0]);

			app.requestAjaxForm(app.data.site_url+"/transaction/forstok/import",formData,"POST",function(result){
				if (result.success)
				{
					swal("Information",result.error,"success");										
				}
				else
				{
					swal("Information",result.error,"warning");
				}
			});
		},
		check_workin_state: function(trx_id,callback)
		{
			var me = this;
				params = {
					id:trx_id					
				};

			app.requestAjax(app.data.site_url+'/transaction/forstok/app/cek_status_workin',params,"POST",function(result){
				if (callback)
				{
					callback(result);
				}
			});
		},
		workin_state: function(trx_id,state,callback)
		{
			$(".btn-action-process").attr("enabled");		
			var me = this;
				params = {
					id:trx_id,
					state:state
				};

			app.requestAjax(app.data.site_url+'/transaction/forstok/app/status_workin',params,"POST",function(result){
				if (callback)
				{
					callback();
				}
			});
		},
		load_list:function(is_load) {
			var me = this,
				title = 'data_list',
				params = me.get_params();

			try
			{
				var is_load = is_load;
			}
			catch(e)
			{
				var is_load = false;
			}

			app.body_mask();
			if (me.firstLoad[title] != JSON.stringify(params) || is_load) 
			{			
				if (typeof me.firstLoad[title] != "undefined") {
					me.firstLoad[title] = JSON.stringify(params);
				}

				$.ajax({
					url: app.data.site_url + '/transaction/forstok/app/get',
					type: 'GET',
					dataType: 'json',
					data: params,
				})
				.done(function(result) {
					var content = "";
					$('#table-transaction tbody').html('');
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
							var no = parseInt(main_forstok.start)+1;
							result.data.forEach(function(row) {
								var state = `<a class="btn btn-sm btn-info btn-pill pl-2 pr-2 btn-action-workin">Work In</a>
	                                        <a href="#" data-toggle="modal"  class="btn btn-sm btn-danger btn-pill pl-2 pr-2 btn-action-workin-close">Close Transaction</a>`;
								if (app.ifvalnull(row.trx_state_flag,"") == "close")
								{
									state = `<a href="#" class="btn btn-sm btn-sucess btn-pill pl-2 pr-2">Transaksi Closed (by `+ app.ifvalnull(row.user_username,"system") +`)</a>`;
								}
								else if (app.ifvalnull(row.trx_state_id,"") == "completed")
								{
									state = `<a href="#" class="btn btn-sm btn-sucess btn-pill pl-2 pr-2"><span class="text-color-dark">Transaksi completed</span></a>`;
								}
								else
								{
									if (app.ifvalnull(row.is_workin,"") == 1)
									{
										state = `<span class="text-color-dark">Transaksi dalam proses workin</span>`;
									}
								}

								var content = `
									<tr>
	                                    <td>` + no + `</td>
	                                    <td width="400">
	                                        ` + row.mos_name + `
	                                    </td>
	                                    <td>
	                                        ` + row.trx_id + `
	                                    </td>
	                                    <td>
	                                        ` + row.trx_date + `
	                                    </td>
	                                    <td>
	                                        ` + state + `
	                                    </td>
	                                </tr>
								`;
								$('#table-transaction tbody').append(content);
								$('#table-transaction tbody tr:last').data(row);
								no++;
							});
						}

						if('paging' in result)
						{
							$('[aria-label="Page navigation"]').html(result.paging);							
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
			}
			else
			{
				setTimeout(function() {					
					app.body_unmask();
				},500);
			}
		},
		get_detail_transaction: function(id) {
			var me = this,
				modal = $('#modal-workin');

			me.data_items = [];
			me.data_cost = [];
			app.requestAjax(app.data.site_url+"/transaction/forstok/app/get_detail_transaction",{id:id},"POST",function(result){
				if (result)
				{
					var form = modal.find('.form-detail-transaction');
						app.clear_form('#modal-workin .form-detail-transaction');
					if ('data' in result)
					{						
						app.set_form_value($('.form-detail-transaction'),result.data);
						me.data_items = result.data_items;
						me.data_cost = app.ifvalnull(result.data_cost,[]);
						me.data_state = app.ifvalnull(result.data_state,[]);
						me.generated_data_items();
						me.generated_cost();
						me.mapping_state();
					}

				}
				else
				{

				}

				setTimeout(function(){
					app.body_unmask();
				},500);
			});
		},
		generated_data_items: function()
		{
			var me = this,
				modal = $('#modal-workin'),
				table = $(".table-items-transaction");				
				table.find("tbody").html("");
			var no = 1;
			me.data_items.forEach(function(row,idx){
				row.id_gen = "id_gen_item-" + (new Date()).getTime();
				var item_isflashsale = "";
				if (row.item_isflashsale == 1)
				{
					item_isflashsale = "checked";
				}
				
				var content = `
					<tr>
                      	<td align="center" style="width: 50px;" class="no">` + no + `</td>
                      	<td class="mb-3">                          
                          <select flag="prod_name" ref-filed='[{"name":"prod_name","from":"prod_name"}]' class="form-control mb-12 input-sm field-item prod-id-`+no+`" old_name="prod_id" name="prod_id_new"  value="`+ row.prod_id +`" style="width:90%;">
                            </select>
                      	</td>
                      	<td align="center" class="mb-2">
                           ` + row.item_qty + `
                      	</td>
                      	<td align="right" class="mb-3">
                           ` + row.prod_price + `
                          </td>
                      	<td align="right" class="mb-3">
                          ` + row.sub_total + `
                      	</td>
                      	<td align="center" style="width: 90px;">                      		
                      		<input type="checkbox" name="item_isflashsale" ` + item_isflashsale + ` class="check-green check-flashsale field-item">                                                       		
                      	</td>
                  	</tr>
				`;
				me.data_items[idx].no = no;
				table.find('tbody').append(content);				
				table.find('tbody tr:last').data(row);							
				$('.prod-id-'+no).select2({			
					placeholder:'',
					dropdownParent: "#modal-workin",
					ajax: {
					    url: app.data.site_url + '/inventory/purchase/search_product',
					    dataType: 'json',
					    type:'GET',
					    data: function (params) {
					      var query = {
					        f_search: params.term,		
					        pid:row.prod_id
					      }				      
					      return query;
					    },
					    processResults: function (data) {				      
					      return {
					        results: data.data
					      };
					    }
					  }
				});						
				var $newOption = $("<option></option>").val(row.prod_id).text(row.prod_name);
				$('.prod-id-'+no).append($newOption).trigger('change');
				$('.prod-id-'+no).select2('data', {id: row.prod_id, text: row.prod_name});
				no++;
			});

		},
		change_value_items:function(cmp)
		{
			var me = this,
				row = cmp.parents("tr"),
				name_field = cmp.prop("name"),
				type_field = cmp.prop("type"),
				ref_field = JSON.parse(cmp.attr("ref-filed")),
				flag_field = cmp.attr("flag");
			try
			{
				var data = row.data(),
					index_upd = me.data_items.findIndex(function(row){
						return row.id_gen == data.id_gen
					});
				var value = "";
				switch(type_field)
				{
					case "checkbox":
						value = 0;
						if (cmp.prop("checked"))
						{
							value = 1;
						}
						break;
					default:
						value = cmp.val();
						break;
				}

				if (flag_field == "prod_name")
				{
					var params = {
						id:value
					}
					if (index_upd != -1) 
					{
						app.requestAjax(app.data.site_url+"/transaction/forstok/app/check_product",params,"POST",function(result) {						
							try
							{	
								var stock_akhir = 0;
								if ("data" in result)
								{																		

									stock_akhir = app.ifvalnull(result.data.stock_akhir,0);
									me.data_items[index_upd][name_field] = value;
									if ("length" in ref_field)
									{
										ref_field.forEach(function(row) {
											me.data_items[index_upd][row.name] = result.data[row.from];
										})
									}
								}

								var no = me.data_items[index_upd]["no"],
									row = $('.prod-id-'+no).parents("tr");

								if (stock_akhir == 0)
								{							
									swal("Information","Stok barang "+ me.data_items[index_upd]["prod_name"] +" kosong","info");
									me.data_items[index_upd]["stock_empty"] = true;								
									if (row.length > 0){
										$(".btn-action-process").addClass("disabled");										
										row.addClass('bg-warning-light');
										row.data("toggle","tooltip");
										row.attr("title","Stok kosong!");										
										row.find('.no').html("<i class='fa fa-info cursor text-color-red'></i> "+no);
									}
																																			
								}
								else
								{									
									me.data_items[index_upd]["stock_empty"] = false;	
									if (row.length > 0){																				
										row.removeClass('bg-warning-light');
										row.data("toggle","");
										row.attr("title","");										
										row.find('.no').html(no);
									}
								}							

							}
							catch(e1)
							{
								console.debug(e1);
							}
						});
					}
				}
				else
				{

					if (index_upd != -1) 
					{
						me.data_items[index_upd][name_field] = value;					
					}
				}

			}
			catch(e)	
			{
				console.debug(e);
			}
		},
		add_cost:function()
		{
			var me = this,
				date = new Date(),
				row_cost = {
					id_gen:"idg-" + date.getTime(),					
					trx_cost_type:"",
					trx_cost_price:"",
					trx_id:$('#modal-workin').find("[name=trx_id]").val(),
				};
				me.data_cost.push(row_cost);
				me.generated_cost();
		},		
		generated_cost:function(is_load)
		{
			var me = this,
				table = $(".table-cost-type");				
				tbody = table.find("tbody"),
				no = 1;
				ship = ['','shipping','packing'];
			tbody.html("");
			try
			{
				me.data_cost.forEach(function(row){
					var content = `
						<tr>
							<td>` + no + `</td>
			                <td>		                      
		                      <select class="form-control field-cost js-example-basic-single trx_cost_type" name="trx_cost_type" style="width: 350px;" value="`+ app.ifvalnull(row.trx_cost_type,"") +`">
	                      </select>
			                </td>
			                <td>
			                    <input type="text" class="form-control field-cost item-cost text-right" name='trx_cost_price' value="` + app.ifvalnull(row.trx_cost_price,"") + `">
			                </td>
			                <td>
			                  	<button type="button" class="btn btn-outline-danger btn-delete-cost-type"><i class="fa fa-trash"></i></button>
			                </td>
		                </tr>
					`;
					no++;
					tbody.append(content);
					table.find("tbody tr:last").data(row);

				});			
				app.get_data_list(".trx_cost_type",app.data.site_url+"/master/simplelist/cost_type",{},{
				  	display_value:'text',
				  	value:'id'
				});
			}
			catch(e)
			{
				
			}
		},
		change_value_cost:function(cmp)
		{
			var me = this,
				row = cmp.parents("tr"),
				name_field = cmp.prop("name");			
			try
			{
				var data = row.data(),
					index_upd = me.data_cost.findIndex(function(row){
						return row.id_gen == data.id_gen
					});

				if (index_upd != -1) 
				{					
					me.data_cost[index_upd][name_field] = cmp.val();					
				}								
			}
			catch(e)	
			{
				console.debug(e);
			}
		},		
		del_cost:function(row)
		{
			var me = this,
				modal = $('#modal-workin'),
				table = modal.find(".table-cost-type"),		
				tbody = table.find("tbody");

			swal({
			  	title: "Delete data?",					  
			  	icon: "warning",
			  	buttons: true,
			  	buttons: ["Cancel", "Delete"],
			  	dangerMode: true,
			})
			.then((isDelete) => {
			  if (isDelete) {					    				
					try
					{
						var data = row.data(),
							index_delete = me.data_cost.findIndex(function(row){
								return row.id_gen == data.id_gen
							});

						if (index_delete != -1) 
						{
							me.data_cost.splice(index_delete,1);
							me.generated_cost();
						}
						else
						{
							swal({
								title: "Informasi",
								text: "Index data not found!",
								icon:"info"
							});
						}
					}
					catch(e)
					{
						console.debug(e);
					}
			  }
			});
		},
		mapping_state: function()
		{
			var me = this,
				field_cost = $(".list-state-trx"),
				list_field_state  = field_cost.find(".field-state"),
				index_state = -1;

			list_field_state.prop("checked",false);
			list_field_state.attr("disabled",false);						

			me.data_state.forEach(function(row){
				try
				{
					var cmp = field_cost.find('[name='+ row.trx_log_caption +']');

					if (cmp)
					{
						var new_index = parseInt(cmp.attr("order"));
						if (new_index > index_state)
						{
							index_state = new_index;
						}
					}					
				}
				catch(e)
				{

				}
			});
			
			if (index_state != -1)
			{				
				for (var i = 0; i < list_field_state.length; i++) {
					if (i < index_state)
					{
						var cmp = $(list_field_state[i]);												
						cmp.prop("checked",true);
						cmp.attr("disabled",true);
					}
				}
			}
				
		},
		get_data_state:function()
		{
			var me = this,
				data = [],
				modal = $('#modal-workin'),
				field_cost = modal.find(".list-state-trx"),
				list_field_state = field_cost.find(".field-state");

			for (var i = 0; i < list_field_state.length; i++) {
				var cmp = $(list_field_state[i]);												
				if (!cmp.prop("disabled") && cmp.prop("checked"))
				{					
					data.push({
						name:cmp.prop("name"),
						order:cmp.attr("order"),
						value:1
					});
				}
			}

			data.sort(function(a,b){
				return parseInt(a.order) > parseInt(b.order);
			});

			return data;
		},
		process_trx: function()
		{
			var me = this,
				modal = $('#modal-workin'),
				form = modal.find('.form-detail-transaction');
				formData = new FormData(form[0]);


			app.body_mask();
			if (form.valid())
			{

				var has_stokc_empty = me.data_items.findIndex(function(row) {
					return app.ifvalnull(row.stock_empty,false) == true;
				});


				if(has_stokc_empty == -1)
				{
					formData.set("data_items",JSON.stringify(me.data_items));
					formData.set("data_cost",JSON.stringify(me.data_cost));
					formData.set("data_state",JSON.stringify(me.get_data_state()));

					setTimeout(function(){
						app.requestAjaxForm(app.data.site_url+"/transaction/forstok/app/process",formData,"POST",function(result){
							if (result.success)
							{
								swal("Information",result.msg,"success");
								$('#modal-workin').modal("hide");
								me.load_list();					
							}
							else
							{
								swal("Information",result.msg,"warning");
							}	
							app.body_unmask();
						});
					},500);

				}
				else
				{
					swal("Information","Periksa kembali stok barang!","warning");					
					app.body_unmask();
				}
			}
			else
			{
				app.body_unmask();
			}


		},
		close_trx: function(close)
		{
			var me = this,
				modal = $('#modal-workin-close'),
				form = modal.find('.form-close-transaction');
				formData = new FormData(form[0]);

			app.body_mask();
			if (form.valid())
			{
				formData.set("flag",close.attr("flag"));
				setTimeout(function(){
					app.requestAjaxForm(app.data.site_url+"/transaction/forstok/app/close_transaction",formData,"POST",function(result){
						if (result.success)
						{
							swal("Information",result.msg,"success");
							$('#modal-workin-close').modal("hide");							
						}
						else
						{
							swal("Information",result.msg,"warning");
						}	
						me.load_list(true);
						app.body_unmask();
					});
				},500);
			}
			else
			{
				app.body_unmask();
			}
		},
		change_state: function(cmp) {
			var me = this,
				field_name = cmp.prop("name"),
				modal = $("#modal-workin");

			try
			{					
				
					if (modal.find(".field-state-"+field_name).length > 0)
					{
						var content = modal.find(".field-state-"+field_name);	
						if (cmp.prop("checked"))
						{					
							content.removeClass('hidden');
							content.find('.ref-field-state').attr("required",true);
						}	
						else
						{
							content.addClass('hidden');
							content.find('.ref-field-state').removeAttr("required");
						}
					}

			}
			catch(e)
			{

			}


		},
		selected: {},
		id: '',
		url: '',		
		firstLoad:{
			data_list:false
		},
		start:0,
		data_items:[],
		data_cost:[],
		data_state:[],
		isLoad: false,
	};

	app.loader(main_forstok);
});