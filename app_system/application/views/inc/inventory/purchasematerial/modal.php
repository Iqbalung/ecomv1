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
              <h5 class="modal-title" id="coba">Transaksi</h5>
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
                          <label for="recipient-name" class="col-form-label">Suplier</label>
                          <br>
                          <b><span type="html" name="suplier_name"></span></b>
                      </div>
                       <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Source</label>
                          <br>
                          <b><span type="html" name="buy_source"></span></b>
                      </div>
                      <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Date</label>
                          <br>
                          <b><span type="html" name="buy_datecreated"></span></b>
                      </div>
                  </div>
                   <div class="col-md-6">
                      <div class="form-group list-state-trx">
                        <label>Status</label>
                          <ul>
                            <li>
                              <div>
                                  <input type="checkbox" order="1" name="ready_to_package" class="iCheck field-state" >
                                  <label class="  control-label">Order</label>
                              </div>
                            </li>
                            <li>
                              <div>
                                  <input type="checkbox" order="2" name="ready_to_ship" class="iCheck field-state" >
                                  <label class="control-label">Recive</label>
                              </div>
                            </li>
                          </ul>
                      </div>
                  </div>
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
                                  <th align="center" class="text-center mb-4">Nama Barang</th>
                                  <th align="center" class="text-center mb-2">Jumlah</th>
                                  <th align="center" class="text-center mb-3">Harga</th>
                                  <th align="center" class="text-center mb-3">Subtotoal</th>
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
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary btn-action-process">Proses Transaksi</button>
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
                  <label for="comment">Alasan Close</label>
                  <textarea class="form-control" rows="5" name="trx_log_notes"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
<!-- modal end close -->        