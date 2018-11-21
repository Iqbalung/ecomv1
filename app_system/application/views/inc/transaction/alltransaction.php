
<div class="page-main page-transaksi-forstok">
    <div class="container-fluid">
        <!--page title-->
        <div class="pg-header">
            <div class="col-md-12">
                <div class="row" style="padding-bottom: 10px;">               
                    <div class="col-md-6">              
                        <h4 class="weight500 d-inline-block pr-3 mr-3 border-right">Transaction</h4>
                        <nav aria-label="breadcrumb" class="d-inline-block ">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item"><a href="#">Show All Transaction</a></li>
                            </ol>
                        </nav>  
                    </div>
                   <div class="col-md-6">
                        <div class="pull-right">  
                            <button class="btn btn-sucess btn-flat btn-box bg-green btn-lg" id="btn-import">Import</button>
                            <button type="button" class="btn btn-success btn-flat btn-box bg-green btn-lg add-item"><i class='fa fa-plus fa-lg' style=''></i></button>
                        </div>                        
                   </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-md-3 padding-5">                
                        <div class="input-group">
                                <input type="text" class="form-control f-search" placeholder="Search...">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-success bg-white btn-f-search" type="button"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                    </div>
                     <div class="col-md-2 padding-5">                
                        <div class="input-group">
                                <select class="form-control input-sm js-example-basic-single f-select" name="f-select" style="width: 350px;">
                              <option selected value="">All</option>
                              <option value="direct">Direct</option>
                              <option value="auto">Forstock</option>
                            </select>
                            </div>
                    </div>
                    <div class="col-md-3 padding-5">                
                        <div class="input-group">
                            <select class="form-control input-sm js-example-basic-single f-select" name="f-select" style="width: 350px;">
                              <option selected value="">All</option>
                              <option value="pending">Pending</option>
                              <option value="ready_to_package">Ready to Package</option>
                              <option value="ready_to_ship">Ready to Shipped</option>
                              <option value="shipped">Shiped</option>
                              <option value="deliverd">Deliverd</option>
                              <option value="awaiting_payment">Awaiting payment</option>
                              <option value="completed">Completed</option>
                            </select>
                        </div>
                    </div>
                     <div class="col-md-2 padding-5">                
                        <div class="input-group">
                            <input type="text" class="form-control f-date-start input-date date-from" value="<?php echo "01/01/2018" ?>">
                          
                        </div>
                    </div>
                     <div class="col-md-2 padding-5">                
                        <div class="input-group">
                            <input type="text" class="form-control f-date-start input-date date-to" value="<?php echo date('d/m/Y'); ?>">
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <br>              
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-shadow mb-4">
                    <div class="card-body pt-3 pb-4">
                        <div class="table-responsive">
                            <table style="margin-right: 10px;" id="table-transaction" class="table table-bordered table-striped" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Invoice</th>
                                        <th>Type</th>
                                        <th style="width: 90px;">Mediasale</th>
                                        <th>Date</th>
                                        <th>State</th>
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

<?php $this->view("inc/transaction/modal"); ?>

<script type="text/javascript" src="<?php echo config_item('url_app') ?>js/modules/transaction/alltransaction.js"></script>