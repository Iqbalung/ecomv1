 <div class="container">
 <div style="width:1200px;" aria-labelledby="shopping-cart" id="shopping-list2">
   <!--  <li><span class="ps-product--shopping-cart"><a class="ps-product__thumbnail" href="product-detail.html"><img src="<?php echo base_url('media_front'); ?>/images/cart/1.jpg" alt=""></a><span class="ps-product__content"><a class="ps-product__title" href="#">T-shirt blue with slogan</a><span class="ps-product__quantity">1 x <span> $5250.00</span></span>
        </span><a class="ps-product__remove" href="#"><i class="fa fa-trash"></i></a></span>
    </li>
    <li><span class="ps-product--shopping-cart"><a class="ps-product__thumbnail" href="product-detail.html"><img src="<?php echo base_url('media_front'); ?>/images/cart/2.jpg" alt=""></a><span class="ps-product__content"><a class="ps-product__title" href="#">T-shirt blue with slogan</a><span class="ps-product__quantity">1 x <span> $5250.00</span></span>
        </span><a class="ps-product__remove" href="#"><i class="fa fa-trash"></i></a></span>
    </li> -->
    

</div>
<br>
	<div class="total row">
	    <div class="col-md-6">
	    <a class="ps-btn" href="<?php echo base_url('index.php/transaction/app/checkout_proses') ?>">Checkout Proses</a>
	   <?php  if($this->session->userdata('user')==""){ ?>
		
	    <a class="ps-btn btn-info" href="<?php echo base_url('index.php/transaction/app/checkout_proses_nonuser') ?>">Checkout Without Login</a>
	    
	<?php } ?>
	    </div>
	</div>
	
	

								



</div>