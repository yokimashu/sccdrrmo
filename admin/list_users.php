<?php

session_start();
include ('../config/db_config.php');

$btnNew = 'disabled';
if (!isset($_SESSION['id'])) {
    header('location:../index');
}
$department =  '';

$user_id = $_SESSION['id'];

//querry to select current user's information
$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$get_user_data = $con->prepare($get_user_sql);
$get_user_data->execute([':id'=>$user_id]);
while ($result = $get_user_data->fetch(PDO::FETCH_ASSOC)) {
  $user_name   = $result['username'];

}

$get_all_users_sql = "SELECT * FROM tbl_users ";
$get_all_users_data = $con->prepare($get_all_users_sql);
$get_all_users_data->execute(); 


?>

<!DOCTYPE html> 
<html >
<head>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SCCDRRMO |USER'S LIST</title>

 <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="../dist/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Morris chart
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  jvectormap -->
  <!-- <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <!-- Daterange picker
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
   <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
     <!-- Select2 -->
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->

  <!-- <link href="../plugins/bootstrap-dialog.css" rel="stylesheet" type="text/css" /> -->

  <!-- <script src="js/bootstrap-dialog.js"></script> -->

</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">
  
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('sidebar.php');?>

 
    <div class="content-wrapper">
      <div class="content-header"></div>

      
      
      <section class="content">
    
          <div class="card card-info">
            <div class="card-header">
              <h4 style="float:left;" >USERS LIST</h4>
         
              
            </div>
          
            <div class="card-body">

              <div class="box box-primary">
                <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF");?>">

                  <div class="box-body">
                  
                    <table style = "overflow-x: auto;"id="users" class="table table-bordered table-striped">
                      <thead>
                      
                        <tr style="font-size: 1.10rem">
                            <th> ID </th>
                            <th> Full Name </th>
                            <th> username </th>
                            <th> Email</th>                                                                 
                            <th> Gender</th>
                            <th> Contact No. </th>
                            <th> Birth Date</th>
                            <th> Account Type</th>
                            <th> Status </th>
                            <th> Options </th>
                          </tr>
                          
                      </thead>

                      <tbody>
                        <?php while($users_data = $get_all_users_data->fetch(PDO::FETCH_ASSOC)){  
                          $account_type ='';
                          if($users_data['account_type']=='1'){
                            $account_type ='Administrator';
                          }  
                          else{
                            $account_type ='User';
                          }
                          ?>
                          <tr style="font-size: 1rem">
                            <td><?php echo $users_data['user_id'];?> </td>
                            <td><?php echo $users_data['fullname'];?> </td>
                            <td><?php echo $users_data['username'];?> </td>
                            <td><?php echo $users_data['email'];?> </td>
                            <td><?php echo $users_data['gender'];?> </td>
                            <td><?php echo $users_data['contact_no'];?> </td>
                            <td><?php echo $users_data['birthdate'];?> </td>
                            <td><?php echo $account_type?> </td>
                            <td><?php echo $users_data['status'];?> </td>
                          <td>
                            <a class="btn btn-success btn-sm btn-flat approved" 
                            data-id=<?php echo $users_data['user_id'];?> data-name=<?php echo $users_data['fullname'];?>>
                            <i class="fa fa-check"></i>
                             </a>
                           
                             <a class="btn btn-danger btn-sm delete btn-flat" 
                            href="update_users.php?objid=<?php echo $users_data['user_id'];?>&id=<?php echo $users_data['user_id'];?>">
                            <i class="fa fa-trash"></i>
                             </a>

                                                 
                            
                          </td>


                          </tr>
                        <?php   } ?>
                      </tbody>
                    </table>
                  </div>
                </form>
              </div>       
         
          </div>
      </section>
      
      <div class = "modal fade " id="approved">
    <div class ="modal-dialog ">
    <div class ="modal-content ">
    <div class="modal-header card-outline card-primary" >
    <h4 class ="modal-title">Do you want to approve this user?</h4>
    </div>
    <form class =form-horizontal method ="POST" action = "updatecredentials.php"  enctype="multipart/form-data">
         <div class = "modal-body ">

         <label class = col-sm-2 col-form-label"> User ID:</label>
         <input type = "text" name = "userId" readonly class="form-control" id="userId">
         <label class = col-sm-3 col-form-label"> Full Name:</label>
         <input type = "text" name = "fullname" readonly class="form-control" id="fullname">
         <div class="modal-footer">            
        
        
         <button type="submit" class="btn btn-primary btn-sm " name = "approved" ><i class="fa fa-save"></i> YES</button>

         <button type="button" class="btn  btn-primary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>CLOSE</button>
         </div>
       
         </div>                 

    </form>
    </div>
    </div>
     </div>



    </div>

  <!-- footer here -->
    <?php include('footer.php');?>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- PACE -->
<script src="../plugins/pace/pace.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script>
     $('#users').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      "scrollX"     : true
    })
    $('.approved').click(function(e){
    e.preventDefault();
    $('#approved').modal('show');
    var id = $(this).data('id');
    var name = $(this).data('name');
      $('#userId').val(id);
      $('#fullname').val(name);

    // alert(id);
    // alert(name);
    $.ajax({
    type: 'POST',
    url: 'updatecredentials.php',
    data: {id:id},
    dataType: 'json'
   
  });


  });
</script> 
</body>
</html>