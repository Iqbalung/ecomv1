<?php 
$data = array();
 ?>
<br><br><br>
<br><br><br>
<table>
	<tr>
		<td style="width: 20%;"></td>
		<td style="width: 60%;">
			<div style="text-align:center;width: 100%;">
				<div style="border:solid 10pt #f56e21;line-height: 22px;"><b>Invoice</b>&nbsp;&nbsp;</div>
			</div>
		</td>
		<td style="width: 20%;"></td>
	</tr>
</table>

<table cellpadding="3"st >
	<tr>
		<td style="width: 55%">
			<table>
				<tr>
					<td style="width: 55%;"><u><b>Invoice To</b></u></td>
					<td></td>
					<td></td>
				</tr>
				<tr>					
					<td style="width: 55%;"><b>Name</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 45%;"><?php echo ifunsetempty($trx,"customer_name","-"); ?></td>
				</tr>
				<tr>
					<td style="width: 55%;"><b>Address</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 45%;" rowspan="2">

						<?php echo ifunsetempty($trx,"trx_shipping_address_1","-"); ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td style="width: 55%;"><b>Contact</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 45%;"><?php echo ifunsetempty($trx,"trx_contact","-"); ?></td>
				</tr>
				<tr>
					<td style="width: 55%;"><b>Phone</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 45%;"><?php echo ifunsetempty($trx,"trx_shipping_phone","-"); ?></td>
				</tr>
				<tr>
					<td style="width: 55%;"><b>Email</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 45%;"><?php echo ifunsetempty($trx,"trx_customer_email","-"); ?></td>
				</tr>
				<tr>
					<td style="width: 55%;"><b>PO Number </b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 45%;"><?php echo ifunsetempty($data,"nama","-"); ?></td>
				</tr>
				<tr>
					<td style="width: 55%;"><b>Reference</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 45%;"><?php echo ifunsetempty($data,"nama","ProjectGP"); ?></td>
				</tr>						
			</table>
		</td>
		<td style="width: 45%">
			<table>
				<tr>
					<td style="width: 55%;"></td>
					<td></td>
					<td></td>
				</tr>
				<tr>					
					<td style="width: 55%;"><b>Invoice No.</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 45%;"><?php echo ifunsetempty($trx,"trx_invoice","-"); ?></td>
				</tr>
				<tr>
					<td style="width: 55%;"><b>Date</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 45%;"><?php echo ifunsetempty($trx,"trx_date","-"); ?></td>
				</tr>
				<tr>
					<td style="width: 55%;"><b>Payment Terms</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 45%;" rowspan="2"><?php echo ifunsetempty($trx,"trx_payment_term","-"); ?></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td style="width: 55%;"><b>Rep.</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 45%;"><?php echo ifunsetempty($trx,"nama","Oky Sulistyo"); ?></td>
				</tr>
				<tr>
					<td style="width: 55%;"><b>Delivery date </b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 45%;"><?php echo ifunsetempty($trx,"nama","6 ju 18"); ?></td>
				</tr>
				<tr>
					<td style="width: 55%;"><b>Intercon</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 45%;"><?php echo ifunsetempty($trx,"nama","Delivered to Dekoruma  Warehouse"); ?></td>
				</tr>								
			</table>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
</table>
<table>
	<tr>
		<td style="width: 55%">
			<table>
				<tr>
					<td style="width: 80%;border:solid 1pt #f56e21;" rowspan="5">
						<b style="line-height: 15px;">Delivery Detail :</b>						
						<div >

						<?php echo ifunsetempty($trx,"trx_shipping_address_1",""); ?><br>		
						<?php echo ifunsetempty($trx,"distric_text","-"); ?> <br>
						<?php echo ifunsetempty($trx,"city_text","-"); ?>, <br>
						<?php echo ifunsetempty($trx,"province_text","-"); ?>, <br>
						(<?php echo ifunsetempty($trx,"trx_shipping_code","-"); ?>)
						</div>						
					</td>
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
					<td></td>
					<td></td>				
				</tr>
			</table>
		</td>
		<td style="width: 45%"> 
			<table>
				<tr>
					<td style="width: 100%;border:solid 1pt #f56e21;font-size: 10pt;">
						<i>Special Notes and Instruction :</i>
					</td>					
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td style="width: 100%;border:solid 1pt #f56e21;" rowspan="4">												
						<div style="">
							<?php echo ifunsetempty($trx,"trx_notes",""); ?>
						</div>						
					</td>
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
			</table>
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
</table>
<table style="border:solid 1pt #f56e21;font-size: 10pt;" border="1" cellpadding="3">
	<thead>		
		<tr>
			<td style="width: 35%;background-color:#f9d99d;text-align: center;"><b>Product</b></td>
			<td style="width: 25%;background-color:#f9d99d;text-align: center;"><b>Product Description</b></td>
			<td style="width: 15%;background-color:#f9d99d;text-align: center;"><b>Unit Price</b></td>
			<td style="width: 10%;background-color:#f9d99d;text-align: center;"><b>QTY</b></td>
			<td style="width: 15%;background-color:#f9d99d;text-align: center;"><b>Amount</b></td>
		</tr>
	</thead>
	<tbody>
		<?php 
			if (isset($items) && is_array($items))
			{
				foreach ($items as $key => $value) {
			?>
				<tr>
					<td style="width: 35%;"><?php echo ifunsetempty($value,"prod_name",""); ?></td>
					<td style="width: 25%;"><?php echo ifunsetempty($value,"prod_desc",""); ?></td>
					<td style="width: 15%;"> <?php echo ifunsetempty($value,"prod_price",""); ?> </td>
					<td style="width: 10%;"><?php echo ifunsetempty($value,"item_qty",""); ?></td>
					<td style="width: 15%;">IDR <?php echo (ifunsetempty($value,"prod_price",0)*ifunsetempty($value,"item_qty",0)); ?></td>
				</tr>		
			<?php	
				}	
			}			
		 ?>
	</tbody>
</table>
<br>

<table>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td style="width: 56%">
			<table>				
				<tr>		
					<td style="width: 40%;border:solid 1pt #f56e21;" rowspan="6">		
						<div style="height: 100%;font-size: 9pt;">
							&nbsp;<b>Bank Details:</b>		
						</div>
					</td>
					<td style="width: 30%;border:solid 1pt #f56e21;" rowspan="6">		
						<div style="height: 100%;">
							&nbsp;<i style="font-size: 9pt">Seller's Signature:</i>		
						</div>
					</td>
					<td style="width: 30%;border:solid 1pt #f56e21;" rowspan="6">		
						<div style="height: 100%;">
							&nbsp;<i style="font-size: 9pt">Buyers's Signature:</i>								
						</div>
					</td>
					<td></td>		
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
				<tr>
					<td></td>		
				</tr>
				<tr>
					<td></td>		
				</tr>
			</table>	
		</td>
		<td style="width: 2%;"></td>
		<td style="width: 40%">
			<table cellpadding="2" style="font-size: 10px;">
				<tr>
					<td style="width: 40%"><b>Sub Total </b></td>
					<td>:</td>
					<td></td>
				</tr>
				<tr>
					<td style="width: 40%"><b>Tax </b></td>
					<td>:</td>
					<td></td>
				</tr>
				<tr>
					<td style="width: 40%"><b>Shipment </b></td>
					<td>:</td>
					<td></td>
				</tr>
				<tr style="">
					<td style="width: 40%"><b>Discount </b></td>
					<td>:</td>
					<td></td>
				</tr>
				<tr >
					<td colspan="4">
						<div style="border-bottom: 1px solid #f9d99d;line-height: 1px;width: 95%"></div>
					</td>					
				</tr>
				<tr>
					<td style="width: 40%;font-size: 12px;"><b>Total </b></td>
					<td>:</td>
					<td></td>
				</tr>
			</table>
		</td>
	</tr>
</table>	