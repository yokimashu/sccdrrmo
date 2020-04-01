
<?php

include ('../config/db_config.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {

}

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {

    $db_fullname = $result['fullname'];

}

//fetch announcement from database
if (isset($_GET['post'])) {
    
    $post = $_GET['post'];
    $get_post_sql = "SELECT * FROM posts where id = :post";
    $get_post_data = $con->prepare($get_post_sql);
    $get_post_data->execute([':post' => $post]);
    while ($row = $get_post_data->fetch(PDO::FETCH_ASSOC)) {
        $post_title = $row['title'];
        $post_id = $row['id'];
        $post_author = $row['author'];
        $post_date = $row['postdate'];
        $post_image = $row['image'];
        $post_content = $row['content'];
        $post_tags = $row['tag'];
        $post_status = $row['status'];
    }
}
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
  <link rel="stylesheet" href="../dist/css/adminlte.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
 <!-- Date Picker -->
  <link rel="stylesheet" href=".s./plugins/datepicker/datepicker3.css">
  <!-- DataTables -->
   <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include('sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <div class="content-header"></div>
    <div class="container-fluid">
            <a href="announcement" class="float">
            <button class="my-float btn btn-info btn-circle btn-xl"><i class="fa fa-angle-left"></i></button>
            </a>
     <div class="row">
        <div class="col-lg-6">
             <div class="card-body shadow">
                <p><h2><a href="#"><?php echo $post_title; ?></a></h2></p>
                <p><h5>by <a href="#"><?php echo $post_author; ?></a></h5></p>
                <p><span class="fa fa-clock-o"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <p><?php echo $post_content; ?></p>
             </div>
        </div><!-- end col-lg-6 -->
        <div class="col-lg-6">
         
             <div class="card-body shadow">
             <img class="img-fluid img-rounded" src="../postimage/<?php echo $post_image; ?>" alt="900 * 300">
             </div>

             

        </div><!-- end col-lg-8 -->
      </div><!-- end row -->
    </div> <!-- end container-fluid -->
  </div><!-- /.content-wrapper -->
  
 <?php include('footer.php')?>

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
<script src="../plugins/datatables/dataTables.bootstrap4.js"></script>

</body>
</html>
