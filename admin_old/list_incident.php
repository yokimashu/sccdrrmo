<?php

// session_start();
include('../config/db_config.php');
include('verify_admin.php');
// if (!isset($_SESSION['id'])) {  
//     header('location:../index');
// }
$reported_by = '';
$alert_msg = '';
$user_id = $_SESSION['id'];

//querry to select current user's information
$get_user_sql = "SELECT * FROM tbl_users WHERE id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id' => $user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $user_name   = $result['username'];
}




if (isset($_POST['update'])) {
  $update_stmt = "Update tbl_incident set remarks =:remarks where objid =:objid";
  $stmt_update = $con->prepare($update_stmt);
  $stmt_update->execute([
    ':remarks' => $_POST['remarks'],
    ':objid' => $_POST['objid']
  ]);



  $alert_msg .= 'Update successfully';
}





$get_all_incident_sql = "SELECT * FROM tbl_incident ORDER BY objid DESC";
$get_all_incident_data = $con->prepare($get_all_incident_sql);
$get_all_incident_data->execute();


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VAMOS | Incident Masterlist</title>
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
          <div class="card-header bg-success text-white">
            <h4>Incident Masterlist</h4>


          </div>

          <div class="card-body">

            <div class="box box-primary">
              <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF"); ?>">

                <div class="box-body">
                  <p> <?php echo $alert_msg; ?> </p>
                  <table id="users" class="table table-bordered table-striped">
                    <thead>

                      <tr style="font-size: 1.10rem">
                        <th> ID </th>
                        <th> Date</th>
                        <th> Time</th>
                        <th> Type</th>
                        <th> Severity</th>
                        <th> Topic </th>
                        <th> Reported_by </th>
                        <th> Remarks</th>
                        <th>Options</th>
                        <th>Update</th>
                      </tr>

                    </thead>

                    <tbody>
                      <?php while ($incident_data = $get_all_incident_data->fetch(PDO::FETCH_ASSOC)) {


                      ?>
                        <tr style="font-size: 1rem">
                          <td><?php echo $incident_data['objid']; ?> </td>
                          <td><?php echo $incident_data['date']; ?> </td>
                          <td><?php echo $incident_data['time']; ?> </td>
                          <td><?php echo $incident_data['type']; ?> </td>
                          <td><?php echo $incident_data['severity']; ?> </td>
                          <td><?php echo $incident_data['topic']; ?> </td>
                          <td><?php echo $incident_data['reported_by']; ?> </td>
                          <td><?php echo $incident_data['remarks']; ?> </td>


                          <td>
                            <a class="btn btn-warning btn-sm" href="view_incident.php?&id=<?php echo $incident_data['objid']; ?> ">
                              <i class="fa fa-edit"></i> Open
                            </a>
                          </td>
                          <td></td>




                        </tr>
                      <?php   } ?>
                    </tbody>
                  </table>
                </div>
              </form>
            </div>

          </div>
      </section>



      </form>

      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog " role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Remarks</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class=form-horizontal method="post">
                <div class="form-group">
                  <input type="text" id="idremarks" class="form-control" name="objid">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="remarks" placeholder="remarks">
                </div>



            </div>
            <div class="modal-footer">
              <button type="submit" name="update" class="btn btn-success">UPDATE</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  </div>



  </div>

  <!-- footer here -->
  <?php include('footer.php'); ?>
  </div>
  <!-- ./wrapper -->
  <!-- jQuery 3 -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="../plugins/jquery/jquery.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
  <!-- PACE -->
  <script src="../plugins/pace/pace.min.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables/jquery.dataTables.js"></script>
  <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>

  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <script>
    $('#users').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': false,
      'info': true,
      'autoWidth': true,
      "scrollX": true,
      "columnDefs": [{
        "targets": -1,
        "data": null,
        "defaultContent": '<button class="btn btn-success btn-sm btn-flat approved" id ="btn">  <i class="fa fa-check"></i></button>'



      }]
    });


    $('#users tbody').on('click', '#btn', function() {
      // $("#users").on("click","button.btn",function(){
      // $('.approved').on( 'click',function() {
      event.preventDefault();
      var table = $('#users').DataTable();
      var data = table.row($(this).parents('tr')).data();

      var id = data[0];
      $('#modal-edit').modal('toggle');
      $('#idremarks').val(id);
      // console.log(id);
    });
    $('.approved').click(function(e) {
      e.preventDefault();

      $('#approved').modal('show');
      var id = $(this).data('id');
      var name = $(this).data('name');
      $('#userId').val(id);
      $.post("getUserdetail.php", {
          id: id
        },
        function(response) {
          $("#fullname").html(response);
        }
      );

      //  getDetails(id);
      // alert(id);
      // alert(name);
      //   $.ajax({
      //   type: 'POST',
      //   url: 'updatecredentials.php',
      //   data: {id:id},
      //   dataType: 'json'

      // });


    });

    function getDetails(id) {
      alert(id);
      $.ajax({
        type: 'POST',
        url: 'getUserdetail.php',
        data: {
          id2: id
        },
        dataType: 'json',
        success: function(response) {
          $('#fullname').val(response.fullname);
          console.log(response.fullname);
        }

      });

    }
  </script>
</body>

</html>