<!---------------------------------- Unpublish ------------------------------------------------>

<div class="modal fade" id="unpublish">
  <div class="small-box modal-dialog">
    <div class="modal-content bg-default">
      <form class="form-horizontal" id="userform" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="container">
            <div class="inner">
              <h3>UNPUBLISH</h3>
              <input type="hidden" class="objid" name="id">
              <div class="row">
                <div class="col-4">
                  <div class="align-items-center">
                    <img class="img-fluid  edit_image">
                  </div>
                </div>
                <div class="col-8">
                  <div class="form-group">
                    <h5 class="edit_title"></h5>
                  </div>
                  <div class="form-group">
                    <p for="message" class="col-form-label ">by</p>
                    <p class="edit_author"></p>
                  </div>
                </div>
              </div><!-- row -->
            </div> <!-- inner -->
            <div class="icon">
              <i class="fa fa-file"></i>
            </div>
          </div> <!-- modal body -->
          <div class="modal-footer">
            <button class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            <button type="submit" class="btn btn-dark btn-sm" name="submit_unpublish"><i class="fa fa-archive"></i> Unpublish</button>
          </div> <!-- modal footer -->
        </div> <!-- container -->
      </form>

    </div> <!-- modal content -->
  </div> <!-- modal dialog -->
</div> <!-- modal -->


<!---------------------------------- PUBLISH ------------------------------------------------>

<div class="modal fade" id="publish">
  <div class="small-box modal-dialog">
    <div class="modal-content bg-success">
      <form class="form-horizontal" id="userform" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="container">
            <div class="inner">
              <h3>PUBLISH</h3>
         
              <input hidden class="objid" name="id">
              <div class="row">
                <div class="col-4">
                  <div class="align-items-center">
                    <img class="img-fluid  edit_image">
                  </div>
                </div>
                <div class="col-8">
                  <div class="form-group">
                    <h5 class="edit_title"></h5>
                  </div>
                  <div class="form-group">
                    <p for="message" class="col-form-label ">by</p>
                    <p class="edit_author"></p>

                  </div>
                </div>
              </div><!-- row -->
            </div> <!-- inner -->
            <div class="icon">
              <i class="fa fa-file"></i>
            </div>
          </div> <!-- modal body -->
          <div class="modal-footer">
            <div class="mr-auto"> <input type="checkbox" name="notify" checked><span> Send notification to users. </span></div>
            <button class="btn btn-success btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            <button type="submit" class="btn btn-dark btn-sm" name="submit_publish"><i class="fa fa-check"></i> Publish</button>
          </div> <!-- modal footer -->
        </div> <!-- container -->
      </form>

    </div> <!-- modal content -->
  </div> <!-- modal dialog -->
</div> <!-- modal -->

<!---------------------------------- Delete ------------------------------------------------>

<div class="modal fade" id="delete">
  <div class="small-box modal-dialog">
    <div class="modal-content bg-danger">
      <form class="form-horizontal" id="userform" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="container">
            <div class="inner">
              <h3>DELETE</h3>
              <input type="hidden" class="objid" name="id">
              <input type="hidden" class="image" name="image">
              <div class="row">
                <div class="col-4">
                  <div class="align-items-center">
                    <img class="img-fluid  edit_image">
                  </div>
                </div>
                <div class="col-8">
                  <div class="form-group">
                    <h5 class="edit_title"></h5>
                  </div>
                  <div class="form-group">
                    <p for="message" class="col-form-label ">by</p>
                    <p class="edit_author"></p>
                  </div>
                </div>
              </div><!-- row -->
            </div> <!-- inner -->
            <div class="icon">
              <i class="fa fa-file"></i>
            </div>
          </div> <!-- modal body -->
          <div class="modal-footer">
            <button class="btn btn-danger btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            <button type="submit" class="btn btn-dark btn-sm" name="submit_delete"><i class="fa fa-trash"></i> Delete</button>
          </div> <!-- modal footer -->
        </div> <!-- container -->
      </form>

    </div> <!-- modal content -->
  </div> <!-- modal dialog -->
</div> <!-- modal -->