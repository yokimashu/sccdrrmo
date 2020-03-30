
<?php

include ('../config/db_config.php');
include ('sql_symptoms.php');
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

$get_all_symptoms_sql = "SELECT * FROM tbl_symptoms where status='ACTIVE'";
$get_all_symptoms_data = $con->prepare($get_all_symptoms_sql);
$get_all_symptoms_data->execute();

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCCDRRMO | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
  <!-- Select2-->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include('sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <div class="content-header"></div>
    
    <section class="content">
            <div class="card card-info">
                    <div class="card-header">
                        <h4> LIST OF SYMPTOMS
                         <a href="#" data-toggle="modal" style="float:right;" data-target="#addSymptoms" type="button" class="btn btn-success bg-gradient-success" 
                            style="border-radius: 0px;"><i class="nav-icon fa fa-plus"></i></a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="box box-primary">
                            <form role="form" method="get" action="">
                                <div class="box-body">
                                    <table style = "overflow-x: auto;" id="users" class="table table-bordered table-striped">
                                        <thead align="center">
                                            <tr style="font-size: 1.10rem">
                                                <th> ID No </th>
                                                <th> Symptoms </th>
                                                <th> Status</th>
                                                <th> Options</th>
                                            </tr>
                                            <tbody >
                                                <?php while($list_symptoms = $get_all_symptoms_data->fetch(PDO::FETCH_ASSOC)){ ?>
                                                    <tr align="center">  
                                                        <td><?php echo $list_symptoms['idno'];?> </td>
                                                        <td><?php echo $list_symptoms['symptoms'];?> </td>
                                                        <td><?php echo $list_symptoms['status'];?></td>
                                                        <td>
                                                            <a class="btn btn-success btn-xs" href=" ">
                                                            <i class="fa fa-folder-open-o"></i> Open
                                                            </a>
                                                            &nbsp;                           
                                                            
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            
                                            </tbody>
                            
                                        </thead>
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



<div class="modal fade" id="addSymptoms" tabindex="-1" role="dialog" aria-labelledby="addPUM" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addSymptoms">Add Symptoms</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
            <form role="form" id="submitFormCateg" method="post" action="sql_symptoms.php" >

                <div class="form-group">
                    <input type="text" class="form-control"  name="symptoms" placeholder="Name of Symptoms" value="<?php echo $symptoms;?>">
                </div>

              
    
              <button type="submit" class="btn btn-success" name="insert_symptoms"><i class="fa fa-check fa-fw"></i></button>
              <button type="reset" class="btn btn-info" ><i class="fa fa-undo fa-fw"></i></button>
            </form> 
           
          </div>

        </div>
      </div>
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
      'autoHeight'  : true
    });

    $('#addSymptoms').on('hidden.bs.modal', function () {
        $('#addSymptoms form')[0].reset();
    });

  
</script>
</body>
</html>
