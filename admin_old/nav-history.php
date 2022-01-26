<div class="tab-pane fade" id="nav-history" role="tabpanel" aria-labelledby="nav-history-tab">


  <div class="card-body">
    <div class="box box-primary">
      <form role="form" method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">
        <div class="box-body">
          <div class="row">
            <div class="col-12" style="margin-bottom:30px;padding:auto;">
              <div class="input-group date">
                <label style="padding-right:10px;padding-left: 10px">From: </label>
                <div style="padding-right:10px" class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input style="margin-right:10px;" type="text" data-provide="datepicker" class="form-control col-3 " style="font-size:13px" autocomplete="off" name="datefrom" id="dtefrom" value="<?php echo $date_from; ?>">

                <label style="padding-right:10px">To:</label>
                <div style="padding-right:10px" class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" style="margin-right:50px;" class="form-control col-3 " data-provide="datepicker" autocomplete="off" name="dateto" id="dteto" value="<?php echo $date_to; ?>">

                <button id="view_person_history" onClick="loadhistory()" class="btn btn-success"><i class="fa fa-search"></i></button>

                <input id="entity_no8" value="<?php echo $entity_no; ?>">

              </div>
            </div>
          </div>
          <div class="table-responsive">
            <!-- <div class="row">
                      <div class="col-md-3" id="combo"></div>
                    </div>
                    <br> -->



            <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
              <thead align="center">



                <th> Trace ID</th>
                <th> Date</th>
                <th> Fullname</th>
                <th> Details</th>
                <th> Mobile No.</th>

              </thead>
              <tbody id="history_table">

              </tbody>
            </table>


          </div>
      </form>
    </div>
  </div>