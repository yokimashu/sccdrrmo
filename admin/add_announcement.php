
<?php

include ('../config/db_config.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {

}

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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <div class="content-header"></div>

    <div class="container-fluid">      
     <div class="row">
        <div class="col-lg-1">  
        </div>
        <div class="col-lg-10">   
         <div class="card shadow">
           <div class="card-header">
             <h2 class="page-header">
               Add Announcement 
             </h2>
           </div>
           <div class="card-body">
             <form role="form" action="" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="post_title">Post Title</label>
                <input type="text" name="title" placeholder = "ENTER TITLE " value= "<?php if(isset($_POST['publish'])) { echo $post_title; } ?>"  class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="post_image">Post Image </label> <font color='brown' > &nbsp;&nbsp;(Allowed image size: 1024 KB) </font> 
                <input type="file" name="image" >
            </div>
            <div class="form-group">
                <label for="post_tag">Post Tags</label>
                <input type="text" name="tags" placeholder = "ENTER SOME TAGS SEPERATED BY COMMA (,)" value= "<?php if(isset($_POST['publish'])) { echo $post_tag; } ?>" class="form-control" >
            </div>
            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea class="form-control" name="content"  id="" cols="30" rows="15" ><?php if(isset($_POST['publish'])) { echo $post_content; } ?></textarea>
            </div>
           </div><!-- end card-body -->
           <div class="card-footer">
           <button type="submit" name="publish" class="btn btn-primary" value="Publish Post">Publish Post</button>
           </div>
           </form>
           </div>
         </div> <!-- end card shadow -->
        </div> <!-- end col-lg-10 -->
      </div>
    </div>
    <!-- end row -->

  </div>
  <!-- /.content-wrapper -->
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
