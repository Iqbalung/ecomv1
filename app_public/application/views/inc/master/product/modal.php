<!-- modal form product -->

<div class="modal fade main-modal" id="modal-form-product">
  <div class="modal-dialog modal-md">
    <div class="modal-content bg-gray-light">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title">Add product</h4>
      </div>
      <div class="modal-body">
        <form id="form-product" class="form">
            <input type="hidden" name="prod_id" class="hidden">            
        
            <div class="form-group">
                <div class="col-sm-12">
                  <label>Product Name <span class="text-danger">*</span></label>
                </div>                
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="prod_name" required="">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                  <label>Product Code <span class="text-danger">*</span></label>
                </div>                
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="prod_code" required="">
                </div>
            </div>            
            
            <div class="form-group">
                  <div class="col-sm-12">
                      <label>Product Description <span class="text-danger">*</span></label>
                  </div>
                  <div class="col-sm-12">
                      <textarea class="form-control" rows="3" name="prod_desc" required=""></textarea>
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
            <button type="button" class="btn btn-primary btn-flat btn-block btn-save">Save</button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>