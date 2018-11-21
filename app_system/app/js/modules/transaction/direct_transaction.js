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
				var rand = function() {
					    return Math.random().toString(36).substr(2); // remove `0.`
					};
				var token =function generateCode() {
				  text = '';
				  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

				  for ( var i=0; i < 7; i++ ) {
				    text += possible.charAt(Math.floor(Math.random() * possible.length));
				  }
				  console.log(text);
				   return 'ANY-'+text;
				}
				$(".invoice-number").val(token);
				$.ajax({
			    type: 'POST',
			  	url: app.data.site_url + '/transaction/Direct/get_product_by_name',
				    success: function (data) {
				        data = JSON.parse(data);
				         $.each(data.data, function(index,value) {
				          $( ".product-name" ).append( "<option value="+value.id+">"+value.text+"</option>");
				        });
				    },
				    beforeSend: function() {    
				    }
				});


				app.submit_form('#trx-direct', '#btn-pay', function() {
					if ($('#trx-direct').valid()) { // cek is valid
						var formData = new FormData($('#trx-direct')[0]);
						formData.append("city_text",$("#city option:selected").text());
						formData.append("province_text",$("#province option:selected").text());
						formData.append("distric_text",$("#distric option:selected").text());
						
						swal({
						  	title: "Are You Sure ?",					  
						  	icon: "warning",
						  	buttons: true,
						  	buttons: ["Cancel", "Yes"],
						  	dangerMode: true,
						})
						.then((isDelete) => {
						  if (isDelete) {	
						  					    
								$.ajax({
									url: app.data.site_url + '/transaction/Direct/save',
									method: "POST",
									data: formData,
									async: false,
									cache: false,
									contentType: false,
									processData: false,
								})
								.done(function(data) {
									var obj = $.parseJSON(data);								
									try
									{
										swal("","Transaction Success","success");
										//window.location.reload();
									}
									catch(e)
									{
										swal("","Transaction Failed","warning");
									}									
								});			
						  	}
						});
						
					}
				});


				$.ajax({
				    type: 'POST',
				  	url: app.data.site_url + '/master/Simplelist/unit',
				    success: function (data) {
				        data = JSON.parse(data);
				         $.each(data.data, function(index,value) {
				          $( ".unit" ).append( "<option value="+value.id+">"+value.text+"</option>");
				        });
				    },
				    beforeSend: function() {    
				    }
				})	

				app.get_data_list("[name=province]",app.data.site_url+"/master/Simplelist/call_province",{},{
				  	display_value:'province',
				  	value:'province_id'
				});


				


				$.ajax({
				    type: 'POST',
				  	url: app.data.site_url + '/master/Simplelist/payment_method',
				    success: function (data) {
				        data = JSON.parse(data);
				         $.each(data.data, function(index,value) {
				          $( "#payment" ).append( "<option value="+value.id+">"+value.text+"</option>");
				        });
				    },
				    beforeSend: function() {    
				    }
				})	

				$.ajax({
				    type: 'POST',
				  	url: app.data.site_url + '/master/Simplelist/payment_term',
				    success: function (data) {
				        data = JSON.parse(data);
				         $.each(data.data, function(index,value) {
				          $( "#payment_term" ).append( "<option value="+value.id+">"+value.text+"</option>");
				        });
				    },
				    beforeSend: function() {    
				    }
				})	

				$.ajax({
				    type: 'POST',
				  	url: app.data.site_url + '/master/Simplelist/mediasale',
				    success: function (data) {
				        data = JSON.parse(data);
				         $.each(data.data, function(index,value) {
				          $( "#mediasale" ).append( "<option value="+value.id+">"+value.text+"</option>");
				        });
				    },
				    beforeSend: function() {    
				    }
				})	
			}		
		},
		init: function() {
			var me = this;
			$(".debtcard").hide();
            $("#option_s1").select2();
            $("#payment").select2();
            $('.product-name').select2();
		},
		listeners: function() {
			$( ".add-biaya" ).click(function() {
	          	$('.row-biaya').append(`
	             	<tr>
	                    <td>1</td>
	                    <td>
	                        <select class="form-control input-sm js-example-basic-single" name="state" style="width: 350px;">
	                          <option value="AL"></option>
	                          <option value="AL">Pengiriman</option>
	                          <option value="WY">Pajak</option>
	                          <option value="WY">Biaya Merchant</option>
	                        </select>
	                    </td>
	                    <td>
	                        <input type="text" class="form-control input-sm" name='harga' >
	                    </td>
                	</tr>
	            `);
        	});


			$( "#city" ).change(function(){
				id = $(this).val();
				app.get_data_list("[name=distric]",app.data.site_url+"/master/Simplelist/call_distric",{city_id:id},{
				  	display_value:'subdistrict_name',
				  	value:'subdistrict_id'
				});
			});

			$( "#payment" ).change(function(){
				id = $(this).val();
				if(id=="credit_card" || id=="debit" ){
					$(".debtcard").show();
				}else{
					$(".debtcard").hide();
				}
			});



			$( "#province" ).change(function(){
				id = $(this).val();
				app.get_data_list("[name=city]",app.data.site_url+"/master/Simplelist/call_city",{province_id:id},{
				  	display_value:'city_name',
				  	value:'city_id'
				});
			});
        	$( ".add-item" ).click(function() {
        		var sum = $('.product-name').length;
        		sum = parseInt(sum)+1;
        		var selected = sum;
        		$.ajax({
			    type: 'POST',
			  	url: app.data.site_url + '/transaction/Direct/get_product_by_name',
				    success: function (data) {
				        data = JSON.parse(data);
				        $(`.product-name-`+sum ).select2();
				         $.each(data.data, function(index,value) {
				          $( `.product-name-`+sum ).append( "<option value="+value.id+">"+value.text+"</option>");
				        });
				    },
				    beforeSend: function() {    
				    }
				})

				$.ajax({
				    type: 'POST',
				  	url: app.data.site_url + '/master/Simplelist/unit',
				    success: function (data) {
				        data = JSON.parse(data);
				         $.each(data.data, function(index,value) {
				          $( ".unit" ).append( "<option value="+value.id+">"+value.text+"</option>");
				        });
				    },
				    beforeSend: function() {    
				    }
				})	

          		$('.row-trx').append(`
             		<tr>
                        <td class="idnum">`+sum+`</td>
                        <td>
                            <select class="form-control input-sm product-name product-name-`+sum+` " name="prod_id[]">
                            </select>
                        </td>
                        <td>
                            <select class="form-control input-sm unit unit-`+sum+`" name="unit[]">
                           	</select>
                        </td>
                        <td><input type="number" class="form-control input-sm prod_price price price-`+sum+`" price="`+sum+`" name="prod_price[]"></td>
                        <td><input type="number" class="form-control input-sm qty qty-`+sum+`" qty="`+sum+`" name="qty[]"></td>
                        <td><input type="number" class="form-control input-sm diskon diskon-`+sum+`" value="0" diskon="`+sum+`"  name="diskon[]"></td>
                        <td><input readonly type="number" class="form-control input-sm subtotal subtotal-`+sum+`" name="subtotal[]"></td>
                    </tr>
            	`);
        	});
	        
	       $( ".row-trx" ).delegate( ".prod_price", "keyup", function() {
	       		id = $(this).attr("price");
	       		price = parseFloat($('.price-'+id).val());
	       		console.log(price);
	       		diskon = parseFloat($('.diskon-'+id).val());
	       		console.log(diskon);
	       		qty = parseFloat($('.qty-'+id).val());
	       		console.log(qty);
	       		subtotal = (qty*price)-diskon;
	       		console.log(subtotal);
	       		$('.subtotal-'+id).val(subtotal);
	           	var sum = 0;
				$('.subtotal').each(function(){
				    sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
				});
	       		$('.total').val(sum);
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

	        $( ".row-trx" ).delegate( ".qty", "keyup", function() {
	       		id = $(this).attr("qty");
	       		price = parseFloat($('.price-'+id).val());
	       		console.log(price);
	       		diskon = parseFloat($('.diskon-'+id).val());
	       		console.log(diskon);
	       		qty = parseFloat($('.qty-'+id).val());
	       		console.log(qty);
	       		subtotal = (qty*price)-diskon;
	       		console.log(subtotal);
	       		$('.subtotal-'+id).val(subtotal);
	           	var sum = 0;
				$('.subtotal').each(function(){
				    sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
				});
				$('.total').val(sum);
	        });

	        $( ".row-trx" ).delegate( ".diskon", "keyup", function() {
	       		id = $(this).attr("diskon");
	       		price = parseFloat($('.price-'+id).val());
	       		console.log(price);
	       		diskon = parseFloat($('.diskon-'+id).val());
	       		console.log(diskon);
	       		qty = parseFloat($('.qty-'+id).val());
	       		console.log(qty);
	       		subtotal = (qty*price)-diskon;
	       		console.log(subtotal);
	       		$('.subtotal-'+id).val(subtotal);
	           	var sum = 0;
				$('.subtotal').each(function(){
				    sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
				});
				$('.total').val(sum);
	        });

	    
	        $( ".row-trx" ).delegate( ".code", "keyup", function() {
			  	$.ajax({
				    type: 'POST',
				  	url: app.data.site_url + '/transaction/Direct/get_product_by_code',
				  	data:{
				  		code : $('.code').val()
				  	},
				    success: function (data) {
				        data = JSON.parse(data);
				        sum = $('.product-name').length;;
// 				         $( `.product-name-`+sum ).val(data[0]['prod_id']);
// 				         $( `.product-name-`+sum ).trigger('change.select2');
				    },
				    beforeSend: function() {    
				    }
				})	
			});
		},
		get_item_trx:function() {
			var rows = $(".row-trx tr"),
				data = [];
			try
			{
				for (var i = 0; i < rows.length; i++) {
					var item = $(rows[i])
				}
			}
			catch(e)
			{
				console.debug(e);
			}
		},
		selected: {},
		id: '',
		url: '',
		isLoad: false,
	};

	app.loader(direct_transaction);
});