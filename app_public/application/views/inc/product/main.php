<div class="ps-hero bg--cover" data-background="images/hero/shop-1.jpg" style="background: url(&quot;images/hero/shop-1.jpg&quot;);">
    <div class="container-fluid">
    <div class="container-fluid" style="background: #eeeeee42; height: 120px;margin-top: -55px;border-radius: 5px;padding-top: 5px;">
        <form  method="post" >
            <div class="form-group"  >
                <div class="col-md-2">
                    <label>Category</label>
                    <select class="form-control f-category f-select" name="f-category" style="width: 100%;height: 48px !important;">
                        <option>Testing</option>
                    </select>
                </div>
                <div class="col-md-3">
                      <label>Keyword</label>
                    <input class="form-control f-search" type="text" name="Keyword" placeholder="Keyword">
                </div>
                <div class="col-md-2">
                    <label>Mens / Woman</label>
                    <select class="form-control select2 f-select gender" name="gender" style="width: 100%;height: 48px !important;">
                        <option value="">Mens & Woman</option>
                        <option value="L">Mens</option>
                        <option value="P">Woman</option>
                    </select>
                </div>
                <div class="col-md-2">
                     <label>Sort By</label>
                    <select class="form-control select2 f-select sort" name="sort" style="width: 100%;height: 48px !important;">
                        <option value="product.prod_price">Price</option>
                        <option value="product.prod_name">Product Name</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label></label>
                    <select class="form-control select2 f-select sort_type" name="sort_type" style="width: 100%;height: 48px !important;">
                        <option value="asc">ASC</option>
                        <option value="desc">Desc</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <br>
                <button class="btn btn-danger bth-search" style="height: 42px;width: 60px;"><i class="fa fa-search" style="font-size: 16px;"></i></button>
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