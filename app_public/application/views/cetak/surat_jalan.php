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
				<div style="border:solid 10pt #f56e21;line-height: 22px;"><b>Surat Jalan</b>&nbsp;&nbsp;</div>
			</div>
		</td>
		<td style="width: 20%;"></td>
	</tr>
</table>

<table cellpadding="3"st >
	<tr>
		<td style="width: 50%">
			<table>
				<tr>
					<td sty4e="width: 50%;"><u><b>Send To</b></u></td>
					<td></td>
					<td></td>
				</tr>
				<tr>					
					<td style="width: 40%;"><b>Name</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 60%;"><?php echo ifunsetempty($trx,"trx_customer","-"); ?></td>
				</tr>
				<tr>
					<td style="width: 40%;"><b>Address</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 60%;" rowspan="2">
						<?php echo ifunsetempty($trx,"trx_shipping_address_1","-"); ?>,
						<?php echo ifunsetempty($trx,"trx_shipping_prov","-"); ?>, 
						<?php echo ifunsetempty($trx,"trx_shipping_city","-"); ?>, 
						<?php echo ifunsetempty($trx,"trx_shipping_zip","-"); ?> -
						<?php echo ifunsetempty($trx,"trx_shipping_phone","-"); ?> 
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td style="width: 40%;"><b>Contact</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 60%;"><?php echo ifunsetempty($trx,"trx_contact","Dwi Adi"); ?></td>
				</tr>
				<tr>
					<td style="width: 40%;"><b>Phone</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 60%;"><?php echo ifunsetempty($trx,"trx_shipping_phone","-"); ?></td>
				</tr>				
				<tr>
					<td style="width: 40%;"><b>PO Number </b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 60%;"><?php echo ifunsetempty($data,"trx_id","-"); ?></td>
				</tr>
				<tr>
					<td style="width: 40%;"><b>Reference</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 60%;"><?php echo ifunsetempty($data,"nama","ProjectGP"); ?></td>
				</tr>						
			</table>
		</td>
		<td style="width: 55%">
			<table>
				<tr>
					<td sty4e="width: 50%;"></td>
					<td></td>
					<td></td>
				</tr>
				<tr>					
					<td style="width: 40%;"><b>No.</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 60%;"><?php echo ifunsetempty($trx,"trx_invoice2","ANY-SJ-101/2018/IV/WBW"); ?></td>
				</tr>
				<tr>
					<td style="width: 40%;"><b>Date</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 60%;"><?php echo ifunsetempty($trx,"trx_date","25-Apr-18"); ?></td>
				</tr>
				<tr>					
					<td style="width: 40%;"><b>Invoice No.</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 60%;"><?php echo ifunsetempty($trx,"trx_invoice","ANY-SJ-101/2018/IV/WBW"); ?></td>
				</tr>				
				<tr>
					<td style="width: 40%;"><b>Rep.</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 60%;"><?php echo ifunsetempty($trx,"nama","Oky Sulistyo"); ?></td>
				</tr>
				<tr>
					<td style="width: 40%;"><b>Phon</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 60%;"><?php echo ifunsetempty($trx,"nama","08193819472"); ?></td>
				</tr>
				<tr>
					<td style="width: 40%;"><b>Delivery date </b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 60%;"><?php echo ifunsetempty($trx,"date_delivered","25-Apr-18"); ?></td>
				</tr>
				<tr>
					<td style="width: 40%;"><b>Intercon</b></td>
					<td style="width: 10px;">:</td>
					<td style="width: 60%;"><?php echo ifunsetempty($trx,"nama","Delivered to Dekoruma  Warehouse"); ?></td>
				</tr>								
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			Dengan ini kami menyatakan bahwa telah menyerahkan barang dengan jumlah dan deskripsi sebagai berikut :				
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
				$no = 1;
				foreach ($items as $key => $value) {
			?>
				<tr>
					<td style="width: 35%;"><?php echo $no." ".ifunsetempty($value,"prod_name",""); ?></td>
					<td style="width: 25%;"><?php echo ifunsetempty($value,"prod_desc",""); ?></td>
					<td style="width: 15%;"> <?php echo ifunsetempty($value,"prod_price",""); ?> </td>
					<td style="width: 10%;"><?php echo ifunsetempty($value,"item_qty",""); ?></td>
					<td style="width: 15%;">IDR <?php echo (ifunsetempty($value,"prod_price",0)*ifunsetempty($value,"item_qty",0)); ?></td>
				</tr>		
			<?php	
				$no++;
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
		<td style="width: 100%">
			<table>				
				<tr>		
					<td style="width: 35%;border:solid 1pt #f56e21;" rowspan="6">		
						<div style="height: 100%;font-size: 9pt;">
							&nbsp;<u>Special Note:</u>		
						</div>
					</td>
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
	</tr>
</table>	
<table>
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

<table cellpadding="5" cellspacing="0">
	<tr>
		<td style="width: 20%">
			<b style="font-size: 9px;text-align: right;">Diserahkan Oleh</b>
		</td>
		<td style="width:30%;border-bottom:solid 10pt #f56e21;border-top:solid 10pt #f56e21;">
			
		</td>
		<td style="width: 20%">
			<b style="font-size: 9px;text-align: right;">Diterima Oleh</b>
		</td>
		<td style="width:30%;border-bottom:solid 10pt #f56e21;border-top:solid 10pt #f56e21;">
			
		</td>
	</tr>
	<tr>
		<td style="width: 20%">
			<b style="font-size: 9px;text-align: right;">Tanggal</b>
		</td>
		<td style="width:30%;border-bottom:solid 10pt #f56e21;border-top:solid 10pt #f56e21;">
			
		</td>
		<td style="width: 20%">
			<b style="font-size: 9px;text-align: right;">Tanggal</b>
		</td>
		<td style="width:30%;border-bottom:solid 10pt #f56e21;border-top:solid 10pt #f56e21;">
			
		</td>
	</tr>
</table>