<!-- modal form import -->
<div class="modal fade main-modal" id="modal-import-forstok">
    <div class="modal-dialog">
        <div class="modal-content bg-gray-light">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                <h4 class="modal-title">Import Data</h4>
            </div>
            <div class="modal-body">
                <form id="form-import-forstok" class="form">
                    <input type="hidden" name="reg_id" class="hidden">
                    <div class="input-group col-md-10">
                        <div class="input-group-prepend">
                            <span class="input-group-text">File</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="data_forstok" id="field-data-import">
                            <label class="custom-file-label" for="field-data-import">Choose file</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-flat btn-block" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-primary btn-flat btn-block btn-action-import">Import</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- modal end form import -->
<!-- modal workin -->
<div class="modal fade" id="modal-workin" tabindex="-1" role="dialog" aria-labelledby="coba" aria-hidden="true">
    <div class="modal-dialog modal-lg"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="coba">Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-detail-transaction">
                    <input type="hidden" name="trx_id" class="hidden">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="invoice" class="col-form-label">Invoice</label>
                                <br>
                                <b><span type="html" name="trx_invoice"></span></b>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Customer</label>
                                <br>
                                <b><span type="html" name="trx_customer"></span></b>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Shiping</label>
                                <br>
                                <b><span type="html" name="trx_shipping_name"></span></b>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Merchant</label>
                                <br>
                                <b><span type="html" name="mos_name"></span></b>
                            </div>
                            <div class="form-group list-state-trx">
                                <label>Status</label>
                                <ul>
                                    <li>
                                        <div>
                                            <input type="checkbox" order="1" name="hold" class="iCheck field-state" >
                                            <label class="  control-label">Hold</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <input type="checkbox" order="2" name="ready_to_ship" class="iCheck field-state" >
                                            <label class="control-label">READY TO SHIP</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <input type="checkbox" order="3" name="shipped" class="iCheck field-state" >
                                            <label class="control-label">SHIPPED</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <input type="checkbox" order="4" name="delivered" class="iCheck field-state" >
                                            <label class="control-label">DELIVERED</label>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <input type="checkbox" order="5" name="completed" class="iCheck field-state" >
                                            <label class="control-label">COMPLETED</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group group-ref-field-state field-state-shipped hidden">
                        <label for="message-text" class="col-form-label">No Resi</label>
                        <input type="text" class="form-control ref-field-state" name='waybill' required="required">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Catatan</label>
                        <input type="text" class="form-control" name='trx_notes'>
                    </div>
                </form>
                <table class="table table-bordered table-striped table-items-transaction" cellspacing="0">
                    <thead>
                        <tr >
                            <th class="text-center" style="width: 50px;">No</th>
                            <th align="center" class="text-center mb-4">Product Name</th>
                            <th align="center" class="text-center mb-2">QTY</th>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-action-process">Process Transaction</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end workin -->
<!-- modal close -->
<div class="modal fade" id="modal-workin-close" tabindex="-1" role="dialog" aria-labelledby="coba" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 800px;" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form class="form-close-transaction">
                    <input type="hidden" name="trx_id" class="hidden">
                    <div class="form-group">
                        <label for="comment">Reason Close</label>
                        <textarea class="form-control" rows="5" name="trx_log_notes"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Close
                    </button>
                    <div class="dropdown-menu grup-btn-action-close">
                        <a class="dropdown-item btn-action-close" flag="out_of_stock" href="#">Out Of Stock</a>
                        <a class="dropdown-item btn-action-close" flag="cancel_by_customer" href="#">By Customer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-shipping" tabindex="-1" role="dialog" aria-labelledby="coba" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 800px;" role="document">
        <div class="modal-content">
            <div class="modal-header">Update state Transaction</div>
            <div class="modal-body">
                <form class="form-close-transaction">
                    <input type="hidden" name="trx_id" class="hidden">
                    <div class="form-group" id="shipping-input">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="btn-simpan-shipping">Save</button>
                
            </div>
        </div>
    </div>
</div>

<!-- modal end close -->