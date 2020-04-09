
<?php

include ('../config/db_config.php');
include ('sql_pum.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {

}

date_default_timezone_set('Asia/Manila');  
$date = date('Y-m-d');
$time = date('H:i:s');

$symptoms= $patient= $person_status ='';

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


    $db_fullname = $result['fullname'];

}

$get_all_pum_sql = "SELECT * FROM tbl_pum where status = 'Active' and health_status = 'PUM' order by idno DESC";
$get_all_pum_data = $con->prepare($get_all_pum_sql);
$get_all_pum_data->execute();



$get_all_symptoms_sql = "SELECT * FROM tbl_symptoms where status = 'Active'";
$get_all_symptoms_data = $con->prepare($get_all_symptoms_sql);
$get_all_symptoms_data->execute();


?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCCDRRMO ERP | List of PUMs </title>
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
                    <div class="card-header  text-white bg-success">
                        <h4> LIST OF PUMs  </h4>
                    </div>
                    <div class="card-body">
                        <div class="box box-primary">
                            <form role="form" method="get" action="">
                                <div class="box-body">
                                  <div class="table-responsive">
                                    <table style = "overflow-x: auto;" id="users" class="table table-bordered table-striped">
                                        <thead align="center">
                                            <tr style="font-size: 1.10rem">
                                                <th> Date </th>
                                                <th> Time </th>
                                                <th> Full Name </th>
                                                <th> Symptoms</th>
                                                <th> Health Status</th>
                                                <th> Options</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                         <?php while($list_pum = $get_all_pum_data->fetch(PDO::FETCH_ASSOC)){ ?>
                                                <tr align="center">  
                                                    <td><?php echo $list_pum['date_report'];  ?></td>
                                                    <td><?php echo $list_pum['time_report']; ?></td>
                                                    <td><?php echo $list_pum['first_name']; echo " "; echo $list_pum['middle_name']; echo " "; echo $list_pum['last_name'];?> </td>
                                                    <td><?php echo $list_pum['symptoms'];?> </td>
                                                    <td><?php echo $list_pum['health_status'];?></td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm" href="view_pum.php?objid=<?php echo $list_pum['objid'];?>&id=<?php echo $list_pum['idno'];?> ">
                                                        <i class="fa fa-folder-open-o"></i>
                                                        </a>
                                                        <button class="btn btn-danger btn-sm" data-role="confirm_delete" 
                                                            data-id="<?php echo $list_pum["idno"];?>"><i class="fa fa-trash-o"></i></button>
                                                        &nbsp;                           
                                                        
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    
                                  </div>
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



<div class="modal fade" id="addPUM" tabindex="-1" role="dialog" aria-labelledby="addPUM" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addPUM">Add PUM</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
          </div>
          <div class="modal-body">
            <form role="form" id="submitFormCateg" method="post" action="sql_pum.php" >
                <?php echo $alert_msg;?>

                
                <div class="form-group">
                    <select class="form-control select2" id="personstatus" style="width: 100%;" name="get_symptoms" value="<?php echo $person_status; ?>">
                        <option selected="selected">Select Person Status</option>
                        <option value="PUM">Person Under Monitoring (PUMs)</option>       
                        <option value="PUI">Person Under Investigation (PUIs)</option>
                        <option value="Positive">Positive</option>  
                        <option value="Death">Death</option>     
                        <option value="Tested">Tested</option>
                        <option selected="Recovered">Recovered</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="fullname" placeholder="Name of the Patient" value="<?php echo $patient;?>">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" name="fullname" placeholder="Name of the Patient" value="<?php echo $patient;?>">
                </div>




                                          
         
                <div class="form-group">
                    <select class="form-control select2" id="symptoms" style="width: 100%;" name="get_symptoms" value="<?php echo $symptoms; ?>">
                        <option selected="selected">Select Symptoms</option>
                        <?php while ($get_symptoms =$get_all_symptoms_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $get_symptoms['symptoms']; ?>"><?php echo $get_symptoms['symptoms']; ?></option>
                        <?php } ?>
                    </select>
                </div>

              <button type="submit" class="btn btn-success" name="insert_pum"><i class="fa fa-check fa-fw"></i></button>
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

    $('#addPUM').on('hidden.bs.modal', function () {
        $('#addPUM form')[0].reset();
    });

    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
      });
    });

</script>
</body>
</html>
