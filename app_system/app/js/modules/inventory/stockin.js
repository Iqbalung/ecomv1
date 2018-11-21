$(document).ready(function() {
	var stockin = {
		load: {
			css: [

			],
			js: [

			],
			success: function() {
				stockin.init();
				stockin.listeners();
			}		
		},
		init: function() {
			var me = this,
				params = me.get_params();
				
			me.load_list();
			
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

			$('[aria-label="Page navigation"]').delegate('.pagination a', 'click', function(event) {
				event.preventDefault();
				stockin.start = $(this).attr('data-ci-pagination-page');
				me.load_list();
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

			$('#table-transaction').delegate('.btn-action-workin', 'click', function(event) {
				event.preventDefault();
				try
				{
					var data = $(this).parents("tr").data();
					me.get_detail_transaction(data.buy_id);
					$('#modal-workin').modal({backdrop:'static'});
				}catch(e)
				{
					console.debug(e);
				}

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

			$('#modal-workin').delegate('.table-items-transaction .field-item', 'change', function(event) {				
				me.change_value_items($(this));								
			});

			$('#modal-workin').delegate('.table-cost-type .field-cost', 'change', function(event) {
				me.change_value_cost($(this));
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
				"f_date_from":$(".date-from").val(),
				"f_date_to":$(".date-to").val(),
				m: stockin.start,
				per_page: stockin.start
			};

			return params;
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
					url: app.data.site_url + '/inventory/stockin/get',
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
							var no = parseInt(stockin.start)+1;
							result.data.forEach(function(row) {
								var state = `<a class="btn btn-sm btn-info btn-pill pl-2 pr-2 btn-action-workin">Detail</a>`;
								if (app.ifvalnull(row.trx_state_flag,"") == "close")
								{
									state = `<a href="#" class="btn btn-sm btn-sucess btn-pill pl-2 pr-2">Transaksi Closed (by `+ app.ifvalnull(row.user_username,"system") +`)</a>`;
								}
								var content = `
									<tr>
	                                    <td>` + no + `</td>
	                                    <td width="400">
	                                        ` + row.suplier_name + `
	                                    </td>
	                                    <td>
	                                        ` + row.buy_id + `
	                                    </td>
	                                    <td>
	                                        ` + row.buy_datecreated + `
	                                    </td>
	                                     <td>
	                                        ` + row.buy_source
 + `
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

			app.requestAjax(app.data.site_url+"/inventory/stockin/get_detail_transaction",{id:id},"POST",function(result){
				if (result)
				{
					var form = modal.find('.form-detail-transaction');
						app.clear_form('#modal-workin .form-detail-transaction');
					if ('data' in result)
					{						
						app.set_form_value($('.form-detail-transaction'),result.data);
						me.data_items = result.data_items;
						me.data_cost = result.data_cost;
						me.data_state = result.data_state;
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
				table = modal.find(".table-items-transaction");				
				table.find("tbody").html("");
			var no = 1;
			me.data_items.forEach(function(row){
				row.id_gen = "id_gen_item-" + (new Date()).getTime();
				var item_isflashsale = "";
				if (row.item_isflashsale == 1)
				{
					item_isflashsale = "checked";
				}
				var content = `
					<tr>
                      	<td align="center">` + no + `</td>
                      	<td>
                          <span	class="text-title text-color-dark">` + row.prod_name + `</span>
                      	</td>
                      	<td align="center">
                           ` + row.prod_stock + `
                      	</td>
                      	<td align="right">
                           ` + row.buy_price + `
                          </td>
                      	<td align="right">
                          ` + row.sub_total + `
                      	</td>
                  	</tr>
				`;

				table.find('tbody').append(content);				
				table.find('tbody tr:last').data(row);				
				no++;
			});

		},
		change_value_items:function(cmp)
		{
			var me = this,
				row = cmp.parents("tr"),
				name_field = cmp.prop("name"),
				type_field = cmp.prop("type");
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
						value = cmp.value();
				}

				if (index_upd != -1) 
				{
					me.data_items[index_upd][name_field] = value;					
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
				modal = $('#modal-workin'),
				table = modal.find(".table-cost-type");				
				tbody = table.find("tbody"),
				no = 1;
				ship = ['','shipping','packing'];
			tbody.html("");
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
				modal = $('#modal-workin'),
				field_cost = modal.find(".list-state-trx"),
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
						value:1
					});
				}
			}

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

	app.loader(stockin);
});