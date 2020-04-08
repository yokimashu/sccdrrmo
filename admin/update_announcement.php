
<?php

include ('../config/db_config.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {}

$btnSave = '';
$btnNew = 'hidden';

if (isset($_GET['post'])) {

  //select filename
  $id = $_GET['post'];
  $get_sql = "SELECT * FROM tbl_announcement where id = :post";
  $get_data = $con->prepare($get_sql);
  $get_data->execute([':post' => $id]);
  while ($result = $get_data->fetch(PDO::FETCH_ASSOC)) {
      $post_id = $result['id'];
      $post_title = $result['title'];
      $post_postdate = $result['postdate'];
      $newfilename = $result['image'];
      $post_content = $result['content'];
      $post_status = $result['status'];
      $post_tag = $result['tag'];
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCCDRRMO | Update Announcement</title>
 
  <?php include('header.php');?>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include('sidebar.php');?>
  <?php include('insert_announcement.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <div class="content-header"></div>

    <div class="container-fluid">      
     <div class="row">
        
        <div class="col-lg-1"> 
          <div class="card shadow">
            <div class="card-tools">
              <div class="pull-right">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <img src="<?php echo '../postimage/'.$newfilename; ?>" class="img-fluid" id="image">
            </div>
          </div>
        </div>
        
        <div class="col-lg-10">   
         <div class="card shadow">
           <div class="card-header">
             <h2 class="page-header">
               Update Announcement 
             </h2>
           </div><!-- end card-header -->

           <form role="form" action="" method="POST" enctype="multipart/form-data">
           <div class="card-body">

             <div class="float-topright">
               <?php echo $alert_msg; ?> 
             </div>
            <div class="form-group">
                <input hidden type="text" name="old_image" value= "<?php  echo $newfilename; ?>"  class="form-control">
                <input hidden type="text" name="id" value= "<?php  echo $post_id; ?>"  class="form-control">
            </div>

            <div class="form-group">
                <label for="post_title">Post Title</label>
                <input type="text" name="title" placeholder = "ENTER TITLE " value= "<?php  echo $post_title; ?>"  class="form-control" pattern=".{15,}" required title="15 characters minimum">
            </div>
            
            <div class="form-group">
                <label for="post_image">Post Image </label>
                <input type="file" name="myFiles" id="fileToUpload" onchange = "loadImage()" >
            </div>

            <div class="form-group">
                <label for="post_tag">Post Tags</label>
                <input type="text" name="tags" placeholder = "ENTER SOME TAGS SEPERATED BY COMMA (,)" value= "<?php echo $post_tag; ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea class="textarea" name="content"  id="content" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder = "ENTER CONTENT" minlength="15" required><?php echo $post_content; ?></textarea>
            </div>
           </div><!-- end card-body -->

           <div class="card-footer">
            <a href="view_all_posts" class="btn btn-info" value="Publish Post"><span class="fa fa-angle-left"> </span>  Back</a>
            <button type="submit" <?php echo $btnSave; ?> name="insert_update_announcement" class="btn btn-success" onclick="return checkWordCount()"  value="Publish Post">Update Post</button>
            <a href="update_announcement?post=<?php echo $data["id"]; ?>"><button <?php echo $btnNew; ?> class="btn btn-success"><i class="fa fa-refresh"></i></button></a>
           </div><!-- end card-footer -->
           </form>
           
         </div> <!-- end card shadow -->
        </div> <!-- end col-lg-10 -->
     </div><!-- end row -->
    
    </div><!-- /.container-fluid -->
  </div><!-- /.content-wrapper -->

</div><!-- /.wrapper -->

 <?php include('footer.php')?>




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
function checkWordCount(){
    s = document.getElementById("content").value;
    s = s.replace(/(^\s*)|(\s*$)/gi,"");
    s = s.replace(/[ ]{2,}/gi," ");
    s = s.replace(/\n /,"\n");
    if (s.split('').length <= 50) {
        alert("Content is 50 characters minimum");
        return false;
    }
}
</script>

<!-- refresh image to be upload -->
<script>
function loadImage(){
    var input = document.getElementById("fileToUpload");
var fReader = new FileReader();
fReader.readAsDataURL(input.files[0]);
fReader.onloadend = function(event){
    var img = document.getElementById("image");
    img.src = event.target.result;
}
}
</script> 


</body>
</html>
