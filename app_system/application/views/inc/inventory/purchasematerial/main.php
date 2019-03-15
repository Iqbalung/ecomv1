
<div class="page-main page-transaksi-forstok">
    <div class="container-fluid">
        <!--page title-->
        <div class="pg-header">
            <div class="col-md-12">
                <div class="row">               
                    <div class="col-md-7">              
                        <h4>Stok Material</h4>
                    </div>
                    <div class="col-md-4 padding-5">                
                        <!-- <div class="input-group">
                                <input type="text" class="form-control f-search" placeholder="Search...">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-success bg-white btn-f-search" type="button"><i class="fa fa-search"></i></button>
                                </div>
                            </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="pg-header">
            <div class="col-md-12">
                <div class="row">               
                    <div class="col-md-6">              
                        <h4 class="weight500 d-inline-block pr-3 mr-3 border-right"> Transaction</h4>
                        <nav aria-label="breadcrumb" class="d-inline-block ">
                            <ol class="breadcrumb p-0">
                                <li class="breadcrumb-item"><a href="#">Log material In</a></li>
                            </ol>
                        </nav>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 padding-5">                
                        <div class="input-group">
                            <input type="text" class="form-control f-search" placeholder="Suplier/Invoice Number">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-success bg-white btn-f-search" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-2 padding-5">                
                        <div class="input-group">
                            <input type="text" class="form-control f-date-start input-date date-from" placeholder="01/01/1900" value="">    
                        </div>
                    </div>
                     <div class="col-md-2 padding-5">                
                        <div class="input-group">
                            <input type="text" class="form-control f-date-start input-date date-to" placeholder="01/01/2020" value="">
                            
                        </div>
                    </div>
                    <div class="col-md-2 pull-right text-right">
                         
                    </div>
                    <div class="col-md-3 pull-right text-right"> 
                        <button type="button" class="btn btn-info btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Print
                        </button>
                    </div>
                </div>
            </div>
        </div>                    
        <br>
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-shadow mb-4">
                    <div class="card-body- pt-3 pb-4">
                        <div class="table-responsive" style="margin-top: -15px;">
                            <table id="table-transaction" class="table table-bordered table-striped" cellspacing="0" style="margin-top: -10px;">
                                <thead style="margin-top: : -130px;background-color: gray;color: white;overflow-x: hidden;margin-top: -10px;">
                                    <tr>
                                        <th>No</th>
                                        <th style="width: 90px;">Suplier</th>
                                        <th>Invoice Number</th>
                                        <th>Date</th>
                                        <th>Source</th>
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

<?php $this->view("inc/inventory/stockin/modal"); ?>

<script type="text/javascript" src="<?php echo config_item('url_app') ?>js/modules/inventory/stockin.js"></script>