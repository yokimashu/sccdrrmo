
<?php

include ('../config/db_config.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {

}


//fetch published posts from database
$get_all_published_sql = "SELECT * FROM tbl_announcement WHERE status='published'";
$get_all_published_data = $con->prepare($get_all_published_sql);
$get_all_published_data->execute();

?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCCDRRMO | Announcement</title>

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
        <div class="col-lg-2">
        </div>
        <div class="col-lg-8">
           <div class="card card-success shadow">   
             <div class="card-header">
               <h4 class="text-center">ANNOUNCEMENT</h4>
             </div>
           </div>
           <?php
           $rpp = 3;
           isset($_GET['page']) ? $page = $_GET['page'] : $page = 1;
           if($page > 1) {$start = ($page * $rpp) - $rpp;
          }else{
            $start = 0;
          }

           $numRows = $get_all_published_data->rowCount();

           $totalPages = $numRows / $rpp;

           $posts = $con->query("SELECT * FROM tbl_announcement WHERE status='published' ORDER BY updated_on DESC")->fetchall(PDO::FETCH_ASSOC);
                       
            foreach(array_slice($posts, $start, $rpp) as $row):
              if ($row['status'] !== 'published') {
              echo "NO POST PLS";
            } else {    
            ?>
             <div class="card-body shadow">
               <p><h2><a href="view_post.php?post=<?php echo $row['id']; ?>"><?php echo strtoupper($row['title']); ?></a></h2></p>
               <h6 class="text-muted">by <?php echo $row['author']; ?></h6>
               <h6 class="text-muted"><small><span class="fa fa-clock-o"></span> Posted on <?php echo date("F d, Y", strtotime( $row['postdate'])); ?></small></h6>
               <hr>
               <a href="view_post.php?post=<?php echo $row['id']; ?>">
                 <div class="text-center">
                   <img class="img-fluid img-rounded" src="../postimage/<?php echo $row['image']; ?>" alt="900 * 300">
                 </div>
               </a>
               <hr>
               <p><?php echo substr($row['content'], 0, 300) . '.........'; ?></p>
               <hr>
               <a href="view_post.php?post=<?php echo $row['id']; ?>"><button type="button" class="btn btn-info">Read More  <span class="fa fa-angle-right"></span></button></a>
             </div>
             <br>                     
             <?php }?>
             <?php endforeach; ?>

             
               <div class="text-center">
                 <?php
                 echo "<ul class='pagination'>";
                 echo "<li class='page-item'><a href='?page=".($page-1)."'class='page-link'><i class='fa fa-angle-left'></i></a></li>"; 
                 for($x = 1; $x <= $totalPages +1; $x++)
                 {
                 echo "<li class='page-item'><a href='?page=$x' class='page-link'>$x</a></li>";
                 } 
                 echo "<li class='page-item'><a href='?page=".($page+1)."'class='page-link'><i class='fa fa-angle-right'></i></a></li>";
                 echo "</ul>";
                 ?>
               </div>
               
           
                               
        </div><!-- end col-lg-8 -->       
      </div><!-- end row -->
    </div> <!-- end container-fluid -->
  </div><!-- /.content-wrapper -->
  
 <?php include('footer.php')?>

</div><!-- /.wrapper -->

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
	