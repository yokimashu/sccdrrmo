
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
            <button class="my-float btn btn-success btn-circle btn-xl"><i class="fa fa-angle-left"></i></button>
            </a>
     <div class="row">
        <div class="col-lg-6">
             <div class="card-body shadow">
                <p><h2><a href="#"><?php echo strtoupper($post_title); ?></a></h2></p>
                <p><h5>by <a href="#"><?php echo $post_author; ?></a></h5></p>
                <p><span class="fa fa-clock-o"></span> Posted on <?php echo $post_date; ?></p>
                <hr>
                <p><?php echo $post_content; ?></p>
             </div>

               <!--------------- C O M M E N T ------------->
             <div class="card-body shadow">
               <form method="POST" id="comment_form">
                 <input hidden name="comment_post_id" id="comment_post_id" class="form-control" value="<?php echo $post_id ?>">
                 <input hidden name="comment_name" id="comment_name" class="form-control" value="<?php echo $db_fullname ?>">
                   <span id="replyto"></span>
                   <div class="input-group input-group-sm">
                   
                   <input name="comment_content" id="comment_content" class="form-control" placeholder="Write a comment...">
                   
                   <span class="input-group-append">
                    <input hidden name="comment_id" id="comment_id" value="0" />
                    <button type="submit" id="submit" class="btn btn-info btn-flat"><i class="fa fa-check"></i></button>
                  </span>
                 </div>
               </form>
               <span id="comment_message"></span>
               <br />
               <div id="display_comment"></div>
             </div><!-- card-body -->

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

  <!-- Delete -->
  <div class="modal fade" id="delete">
    <div class="modal-dialog">
          <div class="modal-content">
          	<div class="modal-header card-outline card-danger">
            	<h4 class="modal-title"><b>Delete</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="">
            		<input type="" type="" class="delid" name="id">
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

<script>
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
   }
  })
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
