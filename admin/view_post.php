
<?php

include ('../config/db_config.php');
session_start();

// set unregistered user
if (empty($_SESSION['id'])) {
  $_SESSION['id'] = "guest";
}


$user_id = $_SESSION['id'];

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
    $get_post_sql = "SELECT * FROM tbl_announcement where id = :post";
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

    $_SESSION['post_id'] = $post_id;

    $stripcontent = strip_tags($post_content);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  
  <meta property="og:url"           content="http://34.92.117.58/sccdrrmo/admin/view_post.php?post=<?php echo $post_id ?>" />
  <meta property="og:type"          content="website" />
  <meta property="og:title"         content="<?php echo $post_title; ?>" />
  <meta property="og:description"   content="<?php echo $stripcontent; ?>" />
  <meta property="og:image"         content="http://34.92.117.58/sccdrrmo/postimage/<?php echo $post_image; ?>" />
  <meta property="og:image:width"   content="1920"/>
  <meta property="og:image:height"  content="1080"/>

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
<?php if($_SESSION['id'] == "guest") {
  include('UnregisteredSidebar.php');
  $btncomment = "hidden";
}else{
  include('sidebar.php');
  $btncomment = "";
}

 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
  
    <div class="content-header"></div>
    <div class="container-fluid">

     <div class="row">
        <div class="col-lg-1">
          <div class="card">
           <a href="announcement">
            <button <?php echo $btncomment; ?> class="btn btn-info btn-block"><i class="fa fa-angle-left"></i> BACK </button>
           </a>
          </div>
        </div><!-- end col-lg-1 -->

        <div class="col-lg-6">
           <div class="card">
             <div class="card-header">
                <p><h2><?php echo strtoupper($post_title); ?></h2></p>
                <h6 class="text-muted">by <?php echo $post_author; ?></h6>
                <h6 class="text-muted"><small><span class="fa fa-clock-o"></span> Posted on <?php echo date("F d, Y", strtotime($post_date)); ?></small></h6>
             </div><!-- end card-head -->

             <div class="card-body text-center">
                <img class="img-fluid img-rounded" src="../postimage/<?php echo $post_image; ?>" alt="900 * 300">
                <hr>
             </div><!-- end card-body -->

             <div class="card-body text-justify">
                <p><?php echo $post_content; ?></p>
             </div><!-- end card-body -->

             <div class="card-footer">
                <div class="fb-like" data-href="http://34.92.117.58/sccdrrmo/admin/view_post?post=<?php echo $post_id ?>" data-width="500" data-layout="standard" data-action="like" data-size="large" data-share="true"></div>
             </div><!-- end card-footer -->
           </div> <!-- end card -->
        </div><!-- end col-lg-6 -->

        <div class="col-lg-4">
               <!--------------- C O M M E N T ------------->
           <div class="card">
             <div class="card-body">
               <form method="POST" id="comment_form">
                 <input hidden name="comment_post_id" id="comment_post_id" class="form-control" value="<?php echo $post_id ?>">
                 <input hidden name="comment_name" id="comment_name" class="form-control" value="<?php echo $db_fullname ?>">
                   <span id="replyto"></span>
                   <div class="input-group input-group-sm">
                   
                   <input <?php echo $btncomment; ?> name="comment_content" id="comment_content" class="form-control" placeholder="Write a comment...">
                   
                   <span class="input-group-append">
                    <input hidden name="comment_id" id="comment_id" value="0" />
                    <button <?php echo $btncomment; ?> type="submit" id="submit" class="btn btn-info btn-flat"><i class="fa fa-check"></i></button>
                  </span>
                 </div>
               </form>
               <span id="comment_message"></span>
               <br />
               <div id="display_comment"></div>
             </div><!-- card-body -->
           </div><!-- card -->
        </div><!-- end col-lg-4 -->
      </div><!-- end row -->



    </div> <!-- end container-fluid -->
  </div><!-- /.content-wrapper -->

 
  
 <?php include('footer.php')?>

</div><!-- Main Wrapper -->

  <!-- Delete Comment Modal -->
  <div class="modal fade" id="delete">
    <div class="modal-dialog  modal-dialog-centered">
          <div class="modal-content">
          	<div class="modal-header card-outline card-danger">
            	<h4 class="modal-title"><b>Delete</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="">
            		<input type="hidden" type="" class="delid" name="id">
            		<div class="">
                    <p>Are you sure you want to delete this comment?</p>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-sm" name="submit_delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
          </div>
     </div>
  </div>

  <?php if(isset($_POST['submit_delete'])){
        $id = $_POST['id'];

        $query = "DELETE FROM tbl_comment WHERE comment_id = '$id' OR parent_comment_id = '$id' ";
        $stmt = $con->prepare($query);
        $stmt->execute();

		}
  ?>


 <!-- facebook like and share -->
 <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>
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


<script type="text/javascript">
$(document).ready(function(){
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     load_comment();
     $('#replyto').hide();
    }
   }
  })
 });

 load_comment();

 function load_comment()
 {
  $.ajax({
   url:"fetch_comment.php",
   method:"POST",
   success:function(data)
   {
    $('#display_comment').html(data);
   },
   complete: function() {
     setTimeout(load_comment,1000); //After completion of request, time to redo it after a second
    }
  });
 }

 $(document).on('click', '.reply', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#comment_content').focus();
  getRow(comment_id);
  $('#replyto').show();
 });

 $(document).on('click', '.delete', function(){
  var comment_id = $(this).attr("id");
  $('#comment_id').val(comment_id);
  $('#delete').modal('show');
  getRow(comment_id);
  $('#replyto').hide();
 });
 
});

function getRow(comment_id){

$.ajax({

  type: 'POST',
  url: 'fetch_comment2.php',
  data: {id:comment_id},
  dataType: 'json',
  success: function(data){


    $('#replyto').html(data.csn);
    $('.delid').val(data.id);
    
  }
});
};
</script>

</body>
</html>
