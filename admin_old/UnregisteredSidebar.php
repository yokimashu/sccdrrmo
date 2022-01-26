<!-- navbar and sidebar -->
<?php

include ('../config/db_config.php');

//fetch published posts from database
$get_all_sbpublished_sql = "SELECT * FROM tbl_announcement WHERE status='published' order by RAND() LIMIT 3";
$get_all_sbpublished_data = $con->prepare($get_all_sbpublished_sql);
$get_all_sbpublished_data->execute();

?>

  <nav class="main-header navbar navbar-expand greenBG navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item">
      <a href="index.php" class="nav-link">SCCDRRMO | SYSTEM</a>
      </li>
    </ul>
   
    <!-- <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../lockscreen.php" class="nav-link">Lock Screen</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../../logout.php" class="nav-link">Log Out</a>
      </li>
     </ul> -->
    
   
     
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
     <div class="greenBG">
     <br>

      <!-- Sidebar user panel (optional) -->
       <div class="sidebar">
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
           <div class="image">
             <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
           </div>
           <div class="info">
             <span style="color:white" class="d-block">GUEST  </span>
           </div>
         </div>
       </div>  <!-- /.sidebar -->
      
     </div>  <!-- /.greenBG -->

    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
         
             <!----------- SEE OTHER POSTS ------------->
             <div class="card">
          
                
                 <a href="announcement"><button type="button" class="btn btn-block btn-success">SEE OTHER POSTS </button></a>
               
          
             </div><!-- end card -->
      
             <!----------- SIDEBARD ANNOUNCEMENT   ------------->
             <?php $posts = $con->query("SELECT * FROM tbl_announcement WHERE status='published' order by RAND() LIMIT 3")->fetchall(PDO::FETCH_ASSOC);
                       foreach($posts as $row):
             ?>
             <div class="card">
               <div class="card-body">
               <p><h6><a href="view_post.php?post=<?php echo $row['id']; ?>"><?php echo strtoupper($row['title']); ?></a></h6></p>
               <hr>
               <a href="view_post.php?post=<?php echo $row['id']; ?>">
                 <div class="text-center">
                   <img class="img-fluid img-rounded" src="../postimage/<?php echo $row['image']; ?>" alt="900 * 300">
                 </div>
               </a>
               <hr>
               <a href="view_post.php?post=<?php echo $row['id']; ?>"><button type="button" class="btn btn-sm btn-info">Read More  <span class="fa fa-angle-right"></span></button></a>
               </div> <!-- /.card-body -->
             </div><!-- /.card -->
             <?php endforeach; ?>

      </nav><!-- /.sidebar-menu -->
    </div> <!-- /.sidebar -->

 
  </aside>
               <!--------------- PLEASE LOG IN ------------->

       <div class="card float-center">
           <div class="card-tools">
             <button type="button" class="btn btn-tool pull-right" data-widget="remove"><i class="fa fa-times"></i></button>
           </div>
         <div class="card-body text-center">            
           Hello Guest!<br>
            <a href="../index.php">
            <button type="button" class="btn btn-sm btn-success">SIGN IN / REGISTER</button>
            </a> <br>
            - or- <br>
            <a href="https://play.google.com/store/apps/details?id=com.capstone.sccdrrmo_final" ><button type="button" class="btn btn-sm btn-info"><i class="fa fa-android"></i> DOWNLOAD APP</button></a>  <br>
           
         </div>
       </div>