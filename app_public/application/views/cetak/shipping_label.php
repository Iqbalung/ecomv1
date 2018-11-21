<?php 
$data = array();
 ?>
<br><br><br>
<br><br><br>
<br>
 <table border="1" cellpadding="0" cellspacing="0">
 	<tr>
 		<td style="width: 95%"> 			
			<table style="border:solid 1pt #f56e21;font-size: 10pt;" border="1" cellpadding="5">
				<thead>	
					<tr>
						<td colspan="3" style="text-align: center;"><b><u>Shipping Label</u></b></td>
					</tr>
					<tr>
						<td style="width: 55%;text-align: center;"><b>Product Name</b></td>			
						<td style="width: 20%;text-align: center;"><b>Qty</b></td>
						<td style="width: 25%;text-align: center;"><b>Package Qty</b></td>			
					</tr>
				</thead>
				<tbody>
					<?php 
						if (isset($items) && is_array($items))
						{
							$no = 1;
							foreach ($items as $key => $value) {
						?>
							<tr>
								<td style="width: 55%;"><?php echo $no." ".ifunsetempty($value,"prod_name",""); ?></td>					
								<td style="width: 20%;"><?php echo ifunsetempty($value,"item_qty",""); ?></td>
								<td style="width: 25%;"><?php echo ifunsetempty($value,"item_qty",""); ?> Koli/DUs</td>
							</tr>		
						<?php	
							$no++;
							}	
						}			
					 ?>
				</tbody>
			</table>
 		</td> 		
 		<td style="width: 5%" rowspan="4"></td>
 	</tr>
 	<tr>
 		<td style="width: 95%"> 			
			<br>
			<table>
				<tr>
					<td><b>Shipping To</b></td>		
				</tr>	
				<tr>
					<td><b><?php echo $no." ".ifunsetempty($trx,"trx_customer",""); ?></b></td>
				</tr>
				<tr>
					<td>
						<div >
						<?php echo ifunsetempty($trx,"trx_shipping_address_1",""); ?><br>		
						<?php echo ifunsetempty($trx,"distric_text","-"); ?> <br>
						<?php echo ifunsetempty($trx,"city_text","-"); ?>, <br>
						<?php echo ifunsetempty($trx,"province_text","-"); ?>, <br>
						(<?php echo ifunsetempty($trx,"trx_shipping_code","-"); ?>)
						</div>						
						<?php echo ifunsetempty($trx,"trx_shipping_phone","-"); ?> 
					</td>
				</tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
				<tr><td></td></tr>
			</table>	
 		</td> 		
 	</tr>
 	<tr>
 		<td style="width: 95%">
 			<table border="1">	
				<tr>
					<td style="width: 40%" rowspan="5">
						<br>
						&nbsp;Logistic<br>
						&nbsp;<?php echo ifunsetempty($trx,"trx_courier_name","Gojek"); ?> 
					</td>
					<td style="width: 60%;text-align: center;" rowspan="5">
						<br>
						Service
					</td>
					<td style="width: 0px">
						
					</td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td></td>
				</tr>
				<tr>
					<td></td>
				</tr>
			</table>
 		</td> 		
 	</tr>
 	<tr>
 		<td style="width: 95%">
 			<table>
				<tr>
					<td colspan="4"></td>
				</tr>
				<tr>
					<td style="width: 4%"></td>
					<td style="width: 32%">
						<img src="<?php echo $this->config->item('path_client').'images/shipping_label1.png' ?>">
					</td>		
					<td style="width: 32%">
						<img src="<?php echo $this->config->item('path_client').'images/shipping_label2.png' ?>">
					</td>		
					<td style="width: 32%">
						<img src="<?php echo $this->config->item('path_client').'images/shipping_label3.png' ?>">
					</td>
				</tr>
				<tr>
					<td colspan="4">
						<table>
							<tr>
								<td colspan="3"></td>
							</tr>
							<tr>
								<td style="width: 5%;"></td>
								<td rowspan="5" style="font-size: 15px;width: 90%;">
									Terimakasih atas kepercayaan anda terhadap produk Anya-Living, kami tunggu pemesanan anda berikutnya	
								</td>
								<td style="width: 5%;"></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
							</tr>				
							<tr>
								<td></td>
								<td></td>
							</tr>	
							<tr>
								<td></td>
								<td></td>
							</tr>	
							<tr>
								<td></td>
								<td></td>
							</tr>	
							<tr>
								<td colspan="3" style="text-align: center;font-size: 15px;">
									www.anya-living.com
								</td>
							</tr>				
						</table>
					</td>
				</tr>		
			</table>
 		</td> 		
 	</tr> 	
 </table>	

