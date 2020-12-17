<div class="modal fade" id="verify_modal" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style = "">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>
        </div>
        <form method="POST" action="">
          <div class="modal-body">
           <div class = "container-fluid">
            <div class = "row">
            <div class = "col-6">
            <div class = "form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter email">
            </div>
            </div>
            </div>

           </div>
          </div>

        
          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left bg-olive" data-dismiss="modal">No</button>
            <!-- <button type="submit" name="delete_user" class="btn btn-danger">Yes</button> -->
            <input type="submit" name="delete_pum" class="btn btn-danger" value="Yes">
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>