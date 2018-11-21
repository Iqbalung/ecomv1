$(document).ready(function() {
	var direct_transaction = {
		load: {
			css: [

			],
			js: [

			],
			success: function() {
				direct_transaction.init();
				direct_transaction.listeners();
								
			}		
		},
		init: function() {
			var me = this;
            $("#option_s1").select2();
            $("#payment").select2();
            $('.prod-id').select2();
            $('.prod-id').select2();

            $('.prod-id').select2({					
				ajax: {
				    url: app.data.site_url + '/inventory/purchase/search_product',
				    dataType: 'json',
				    type:'GET',
				    data: function (params) {
				      var query = {
				        f_search: params.term,					        
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

			app.get_data_list(".unit",app.data.site_url+"/master/simplelist/unit",{},{
				  	display_value:'text',
				  	value:'id'
				});

				app.get_data_list(".warehouse",app.data.site_url+"/master/warehouse/get_all",{},{
				  	display_value:'wr_name',
				  	value:'wr_id'
				});
		
			$.ajax({
			    type: 'POST',
			  	url: app.data.site_url + '/master/Simplelist/payment_method',
			    success: function (data) {
			        data = JSON.parse(data);
			         $.each(data.data, function(index,value) {
			          $( "#payment" ).append( "<option name='l_letter' value="+value.id+">"+value.text+"</option>");
			        });
			    },
			    beforeSend: function() {    
			    }
			})	

			$.ajax({
			    type: 'POST',
			  	url: app.data.site_url + '/inventory/Purchase/get_suplier_by_name',
			    success: function (data) {
			        data = JSON.parse(data);
			         $.each(data.data, function(index,value) {
			          $( "#suplier" ).append( "<option name='l_letter' value="+value.id+">"+value.text+"</option>");
			        });
			    },
			    beforeSend: function() {    
			    }
			})	
        
		},
		listeners: function() {


			app.submit_form('#trx-direct', '#btn-pay', function() {
				if ($('#trx-direct').valid()) { // cek is valid
					var formData = new FormData($('#trx-direct')[0]);
					swal({
					  	title: "Are You Sure ?",					  
					  	icon: "info",
					  	buttons: true,
					  	buttons: ["Cancel", "Yes"],								  	
					})
					.then((isYes) => {
					  	if (isYes)
					  	{	
							app.body_mask();
							app.requestAjaxForm(app.data.site_url + '/inventory/Purchase/save',formData,"POST",function(result){
								app.body_unmask();												    
								if (result.success) {
									swal({
										title: "Informasi!",
										text: result.msg,
										icon: "success",
									});
									setTimeout(function(){ location.reload(); }, 300);					
								}else{							
									swal({
										title: "Informasi!",
										text: result.msg,
										icon: "warning",
									});
								}								
							});
						}
					});						
				}
			});

			$( ".add-item" ).click(function() {
        		var sum = $('.prod-id').length;
        		sum = parseInt(sum)+1;
        		var selected = sum;

          		$('.row-trx').append(`
             		<tr row="` + sum + `">
                        <td class="idnum">`+sum+`</td>                        
                        <td>
                            <select class="form-control input-sm prod-id prod-id-`+sum+`" name="prod_id[]">
                            </select>
                        </td>                        
                        <td>
	                        <select class="form-control input-sm warehouse-`+sum+`" name="wr_id[]" style="width: 100%;">
	                        </select>
	                    </td>
                        <td><input type="number" class="form-control field-calc input-sm buy_price price price-`+sum+`" price="`+sum+`" name="buy_price[]"></td>
                        <td><input type="number" class="form-control field-calc input-sm prod_stock prod_stock-`+sum+`" prod_stock="`+sum+`" name="prod_stock[]"></td>                        
                        <td><input type="number" class="form-control input-sm subtotal subtotal-`+sum+`" name="subtotal[]"></td>
                    </tr>
            	`);
        	
          	
        		$('.prod-id-'+sum).select2({					
					ajax: {
					    url: app.data.site_url + '/inventory/purchase/search_product',
					    dataType: 'json',
					    type:'GET',
					    data: function (params) {
					      var query = {
					        f_search: params.term,					        
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

				app.get_data_list(".unit-"+sum,app.data.site_url+"/master/simplelist/unit",{},{
				  	display_value:'text',
				  	value:'id'
				});

				app.get_data_list(".warehouse-"+sum,app.data.site_url+"/master/warehouse/get_all",{},{
				  	display_value:'wr_name',
				  	value:'wr_id'
				});
	       });

        	$( ".row-trx" ).delegate( ".field-calc", "keyup", function() {
	       	
	       		var id = $(this).parents("tr").attr("row"),
	       			price = parseFloat($('.price-'+id).val()),	       		       			
	       			prod_stock = parseFloat($('.prod_stock-'+id).val()),	       		
	       			subtotal = (prod_stock*price),
	       			sum = 0;

	       		if (isNaN(subtotal))
	       		{
	       			subtotal = 0;
	       		}
	       		$('.subtotal-'+id).val(subtotal);	           	

				$('.subtotal').each(function(){
				    sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
				});
				if (isNaN(sum))
	       		{
	       			sum = 0;
	       		}
	       		$('.total').val(sum);	
	        });
	 	       
		},	
		selected: {},
		id: '',
		url: '',
		isLoad: false,
	};

	app.loader(direct_transaction);
});