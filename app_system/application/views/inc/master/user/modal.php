<!-- modal form user -->

<div class="modal fade main-modal" id="modal-form-user">
  <div class="modal-dialog">
    <div class="modal-content bg-gray-light">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title">Add user</h4>
      </div>
      <div class="modal-body">
        <form id="form-user" class="form form-horizontal">
            <input type="hidden" name="user_userid" class="hidden">
            <input type="hidden" name="password_" class="hidden"> 
            <div class="row">                    
                <div class="col-sm-3">
                    <label>Username <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_username" required="">
                    </div>
                </div>                
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <label>Password</label>
                </div>
                <div class="col-sm-9">
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" id="password" required="">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <label>Re-Password</label>
                </div>
                <div class="col-sm-9">
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password2" required="">
                    </div>
                </div>
            </div>

            <div class="row" id='hak_akses' >
                <div class="col-sm-3">
                    <label>Usergroup</label>
                </div>
                <div class="col-sm-9">
                    <div class="form-group has-feedback">
                        <select class="form-control select2" name="user_usergroup"  style="width: 100%;">
                          
                        </select>
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


<div class="modal fade main-modal" id="modal-form-update-user">
  <div class="modal-dialog">
    <div class="modal-content bg-gray-light">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
        <h4 class="modal-title">Update User</h4>
      </div>
      <div class="modal-body">
        <form id="form-update-user" class="form form-horizontal">
            <input type="hidden" name="user_userid" class="hidden">            
            <div class="row">                    
                <div class="col-sm-3">
                    <label>Username <span class="text-danger">*</span></label>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_username" required="">
                    </div>
                </div>                
            </div>

            <div class="row" id='hak_akses' >
                <div class="col-sm-3">
                    <label>Usergroup</label>
                </div>
                <div class="col-sm-9">
                    <div class="form-group has-feedback">
                      <input type="hidden" name="user_usergroupid" class="hidden">
                        <select class="form-control select2" name="user_usergroup"  style="width: 100%;">
                          
                        </select>
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