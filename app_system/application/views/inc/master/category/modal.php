<!-- modal form category -->

<div class="modal fade main-modal" id="modal-form-category">
  <div class="modal-dialog">
    <div class="modal-content bg-gray-light">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">
        <form id="form-category" class="form form-horizontal">
            <input type="hidden" name="category_id" class="hidden">            

            <div class="row">                    
                  <div class="col-sm-4">
                      <label>Category Name <span class="text-danger">*</span></label>
                  </div>
                  <div class="col-sm-7">
                      <div class="form-group">
                          <input type="text" class="form-control" name="category_name" required="">
                      </div>
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