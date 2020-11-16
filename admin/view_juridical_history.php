<?php

include('../config/db_config.php');
include('sql_queries.php');

// include('list_individual.php');




session_start();
$user_id = $_SESSION['id'];

include('verify_admin.php');
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
} else {
}
include('verify_admin.php');


date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');

$symptoms = $patient = $person_status =  $entity_no = $business_nature = $fullname = $barangay = $mobile_no = $date_from = $date_to = '';

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


  $db_fullname = $result['fullname'];
}







$entity_no = $_GET['entity_no'];

$get_data_sql = "SELECT * FROM  tbl_juridical oh where entity_no ='$entity_no'";
$get_data_data = $con->prepare($get_data_sql);
$get_data_data->execute([':id' => $entity_no]);

while ($result = $get_data_data->fetch(PDO::FETCH_ASSOC)) {

  $business_nature = $result['business_nature'];
  $street = $result['street'];
  $org_name = $result['org_name'];
  $org_type = $result['org_type'];
  $barangay = $result['barangay'];
  $city = $result['city'];
  $province = $result['province'];
  $mobile_no = $result['mobile_no'];
}



// $entity_no = '';


// $get_all_history_sql = "select * from tbl_individual r
//                         inner join tbl_individual_history t on t.entity_id = r.entity_no where r.entity_no = :entity_no";
// $get_all_history_data = $con->prepare($get_all_history_sql);
// $get_all_history_data->execute();

// "SELECT * from tbl_tracehistory r inner join tbl_individual t on t.entity_no = r.trace_no where  r.entity_no = '".$entity_no."'";
$get_all_juridical_sql = "Select * FROM
(
    SELECT date, time, t.entity_no, t.trace_no, i.fullname, CONCAT(i.street, ', ', i.barangay) as details, i.mobile_no FROM `tbl_tracehistory` t
inner join tbl_individual i on i.entity_no = t.entity_no  WHERE t.entity_no = '" . $entity_no . "' or t.trace_no = '" . $entity_no . "'

UNION

SELECT date, time, t.entity_no, t.trace_no, i.fullname, CONCAT(i.street, ', ', i.barangay) as details, i.mobile_no FROM `tbl_tracehistory` t
inner join tbl_individual i on i.entity_no = t.trace_no  WHERE t.entity_no = '" . $entity_no . "' or t.trace_no = '" . $entity_no . "'
    
) dum 

WHERE fullname NOT IN (Select org_name from tbl_juridical where entity_no = '" . $entity_no . "')
ORDER BY date DESC, time DESC";
$get_all_juridical_data = $con->prepare($get_all_juridical_sql);
$get_all_juridical_data->execute();







?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VAMOS | Juridical Travel History </title>
  <?php include('heading.php'); ?>


</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header"></div>

      <section class="content">
        <div class="card card-info">
          <div class="card-header  text-white bg-success">
            <h4>  Juridical Travel History




              <div class="col-md-10" hidden>
                <input type="text" readonly class="form-control" name="entity_no" id = "entity_no" placeholder="entity_no" value=" <?php echo $entity_no; ?>" required>
                <input type="text" readonly class="form-control" name="org_name" id = "org_name" placeholder="fullname" value="<?php echo $org_name; ?>" required>
                <input type="text" readonly class="form-control" name="business_nature" id = "business_nature" placeholder="business_nature" value="<?php echo $business_nature; ?> " required>
                <input type="text" readonly class="form-control" name="street" placeholder="street" id ="street" value=" <?php echo $street; ?>" required>
                <input type="text" readonly class="form-control" name="barangay" id = "barangay" placeholder="barangay" value="<?php echo $barangay; ?>" required>
                <input type="text" readonly class="form-control" name="mobile_no" id = "mobile_no" placeholder="mobile_no" value=" <?php echo $mobile_no; ?>" required>
              </div>



              <a class="btn btn-danger btn-md" style="float:right;" target="blank" id="printlink" class="btn btn-success bg-gradient-success" href="../plugins/jasperreport/juridical_history.php?entity_no=<?php echo $entity_no; ?>&org_name=<?php echo $org_name; ?>&business_nature=<?php echo $business_nature; ?>&street=<?php echo $street; ?>&mobile_no=<?php echo $mobile_no; ?>">
                <i class="nav-icon fa fa-print"></i></a>



            </h4>

          </div>

          <div class="card-body">
            <div class="box box-primary">
              <form role="form" method="get" action="">
                <div class="box-body">
                <div class = "row">
            <div class = "col-12"style = "margin-bottom:30px;padding:auto;">
            <div class="input-group date">
                           <label style="padding-right:10px;padding-left: 10px">From:  </label> 
                             <div  style = "padding-right:10px" class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                             </div>
                    <input  style="margin-right:10px;"type="text" data-provide="datepicker"class="form-control col-3 " style="font-size:13px" autocomplete="off" name="datefrom" id="dtefrom"  value = "<?php echo $date_from;?>">

                    <label style="padding-right:10px">To:</label>
                            <div style = "padding-right:10px" class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                            </div>
           <input type="text" style = "margin-right:50px;" class="form-control col-3 " data-provide="datepicker"  autocomplete="off" name="dateto" id="dteto" value = "<?php echo $date_to;?>">
      
          <button id = "view_person_history" onClick = "loadhistory()" class = "btn btn-success"><i class = "fa fa-search"></i></button> 
          <input type = "hidden" id = "person_entity" value= "<?php echo $entity_no;?>">
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
                            <th> Date / Time</th>
                            <th> NAME</th>
                            <th> Details </th>
                            <th> Contact No. </th>



                   
                        </thead>
                        <tbody id = "history_table">
                         
                        </tbody>
                      </table>

                   
                  </div>
              </form>
            </div>
          </div>
        </div>

      </section>



    </div>
    <!-- /.content-wrapper -->
    <?php include('footer.php') ?>

  </div>

  <div class="modal fade" id="delete_PUMl" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Confirm Delete</h4>
        </div>
        <form method="POST" action="">
          <div class="modal-body">
            <div class="box-body">
              <div class="form-group">
                <label>Delete Record?</label>
                <input readonly="true" type="text" name="user_id" id="user_id" class="form-control">
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






  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- datepicker -->
  <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  <!-- Slimscroll -->
  <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <!-- DataTables Bootstrap -->
  <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/select2.full.min.js"></script>

  <script>
    $('#users').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true,
      initComplete: function() {
        this.api().columns([4]).every(function() {
          var column = this;
          var select = $('<select class="form-control select2"><option value="">show all</option></select>')
            .appendTo('#combo')
            .on('change', function() {
              var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
              );
              column
                .search(val ? '^' + val + '$' : '', true, false)
                .draw();
            });
          column.data().unique().sort().each(function(d, j) {
            select.append('<option value="' + d + '">' + d + '</option>')
          });
        });
      }

    });
    $('.select2').select2();

    $('#addPUM').on('hidden.bs.modal', function() {
      $('#addPUM form')[0].reset();
    });

    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
      });
    });




    $(document).on('click', 'button[data-role=confirm_delete]', function(event) {
      event.preventDefault();

      var user_id = ($(this).data('id'));

      $('#user_id').val(user_id);
      $('#delete_PUMl').modal('toggle');

    });






    // $('#users tbody').on('click', 'button.printlink', function() {
    //   // alert ('hello');
    //   // var row = $(this).closest('tr');
    //   var table = $('#users').DataTable();
    //   var data = table.row($(this).parents('tr')).data();
    //   //  alert (data[0]);
    //   //  var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
    //   var entity_no = data[0];
    //   window.open("individual_history.php?entity_no=" + entity_no + '_parent');
    // });


   
      $('#printlink').click(function() {
      var entity_no = $('#person_entity').val();
        var date_from  = $('#dtefrom').val();
        var date_to  = $('#dteto').val();
        var fullname  = $('#org_name').val();
        var busNature  = $('#business_nature').val();
        var street  = $('#street').val();
        var mobile_no  = $('#mobile_no').val();
        console.log(entity_no); 
        var param = "entity_no="+entity_no+"&fullname="+fullname+"&street="+street+"&business_nature="+busNature+"&mobile_no="+mobile_no+"&datefrom="+date_from+"&dateto="+date_to+"";
        $('#printlink').attr("href", "../plugins/jasperreport/individual_history.php?" + param, '_parent');
    });

    function loadhistory(){
       event.preventDefault();
    var entity_no  = $('#person_entity').val();
      var date_from  = $('#dtefrom').val();
      var date_to  = $('#dteto').val();

    $('#history_table').load("load_juridical_history.php",{
    entity_no:  entity_no,
    date_from :  date_from,
    date_to :    date_to},
    function(response, status, xhr) {
  if (status == "error") {
      alert(msg + xhr.status + " " + xhr.statusText);
      console.log(msg + xhr.status + " " + xhr.statusText);
      console.log("xhr=" + xhr.responseText );
    }
    });
    }
  </script>
</body>

</html>