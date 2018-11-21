<div class="page-main page-transaksi-forstok">
    <div class="container-fluid">
        <div class="pg-header">
            <div class="col-md-12">
                <div class="row">               
                    <div class="col-md-6">              
                        <h4 class="weight500 d-inline-block pr-3 mr-3 border-right"> Transaction</h4>
                        <nav aria-label="breadcrumb" class="d-inline-block ">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item"><a href="#">Manage  Transaction</a></li>
                            </ol>
                        </nav>  
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-5 padding-5">                
                        <div class="input-group">
                            <input type="text" class="form-control f-search" placeholder="Search...">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-success bg-white btn-f-search" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 padding-5">                
                        <div class="input-group">
                                <select class="form-control input-sm js-example-basic-single f-select" name="f-select" style="width: 350px;">
                              <option selected value="">All State</option>
                              <option value="hold">Hold</option>
                              <option value="ready_to_ship">Ready to Shipped</option>
                              <option value="shipped">Shiped</option>
                              <option value="delivered">Delivered</option>
                              <option value="awaiting_payment">Awaiting payment</option>
                              <option value="completed">Completed</option>
                            </select>
                            </div>
                    </div>
                     <div class="col-md-2 padding-5">                
                        <div class="input-group">
                            <input type="text" class="form-control f-date-start input-date date-from" placeholder="01/01/1990" value="">    
                        </div>
                    </div>
                     <div class="col-md-2 padding-5">                
                        <div class="input-group">
                            <input type="text" class="form-control f-date-start input-date date-to" placeholder="01/01/2020"  value="">
                            
                        </div>
                    </div>
                    
                </div>

                <div class="row" style="margin: 20px -5px 20px -15px;">
                    <div class="col-md-3 padding-5">                
                        <div class="input-group">
                            <select class="form-control input-sm  f-mediasale" id="mediasale" name="f-mediasale" style="width: 350px;">
                              <option selected value="">All Mediasale</option>
                            </select>
                         </div>
                    </div>
                    <div class="col-md-3 padding-5">                
                        <div class="input-group">
                            <select class="form-control input-sm js-example-basic-single f-select" name="f-select" style="width: 350px;">
                                <option selected value="">Al Method</option>
                                <option value="direct">Direct</option>
                                <option value="auto">Import</option>
                            </select>
                        </div>
                    </div>
                    
                </div>

                 <br>
                 <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-1" >
                        <button class="btn btn-warning btn-flat btn-box bg-green btn-lg btn-block" id="btn-import">Import</button>
                    </div>
                     <div class="col-md-1 pull-right text-right" style="margin-right: 25px;">
                          <div class="btn-group">
                            <button type="button" class="btn btn-danger btn-lg dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Change State
                            </button>
                            <div class="dropdown-menu grup-btn-action-close">
                                <a class="dropdown-item btn-action-close" id="btn-workin-hold" href="#">Hold</a>
                                <a class="dropdown-item btn-action-close" id="btn-workin-ready_to_ship" href="#">Ready To Ship</a>
                                <a class="dropdown-item btn-action-close" id="btn-workin-shipped" href="#">Shipped</a>
                                <a class="dropdown-item btn-action-close" id="btn-workin-delivery" href="#">Delivery</a>
                                <a class="dropdown-item btn-action-close" id="btn-workin-completed" href="#">Completed</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-1 pull-right text-right">
                          <div class="btn-group">
                            <button type="button" class="btn btn-info-secondary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Print
                            </button>
                            <div class="dropdown-menu grup-btn-action-close">
                                <a class="dropdown-item btn-action-close" id="btn-multy-invoice" href="#">Invoice</a>
                                <a class="dropdown-item btn-action-close" id="btn-multy-shippinglabel" href="#">Shipping Label</a>
                                <a class="dropdown-item btn-action-close" id="btn-multy-suratjalan" href="#">Surat Jalan</a>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-md-">
                        <a href="<?php echo site_url() ?>/transaction/direct" class="btn btn-sucess btn-flat btn-box bg-green btn-lg" >Add</a>
                    </div>
                    
                </div>
            </div>
        </div>
        <br>              
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-shadow mb-4">
                    <div class="card-body- pt-3 pb-4">
                        <div class="table-responsive bg-navy effect1" style="z-index: 100;margin-top: -15px;">
                            <table style="overflow: hidden;margin-top: -10px;z-index: 100;position: absolute;" class="table table-bordered table-striped" cellspacing="0">
                                <thead style="margin-top: : -130px;background-color: gray;color: white;overflow-x: hidden;">
                                    <tr>
                                        <th style="width: 10px;">No</th>
                                        <th style="width: 310px;">Mediasale</th>
                                        <th style="width: 100px;">Invoice Number</th>
                                        <th style="width: 60px;">Date</th>
                                        <th style="width: 80px;">Item</th>
                                        <th style="width: 100px;">address</th>
                                        <th style="width: 90px;">State</th>
                                        <th style="width: 80px;">Total (RP)  </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="table-responsive" style="height: 500px;overflow: scroll;margin-top:20px; ">
                            <br>
                            <table style="margin-top: 10px;margin-right:40px;height: 100px;overflow: scroll;" id="table-transaction" class="table table-bordered table-striped" cellspacing="0">
                                <thead style="display: none;">
                                    <tr>
                                        <th style="width: 10px;">No</th>
                                        <th style="width: 290px;">Mediasale</th>
                                        <th style="width: 120px;">Invoice Number</th>
                                        <th style="width: 60px;">Date</th>
                                        <th style="width: 80px;">Item</th>
                                        <th style="width: 120px;">address</th>
                                        <th style="width: 80px;">State</th>
                                        <th style="width: 120px;">Total   </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="row-trx">                                           
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <nav aria-label="Page navigation" id="nav" style="padding: 0 10px;">
                                
                            </nav>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>        
<script type="text/javascript">
    $(document).ready(function(){
        $('#origin_province').change(function(){
 
            var province_id=$('#origin_province').val();
            $.get('<?php echo site_url('simplelist/get_city_by_province/') ?>'+province_id, function(resp){
                // console.log(resp);
                $('#origin_city').html(resp);
            });
        });
    });
 
 
    // menampilkan kota tujuan pengiriman
    $(document).ready(function(){
        $('#destination_provice').change(function(){
 
            var province_id=$('#destination_provice').val();
            $.get('<?php echo site_url('simplelist/get_city_by_province/') ?>'+province_id, function(resp){
                // console.log(resp);
                $('#destination_city').html(resp);
            });
        });
    });
</script>
<?php $this->view("inc/transaction/forstok/modal"); ?>
<script type="text/javascript" src="<?php echo config_item('url_app') ?>js/modules/transaction/forstok/main.js"></script>