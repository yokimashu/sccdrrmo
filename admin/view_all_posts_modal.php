

    <!-- Unpublish -->
    <div class="modal fade" id="unpublish">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header card-outline card-warning">
            	<h4 class="modal-title"><b>Unpublish</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">
            		<input type="hidden" class="objid" name="id">
            		<div class="">
                    <h2 class="edit_title"></h2>
                    <p>by:</p>
                    <h4 class="edit_author"></h4>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-warning btn-sm" name="submit_unpublish"><i class="fa fa-times"></i> Unpublish</button>
            	</form>
          	</div>
          </div>
    </div>
  </div>

  <!-- Publish -->
  <div class="modal fade" id="publish">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header card-outline card-success">
            	<h4 class="modal-title"><b>Publish</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">
            		<input type="hidden" class="objid" name="id">
					<input hidden type="text" class="edit_title" name="title">
            		<div class="">
                    <h2 class="edit_title"></h2>
                    <p>by:</p>
                    <h4 class="edit_author"></h4>
	            	</div>
					<br>
					<input type="checkbox"  name="notify" checked><span style="color:red"> Send notification to users. </span>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-success btn-sm" name="submit_publish"><i class="fa fa-check"></i> Publish</button>
            	</form>
          	</div>
          </div>
    </div>
  </div>

  <!-- Delete -->
  <div class="modal fade" id="delete">
    <div class="modal-dialog">
          <div class="modal-content">
          	<div class="modal-header card-outline card-danger">
            	<h4 class="modal-title"><b>Delete</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">
            		<input type="hidden" type="" class="objid" name="id">
					<input type="hidden" class="image" name="image">
            		<div class="">
                    <h2 class="edit_title"></h2>
                    <p>by:</p>
                    <h4 class="edit_author"></h4>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-sm" name="submit_delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
          </div>
     </div>
  </div>
