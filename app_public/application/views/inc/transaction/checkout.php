
<div class="container">
    <div class="row bs-wizard" style="border-bottom:0;">
        <div class="col-xs-4 bs-wizard-step active">
          <div class="text-center bs-wizard-stepnum">Konfirmasi Pesanan</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center"></div>
        </div>
        
        <div class="col-xs-4 bs-wizard-step disabled"><!-- complete -->
          <div class="text-center bs-wizard-stepnum">Pembayaran</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center"></div>
        </div>
        
        <div class="col-xs-4 bs-wizard-step disabled"><!-- complete -->
          <div class="text-center bs-wizard-stepnum">Konfirmasi Pembayaran</div>
          <div class="progress"><div class="progress-bar"></div></div>
          <a href="#" class="bs-wizard-dot"></a>
          <div class="bs-wizard-info text-center"></div>
        </div>
    </div>
</div>

<div class="container-fluid">
	<div class="col-md-6">
  Dikirim Ke
   <p><?php print_r($this->session->userdata('user')['alamat']); ?></p>
   <p><?php print_r($this->session->userdata('user')['no_hp']); ?></p>
   <form id="form-calculate">
      <label for="recipient-name" class="col-form-label">Province</label>
      <select required class="form-control select2" id="province" name="province">
      </select>
      <label for="recipient-name" class="col-form-label">City</label>
      <select required class="form-control select2" id="city" name="city">
      </select>
      <label for="recipient-name" class="col-form-label">Distric</label>
      <select required class="form-control select2" id="distric" name="distric">
      </select>
      <label for="exampleFormControlInput1">Postal Code</label>
      <input required type="text" class="form-control" name="trx_shipping_code">
    </form>
      <button class="btn btn-danger" type="submit" id="btn-calculate">Hitung Pengiriman</button>
      <table class="table table-striped">
    <thead>
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody id="courier">
      
    </tbody>
  </table>
	</div>
	<div class="col-md-6">

		<table class="table table-striped">
    <thead>
      <tr>
        <th>Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody id="shopping-table">
      
    </tbody>
    </table>
    <br>

     <button class="btn btn-confirm btn-warning btn-block" >Konfirmasi Pemesanan</button>
   

	</div>


</div>
<script type="text/javascript" src="<?php echo config_item('url_app') ?>js/modules/transaction/checkout.js"></script>