<div class="ps-hero bg--cover" data-background="images/hero/shop-1.jpg" style="background: url(&quot;images/hero/shop-1.jpg&quot;);">
    <div class="container-fluid">
    <div class="container-fluid" style="background: #eeeeee42; height: 120px;margin-top: -55px;border-radius: 5px;padding-top: 5px;">
        <form action="do_action" method="post" >
            <div class="form-group"  >
                <div class="col-md-2">
                    <label>Kategori</label>
                    <select class="form-control f-category" name="f-category" style="width: 100%;height: 48px !important;">
                        <option>Testing</option>
                    </select>
                </div>
                <div class="col-md-3">
                      <label>Kata Kunci</label>
                    <input class="form-control" type="text" placeholder="Keyword">
                </div>
                <div class="col-md-2">
                    <label>Pria / Wanita</label>
                    <select class="form-control select2" name="" style="width: 100%;height: 48px !important;">
                        <option>Pria & Wanita</option>
                        <option>Pria</option>
                        <option>Wanita</option>
                    </select>
                </div>
                <div class="col-md-2">
                     <label>Urutkan Berdasarkan</label>
                    <select class="form-control select2" name="" style="width: 100%;height: 48px !important;">
                        <option>Harga Produk</option>
                        <option>Harga Produk</option>
                        <option>Nama Produk</option>
                        <option>Favorit</option>
                        <option>Favorit</option>
                        <option>Rating</option>
                    </select>
                </div>
                <div class="col-md-2">
                     <label>Urutkan Dari</label>
                    <select class="form-control select2" name="" style="width: 100%;height: 48px !important;">
                        <option>Dari Yang Terbesar</option>
                        <option>Dari Yang Terkecil</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <br>
                <button class="btn btn-danger" style="height: 42px;width: 60px;"><i class="fa fa-search" style="font-size: 16px;"></i></button>
                </div>
            </div>
        </form> 
    </div>
</div>
</div>   

<main class="ps-main" style="margin-top: -150px;">
    <div class="container-fluid ps-product-grid">    
    </div>
</main>
<script type="text/javascript" src="<?php echo config_item('url_app') ?>js/modules/product/main.js"></script>