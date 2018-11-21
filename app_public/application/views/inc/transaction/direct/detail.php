<!--main content wrapper-->
<div class="page-main page-transaksi-forstok">
    <div class="container-fluid">
        <!--page title-->
        <div class="pg-header">
          <div class="col-md-12">
                <div class="row" style="padding-bottom: 10px;">               
                    <div class="col-md-6">              
                        <h4 class="weight500 d-inline-block pr-3 mr-3 border-right">Detail Transaction</h4>
                        <nav aria-label="breadcrumb" class="d-inline-block ">
                            <ol class="breadcrumb p-0">
                                
                            </ol>
                        </nav>  
                    </div>
                </div>
          </div>
        </div>    
        <div class="row">          
           <div class="col-md-12">
              <div class="col-md-12">
                
              </div>     
              <div class="col-md-12 bg-white">        
                <form class="form-detail-transaction">
                  <input type="hidden" name="trx_id" class="hidden">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Invoice</label>
                            <br>
                            <b><input type="text" readonly class="form-control invoice-number" name="trx_id"></b><br>
                            <label for="recipient-name" class="col-form-label">Customer</label>
                            <br>
                            <b><span type="html" name="trx_customer"></span></b><br>
                            <label for="recipient-name" class="col-form-label">email</label>
                            <br>
                            <b><span type="html" name="trx_customer_email"></span></b><br>
                            <label for="recipient-name" class="col-form-label">Phone</label>
                            <br>
                            <b><span type="html" name="trx_shipping_phone"></span></b>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Shiping to</label>
                            <br>
                           <b> <span type="html" name="trx_shipping_address_1"></span>,
                              <span type="html" name="distric_text"></span>,
                             <span type="html" name="city_text"></span> <br>
                             <span type="html" name="province_text"></span>,
                              <span type="html" name="trx_shipping_code"></span>
                            </b>

                          
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Waybill</label>
                            <br>
                           <b> <span type="html" name="waybill"></span>,
                            </b>

                          
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Meidasale</label>
                            <br>
                            <b><span type="html" name="mos_name"></span></b><br>
                            <label for="recipient-name" class="col-form-label">Mediasale Invoice Number</label>
                            <br>
                            <b><span type="html" name="trx_invoice_mos"></span></b><br>
                            <label for="recipient-name" class="col-form-label">Payment Method</label>
                            <br>
                            <b><span type="html" name="trx_payment_method"></span></b><br>
                            <label for="recipient-name" class="col-form-label">Payment Term</label>
                            <br>
                            <b><span type="html" name="trx_payment_term"> </span>  <span type="html" name="trx_card_number"></span> - <span type="html" name="trx_bank"></span></b>

                            <br>
                            <label for="recipient-name" class="col-form-label">Author</label>
                            <br>
                            <b><span type="html" name="user_username"> </span></b>
                            

                        </div>
                        <div class="form-group list-state-trx">
                          <label>Status</label>
                            <ul>
                              <li>
                                <div>
                                    <input type="checkbox" readonly checked order="1" name="ready_to_package" class="iCheck field-state" >
                                    <label class="  control-label">Pending</label>
                                </div>
                              </li>
                              <li>
                                <div>
                                    <input type="checkbox" readonly order="2" name="ready_to_ship" class="iCheck field-state" >
                                    <label class="control-label">READY TO SHIP</label>
                                </div>
                              </li>
                              <li>
                                <div>
                                    <input type="checkbox" readonly order="3" name="shipped" class="iCheck field-state" >
                                    <label class="control-label">SHIPPED</label>
                                </div>
                              </li>
                              <li>
                                <div>
                                    <input type="checkbox" readonly order="4" name="delivered" class="iCheck field-state" >
                                    <label class="control-label">DELIVERED</label>
                                </div>
                              </li>
                              <li>
                                <div>
                                    <input type="checkbox" readonly order="5" name="completed" class="iCheck field-state" >
                                    <label class="control-label">COMPLETED</label>
                                </div>
                              </li>
                            </ul>
                        </div>
                    </div>
                  </div>
                  <div class="form-group group-ref-field-state field-state-shipped hidden">
                      <label for="message-text" class="col-form-label">Awbill</label>
                      <input type="text" class="form-control ref-field-state" name='trx_shipping_code' required="required">
                  </div>
                  <div class="form-group">
                      <label for="message-text" class="col-form-label">Special Instuction</label>
                      <input type="text" readonly class="form-control" name='trx_notes'>
                  </div>
                </form>                                        
                <table class="table table-bordered table-striped table-items-transaction" cellspacing="0">
                    <thead>
                        <tr >
                            <th class="text-center" style="width: 50px;">No</th>
                            <th align="center" class="text-center mb-3">Nama Pruduct</th>
                            <th align="center" class="text-center mb-2">Qty</th>
                            <th align="center" class="text-center mb-3">Price</th>
                            <th align="center" class="text-center mb-3">Subtotoal</th>
                            <th align="center" style="width: 90px;">Flashsale</th>
                        </tr>
                    </thead>
                    <tbody class="row-biaya">  
                        
                    </tbody>
                </table>
                <br>
                <hr>                            
                <div class="mb-12">
                  <div class="mb-6">
                    
                  </div>
                  <div class="mb-6 pull-right">
                      <button type="button"  class="btn btn-outline-success btn-add-cost-type"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
                 <table class="table table-bordered table-striped table-cost-type" cellspacing="0">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th class="mb-7" align="center">Jenis Biaya</th>
                              <th class="mb-5" align="center">Subtotoal</th>
                              <th style="width: 60px;"></th>
                          </tr>
                      </thead>
                      <tbody>  
                          
                      </tbody>
                  </table>
              </div>
           </div>
        </div>
</div>
<!--  <div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="coba" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 800px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="coba">Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form><div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Customer</label>
                            <select class="form-control js-example-basic-single" name="state" style="width: 350px;">
                              <option value="AL"></option>
                              <option value="AL">Doni</option>
                              <option value="WY">Maman</option>
                              <option value="WY">Rahmat</option>
                              <option value="WY">Yabes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Shipping</label>
                            <select class="form-control js-example-basic-single" name="state" style="width: 350px;">
                              <option value="AL"></option>
                              <option value="AL">JNE</option>
                              <option value="WY">TIKI</option>
                              <option value="WY">Grab</option>
                              <option value="WY">wiki</option>
                            </select>
                            
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Note</label>
                    <input type="text" class="form-control" name='harga' >
                </div>
                </form>
                <div class="pull-right">
                    <button type="button" data-toggle="modal"  class="btn btn-outline-success add-biaya">+</button>
                </div>
                <br>
                 <table id="data_tablex" class="table table-bordered table-striped" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="width: 90px;">Cost</th>
                                    <th>Subtotoal</th>
                                </tr>
                            </thead>
                            <tbody class="row-biaya">  
                                <tr>
                                <td>1</td>
                                <td>
                                    <select class="form-control js-example-basic-single" name="state" style="width: 350px;">
                                      <option value="AL"></option>
                                      <option value="AL">Shiping</option>
                                      <option value="WY">Tax</option>
                                      <option value="WY">Merchant Commision</option>
                                    </select>
                                </td>
                                <td>
                                     <input type="text" class="form-control" name='harga' >
                                </td>
                            </tr>
                            </tbody>
                        </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Process</button>
            </div>
        </div>
    </div>
</div> -->

<script type="text/javascript" src="<?php echo config_item('url_app') ?>js/modules/transaction/detail_transaction.js"></script>