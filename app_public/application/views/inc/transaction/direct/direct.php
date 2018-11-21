<!--main content wrapper-->
<div class="container-fluid">
    <!--page title-->
    <div class="page-title mb-4 d-flex align-items-center">
        <div class="mr-auto">
            <h4 class="weight500 d-inline-block pr-3 mr-3 border-right">Direct Transaction</h4>
            <nav aria-label="breadcrumb" class="d-inline-block ">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item"><a href="#">Add Direct Transaction</a></li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="pull-right">
                    <button type="button" class="btn btn-outline-success add-item"><i class='fa fa-plus fa-lg' style=''></i></button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <button type="button"  data-toggle="modal" id="btn-pay" class="btn btn-outline-success">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card card-shadow mb-4">
                <form id="trx-direct">
                    <div class="card-body- pt-3 pb-4">
                        <div class="table-responsive">
                            <div class="row" style="padding: 10px;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Invoice Number</label>
                                        <input type="text" readonly class="form-control invoice-number" name="invoice_number">
                                        <label for="exampleFormControlInput1">Date</label>
                                        <input type="text" class="form-control input-date" name="trx_date" placeholder="">
                                        
                                        
                                        <label for="exampleFormControlInput1">Customer Name</label>
                                        <input required type="text" class="form-control" name="trx_customer">
                                        
                                        <label for="exampleFormControlInput1">Contact Number</label>
                                        <input required type="text" class="form-control" name="trx_shipping_phone">

                                        <label for="exampleFormControlInput1">Email</label>
                                        <input required type="text" class="form-control" name="trx_customer_email">
                                        

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

                                        <label for="exampleFormControlInput1">Shipping Address</label>
                                        <input required type="text" class="form-control" name="trx_shipping_address_1">

                                        <label for="exampleFormControlInput1">Sepecial Instruction / Notes</label>
                                        <input required type="text" class="form-control" name="trx_notes">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Total</label>
                                        <input required type="text" name="total" readonly class="form-control total" placeholder="">
                                        <label for="recipient-name" class="col-form-label">Mediasale</label>
                                        <select required class="form-control select2" id="mediasale" name="trx_mos">
                                        </select>

                                        <label for="exampleFormControlInput1">Invoice Number Mediasale</label>
                                        <input required type="text" name="trx_invoice_mos" class="form-control" placeholder="">
                                        
                                        <label for="recipient-name" class="col-form-label">Metode Pembayaran</label>
                                        <select required class="form-control select2" id="payment" name="trx_payment_method">
                                        </select>
                                        <label for="exampleFormControlInput1" class="debtcard">Bank</label>
                                        <input required type="text" class="form-control debtcard" name="bank">
                                        <label for="exampleFormControlInput1" class="debtcard">Card Number</label>
                                        <input required type="text" class="form-control debtcard" name="trx_card_number">
                                        <label for="recipient-name" class="col-form-label">TRX Payment Term</label>
                                        <select required class="form-control select2" id="payment_term" name="trx_payment_term">
                                        </select>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div  style="padding: 10px;">
                                <table id="data_tablex" class="table table-bordered table-striped" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <!--  <th style="width: 90px;">Barcode</th> -->
                                            <th style="width: 90px;">Product</th>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>QTY</th>
                                            <th>Discount</th>
                                            <th>Subtotoal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-trx">
                                        <tr>
                                            <td>1</td>
                                            <!--  <td><input required type="text" idx="1" class="form-control input-sm code prod-code-1"  name="prod_code[]"></td> -->
                                            <td>
                                                <select required class="form-control input-sm select2 product-name product-name-1" id="product-name" name="prod_id[]" style="width: 350px;">
                                                </select>
                                            </td>
                                            <td>
                                                <select required class="form-control input-sm unit select2" name="unit[]" style="width: 100px;">
                                                </select>
                                            </td>
                                            <td>
                                                <input required type="number" class="form-control input-sm prod_price price price-1" price="1"" name="prod_price[]">
                                            </td>
                                            <td>
                                                <input required type="number" class="form-control input-sm qty qty-1" qty="1" name="qty[]"></td>
                                            <td>
                                                <input required type="number" class="form-control input-sm diskon diskon-1" value="0" diskon="1"  name="diskon[]">
                                            </td>
                                            <td>
                                                <input required type="number" readonly class="form-control input-sm subtotal subtotal-1" name="subtotoal[]"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="coba" aria-hidden="true">
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
                            <select required class="form-control js-example-basic-single" name="state" style="width: 350px;">
                                <option value="AL"></option>
                                <option value="AL">Doni</option>
                                <option value="WY">Maman</option>
                                <option value="WY">Rahmat</option>
                                <option value="WY">Yabes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Shipping2</label>
                            <select required class="form-control js-example-basic-single" name="state" style="width: 350px;">
                                <option value="AL"></option>
                                <option value="AL">JNE</option>
                                <option value="WY">TIKI</option>
                                <option value="WY">Grab</option>
                                <option value="WY">wiki</option>
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Provinsi</label>
                            <select required class="form-control select2" id="payment" name="payment_method">
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
                            <select required class="form-control js-example-basic-single" name="state" style="width: 350px;">
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
</div>
<script type="text/javascript" src="<?php echo config_item('url_app') ?>js/modules/transaction/direct_transaction.js"></script>