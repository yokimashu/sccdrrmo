<?php

include('../config/db_config.php');

session_start();
$user_id = $_SESSION['id'];
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
}
date_default_timezone_set('Asia/Manila');
$entity_no = $_GET['id'];
$notif = $_GET['notif'];
$photo = preg_replace("/[%]/", "", $_GET['img']);
$message = '';
$sender ='';
$date = '';
$time = '';
$read_messages= "SELECT message,DATE as date ,TIME as time,sender 
FROM tbl_message 
 WHERE notif_objid = :notif_objid ORDER BY message_objid DESC";
$get_messages = $con->prepare($read_messages);
$get_messages->execute([':notif_objid' => $notif]);

?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VAMOS | Users Messages </title>
  <?php include('heading.php'); ?>


</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header"></div>

      <section class="content">
        

    <div class ="card card-primary cardutline direct-chat direct-chat-success" style = "height:700px;">     
  <div class="card-header greenBG">
  <img class="direct-chat-img" src="../flutter/images/<?php echo $photo;?>" alt="message user image" style = "margin-right:30px;">
    <h3 class="card-title"><?php echo $entity_no?></h3>
    <div class="card-tools">
      <span data-toggle="tooltip" title="3 New Messages" class="badge badge-light">3</span>
      <button type="button" class="btn btn-tool" data-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
        <i class="fas fa-comments"></i>
      </button>
      <button type="button" class="btn btn-tool" data-widget="remove"><i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body " style = "height:500px;" >
    <!-- Conversations are loaded here -->
    <div class="direct-chat-messages " style = "height:700px;">
    <?php while($result = $get_messages->fetch(PDO::FETCH_ASSOC)){
        $message = $result['message'];
        $date = $result['date'];
        $time = $result['time'];
        $sender = $result['sender'];
        if($sender != 'ADMIN'){
        ?>
  
      <!-- Message. Default to the left -->
      <div class="direct-chat-msg" >
        <div class="direct-chat-infos clearfix">
          <span class="direct-chat-name float-left"><?php echo $entity_no;?></span>
          <span class="direct-chat-timestamp float-right"><?php echo $date.'/'.$time?></span>
        </div>
        <!-- /.direct-chat-infos -->
        <img class="direct-chat-img" src="../flutter/images/<?php echo $photo;?>" alt="message user image">
        <!-- /.direct-chat-img -->
        <div class="direct-chat-text">
         <?php echo $message;?>
       
        <!-- /.direct-chat-text -->
      </div>
      </div>
      <?php } else if ($sender == 'ADMIN'){?>
      <!-- /.direct-chat-msg -->
      <!-- Message to the right -->
      <div class="direct-chat-msg right">
        <div class="direct-chat-infos clearfix">
          <span class="direct-chat-name float-right">ADMIN</span>
          <span class="direct-chat-timestamp float-left"><?php echo $date.'/'.$time?></span>
        </div>
        <!-- /.direct-chat-infos -->
        <img class="direct-chat-img" src="../flutter/images/admin.jpg" alt="message user image">
        <!-- /.direct-chat-img -->
        <div class="direct-chat-text">
         <?php echo $message;?>
        </div>
        <!-- /.direct-chat-text -->
      </div>
      <?php }}?>
      </div>
      <!-- /.direct-chat-msg -->
      <!-- Message. Default to the left -->
     
    </div>
    <!--/.direct-chat-messages-->
    <!-- Contacts are loaded here -->

    <!-- /.direct-chat-pane -->
  </div>
 
  <!-- /.card-body -->
  <div class="card-footer">
    <form action="#" method="post">
      <div class="input-group">
        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
        <span class="input-group-append">
          <button type="button" class="btn btn-primary">Send</button>
        </span>
      </div>
    </form>
  </div>
  </div>


  <!-- /.card-footer-->
</div>
<!--/.direct-chat -->

                    

                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </section>
      <br>



    </div>
    <!-- /.content-wrapper -->
    <?php include('footer.php') ?>

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
   
  </script>
</body>

</html>