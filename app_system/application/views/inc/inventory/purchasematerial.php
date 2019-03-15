<!--main content wrapper-->
<div class="container-fluid">
    <!--page title-->
    <div class="page-title mb-4 d-flex align-items-center">
        <div class="mr-auto">
            <h4 class="weight500 d-inline-block pr-3 mr-3 border-right">Purchase Material</h4>
            <nav aria-label="breadcrumb" class="d-inline-block ">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item"><a href="#">Add Prucahase Material Transaction</a></li>
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
                    <button type="button"  data-toggle="modal" id="btn-pay" class="btn btn-outline-success">Bayar</button>
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
                                        <label for="exampleFormControlInput1">PO. Number</label>
                                        <input type="text" class="form-control invoice-number" name="invoice_number">
                                        <label for="recipient-name" class="col-form-label">Suplier</label>
                                        <select class="form-control select2" id="suplier" name="suplier">
                                        </select>
                                        <label for="exampleFormControlInput1">Date</label>
                                        <input type="text" class="form-control input-date" placeholder="" name="buy_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Total</label>
                                        <input type="text" name="total" readonly class="form-control total" placeholder="">
                                        <label for="recipient-name" class="col-form-label">Payment Method</label>
                                        <select class="form-control select2" id="payment" name="payment_method">
                                        </select>
                                    </div>
                                </div>
                                <br>
                            </div>
                            <div style="padding: 10px;">
                                
                                <table id="data_tablex" class="table table-bordered table-striped" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th style="width: 300px;">Product</th>
                                            <th style="width: 150px;">Warehouse</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotoal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="row-trx">
                                        <tr row="1">
                                            <td>1</td>
                                            <td>
                                                <select class="form-control input-sm select2 prod-id prod-id-1" id="prod-id" name="prod_id[]" style="width: 300px;">
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control input-sm warehouse" name="wr_id[]" style="width: 100%;">
                                                </select>
                                            </td>
                                            <td><input type="number" class="form-control field-calc input-sm buy_price price price-1" price="1"" name="buy_price[]"></td>
                                            <td><input type="number" class="form-control field-calc input-sm prod_stock prod_stock-1" prod_stock="1" name="prod_stock[]"></td>
                                            <td><input type="number" class="form-control input-sm subtotal subtotal-1" name="subtotoal[]"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="coba" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 800px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="coba">Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form><div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Pelanggan</label>
                            <select class="form-control js-example-basic-single" name="state" style="width: 350px;">
                                <option value="AL"></option>
                                <option value="AL">Doni</option>
                                <option value="WY">Maman</option>
                                <option value="WY">Rahmat</option>
                                <option value="WY">Yabes</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Shiping</label>
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
                    <label for="message-text" class="col-form-label">Catatan</label>
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
                        <th style="width: 90px;">Jenis Biaya</th>
                        <th>Subtotoal</th>
                    </tr>
                </thead>
                <tbody class="row-biaya">
                    <tr>
                        <td>1</td>
                        <td>
                            <select class="form-control js-example-basic-single" name="state" style="width: 300px;">
                                <option value="AL"></option>
                                <option value="AL">Pengiriman</option>
                                <option value="WY">Pajak</option>
                                <option value="WY">Biaya Merchant</option>
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" src="<?php echo config_item('url_app') ?>js/modules/inventory/purchasematerial.js"></script>