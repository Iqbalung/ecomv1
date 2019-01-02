 <div class="breadcrumbs  no-margin">
  <div class="container">

    <div class="row">
      <div class="col-xs-12">
       
       
      </div>
    </div>
  </div>
</div>
<div class="container">

<div class="row">
      <!-- <input  type="text" value="155" name="destination" id="destination" disabled="disabled" /> -->
     
      <div class="col-md-12">
       <div class="col-md-6">
          <div class="panel-heading">
            <h3 class="panel-title">Tujuan</h3>
          </div>
          <div class="panel-body">
            <input type="hidden" value="5" class="form-control" name="propinsi_tujuan" id="propinsi_tujuan">
             <br>
             <?= $this->session->userdata('alamat'); ?><br>
             


            
           
          <br>
          <input type="hidden" value="39" class="form-control" name="destination" id="destination">
           
          </div>
		   <div class="panel-heading">
            <h3 class="panel-title">Kurir</h3>
          </div>
          <div class="panel-body">
           <?php 

         $sum = 80;
           ?>
            <br>
            
            <input type="hidden" name="berat" placeholder="gram" id="berat" value="<?php  echo $sum; ?>" class="form-control">
           
            <select class="form-control" name="courier" id="courier">
              <option value="">Pilih Kurir</option>
              <option value="jne">JNE</option>
              <option value="pos">POS</option>
              <option value="tiki">TIKI</option>
            </select>
          <br>
            <button type="button" onclick="tampil_data('data')" class="btn btn-info">Cek Ongkir</button>

            <a href="<?= base_url()?>index.php/index/checkout" class="btn btn-danger">Kirim Ke Alamat Lain</a>          </div>
       
        <script>
          function tampil_data(act){
                var w = $('#origin').val();
                var x = $('#destination').val();
                var y = $('#berat').val();
                var z = $('#courier').val();

                $.ajax({
                    url: "<?= base_url()?>index.php/rajaongkir/getCost",
                    type: "GET",
                    data : {origin: w, destination: x, berat: y, courier: z},
                    success: function (ajaxData){
                        //$('#tombol_export').show();
                        //$('#hasilReport').show();
                        $("#hasil").html(ajaxData);
                    }
                });
            };
        </script>
		  </div><div class="row">
      <div class="col-md-6">
      
         
      </div>

      <div class="col-md-6">
        <div class="">
          <div class="panel-heading">
            <h3 class="panel-title">Hasil</h3>
          </div>
          <div class="panel-body">
            <ol>
              <div id="hasil">
                
              </div>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/JQuery.min.js"></script>

<script>
$(document).ready(function(){

  $("#propinsi_asal").click(function(){
    $.post("<?php echo base_url(); ?>index.php/rajaongkir/getCity/"+$('#propinsi_asal').val(),function(obj){
      $('#origin').html(obj);
    });
      
  });

  $("#propinsi_tujuan").click(function(){
    $.post("<?php echo base_url(); ?>index.php/rajaongkir/getCity/"+$('#propinsi_tujuan').val(),function(obj){
      $('#destination').html(obj);
    });
      
  });

  /*
  $("#cari").click(function(){
    $.post("<?php echo base_url(); ?>index.php/rajaongkir/getCost/"+$('#origin').val()+'&dest='+$('#destination').val()+'&berat='+$('#berat').val()+'&courier='+$('#courier').val(),function(obj){
      $('#hasil').html(obj);
    });
  });

  */

  
});
</script>
</div>

</body>
</html>