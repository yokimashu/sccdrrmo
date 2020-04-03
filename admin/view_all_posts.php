
<?php

include ('../config/db_config.php');
session_start();
$user_id = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} else {

}

//get all announcement
$get_all_announcement_sql = "SELECT * FROM tbl_announcement";
$get_all_announcement_data = $con->prepare($get_all_announcement_sql);
$get_all_announcement_data->execute();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCCDRRMO | Dashboard</title>
 
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

       <div class="col-lg-12">
           <div class="card shadow">
             <div class="card-header">
               <h2 class="page-header">
                  View All Announcements
                  <div class="pull-right">
                  <a href="add_announcement" class="btn btn-success btn-lg" data-placement="top" title="Add Announcement"><i class="fa fa-plus"></i></a>
                  </div>
               </h2>
             </div>
            <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF");?>">
              <div class="card-body">

                <table id="maintable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Author</th>
                      <th>Title</th>
                      <th width="75px">Image</th>
                      <th>Tags</th>
                      <th width="75px">Date</th>
                      <th>Status</th>
                      <th width="50px">Option</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php while($data = $get_all_announcement_data->fetch(PDO::FETCH_ASSOC)){ ?>
                    <tr>
                        <td><?php echo  $data['id']; ?></td>
                        <td><?php echo $data['author'];?></td>
                        <td><?php echo $data['title'];?></td>
                        <td><img src=<?php echo '../postimage/'.$data['image'];?> class="img-fluid" ></td>
                        <td><?php echo $data['tag'];?></td>
                        <td><?php echo $data['postdate'];?></td>
                        <td><?php echo $data['status']; if($data['status'] == 'draft'){$btnpublish = ''; $btnunpublish = 'hidden';}else{$btnpublish = 'hidden'; $btnunpublish = '';}?></td>
                        <td>
                           <button class="btn btn-outline-success publish btn-sm" data-id="<?php echo $data["id"]; ?>" data-placement="top" title="Publish Post" <?php echo $btnpublish ?> ><i class="fa fa-check"></i></button>
                           <button class="btn btn-outline-danger unpublish btn-sm" data-id="<?php echo $data["id"]; ?>" data-placement="top" title="Unpublish Post" <?php echo $btnunpublish ?> ><i class="fa fa-times"></i></button>
                           <button class="btn btn-outline-success view btn-sm" data-id="<?php echo $data["id"]; ?>" data-placement="top" title="View Post"><i class="fa fa-eye"></i></button>
                           <button class='btn btn-outline-success edit btn-sm' data-id="<?php echo $data["id"]; ?>" data-placement="top" title="Edit Post"><i class='fa fa-pencil'></i></button>       
                           <button class="btn btn-outline-danger delete btn-sm" data-id="<?php echo $data["id"]; ?>" data-placement="top" title="Delete Post"><i class="fa fa-trash-o"></i></button>
                        </td>   
                      </tr>
     
                      <div class="form-group">      
           
               
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </form>
          </div>
          <!-- /.card -->
      

      </div><!-- end row -->
   </div><!-- end container-fluid -->
    

  </div><!-- /.content-wrapper -->

  <!-- Delete -->
  <div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header card-outline card-danger">
            	<h4 class="modal-title"><b>Deleting...</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action=" ">
            		<input type="hidden" class="objid" name="id">
            		<div class="text-center">
	                	<p>DELETE Announcement</p>
                    <h2 id="del_title" class="bold"></h2>
                    <p>by:</p>
                    <h2 id="del_author" class="bold"></h2>
	            	</div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            	<button type="submit" class="btn btn-danger btn-sm" name="delete"><i class="fa fa-trash"></i> Delete</button>
            	</form>
          	</div>
          </div>
       </div>
  </div>
  
 <?php include('footer.php')?>

</div>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/jquery/jquery.js"></script>
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
$('#maintable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'autoHeight'  : true,
      "order": [[ 6, "asc" ]]
    });
</script>
<script>

 $(function(){
  $(document).on('click', '.edit', function(e) {
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
  
});

function getRow(id){
  
  $.ajax({
    
    type: 'POST',
    url: 'announcement_fetch.php',
    data: {id:id},
    dataType: 'json',
    success: function(data){
      
      $('.objid').val(data.id);
      $('#objid').val(data.id);
      $('#del_title').val(data.title);.html(data.title);
      $('#del_author').val(data.author).html(data.author);
      
    }
  });
};

 </script>

</body>
</html>
