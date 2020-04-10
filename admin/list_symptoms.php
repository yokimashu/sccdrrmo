
<?php

include ('../config/db_config.php');
include ('sql_queries.php');

session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {

}
$symptoms ='';


//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


    $db_fullname = $result['fullname'];

}

$get_all_symptoms_sql = "SELECT * FROM tbl_symptoms where status ='Active' order by idno DESC";
$get_all_symptoms_data = $con->prepare($get_all_symptoms_sql);
$get_all_symptoms_data->execute();

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCCDRRMO | List of Symptoms</title>
  <?php include('header.php');?>


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include('sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <div class="content-header"></div>
    
    <section class="content">
            <div class="card card-info">
                    <div class="card-header text-white bg-success">
                        <h4> List of Symptoms
                         <a href="#" data-toggle="modal" style="float:right;" data-target="#addSymptoms" type="button" class="btn btn-info bg-gradient-info" 
                            style="border-radius: 0px;"><i class="nav-icon fa fa-plus"></i></a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="box box-primary">
                            <form role="form" method="get" action="">
                                <div class="card-body" >
                                    <table id="users" class="table table-bordered table-striped">
                                        <thead align="center">
                                            <tr style="font-size: 1.10rem">
                                                <th> ID No </th>
                                                <th> Symptoms </th>
                                                <th> Status</th>
                                                <th> Options</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                                <?php while($list_symptoms = $get_all_symptoms_data->fetch(PDO::FETCH_ASSOC)){ ?>
                                                    <tr align="center">  
                                                        <td><?php echo $list_symptoms['idno'];?> </td>
                                                        <td><?php echo $list_symptoms['symptoms'];?> </td>
                                                        <td><?php echo $list_symptoms['status'];?></td>
                                                        <td>
                                                            <a class="btn btn-success btn-sm" href="view_symptoms.php?&id=<?php echo $list_symptoms['idno'];?>  ">
                                                            <i class="fa fa-folder-open-o"></i></a>
                                                            <button class="btn btn-danger btn-sm" data-role="confirm_delete" 
                                                            data-id="<?php echo $list_symptoms["idno"];?>"><i class="fa fa-trash-o"></i></button>
                                                            &nbsp;                           
                                                            
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            
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
 <?php include('footer.php')?>

</div>

<!-- add pum modal -->



<div class="modal fade" id="deleteordinance_Modal" role="dialog" data-backdrop="static" data-keyboard="false">
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
                  <input type="submit" name="delete_symptoms" class="btn btn-danger" value="Yes">
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
     $('.select2').select2();

    $('#users').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'autoHeight'  : true,
      'responsive'  : true
    });

    $('#addSymptoms').on('hidden.bs.modal', function () {
        $('#addSymptoms form')[0].reset();
    });

    $(document).on('click', 'button[data-role=confirm_delete]', function(event){
      event.preventDefault();

      var user_id = ($(this).data('id'));

      $('#user_id').val(user_id);
      $('#deleteordinance_Modal').modal('toggle');

    });

  
</script>
</body>
</html>
