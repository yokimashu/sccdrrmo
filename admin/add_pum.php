
<?php

include ('../config/db_config.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {}

$btnSave = $btnEdit='';
$btnNew = 'hidden';


$get_all_symptoms_sql = "SELECT * FROM tbl_symptoms where status='ACTIVE'";
$get_all_symptoms_data = $con->prepare($get_all_symptoms_sql);
$get_all_symptoms_data->execute();



?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCCDRRMO | Add Announcement</title>
 
  <?php include('header.php');?>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php include('sidebar.php');?>

  <div class="content-wrapper" >
    <div class="content-header"></div>

      <section class="content" >
        <div class="card text-white bg-success">
          <div class="card-header"><h3>Add PUMs / PUIs </h3></div>
                      
          <div class="card-body" align="center">
            <form role="form" method="post" action="update_pum.php"> 
              <div class="box-body">

                
                <div class="box-footer" align="center">
                                
                  <button type="button"  <?php echo $btnEdit; ?> name="edit" id ="btnEdit" class="btn btn-info" >
                  <i class="fa fa-edit fa-fw"> </i>  </button>

                  <button type="submit"  <?php echo $btnSave; ?> name="update_pum" id="btnSubmit" class="btn btn-success" >
                  <i class="fa fa-check fa-fw"> </i> </button>

                  <a href="list_pum.php">
                    <button type="button" name="cancel" class="btn btn-danger">       
                    <i class="fa fa-close fa-fw"> </i> </button>
                  </a>
                </div>
                <!-- end box-footer -->
              </div>
              <!-- end box-body -->
            </form>
            <!-- end form -->
          </div>
          
        </div>
   
      </section>
  

  <?php include('footer.php')?> 

</div>



<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- CK Editor -->
<script src="../../plugins/ckeditor/ckeditor.js"></script>
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
<script src="../plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- textarea wysihtml style -->
<script>
  $(function () {
    $('.textarea').wysihtml5({
      toolbar: { fa: true }
    })
  })
</script>

<!-- content minimum characters -->
<script type="text/javascript">

</script> 


</body>
</html>
