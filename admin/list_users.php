<?php

session_start();
include ('../config/db_config.php');
include('update_user.php'); 
include('header.php');
$alert_msg='';
$state ="edit";
$button ="update";
if (!isset($_SESSION['id'])) {
    header('location:../index');
}

$user_id = $_SESSION['id'];

//querry to select current user's information

?>

<!DOCTYPE html> 
<html >



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
            <div class="Ashake form-group has-feedback">
         <?php echo $alert_msg; ?>      
                   
        </div>
            <div class="card-body">

              <div class="box box-primary">
                <form role="form" method="get" action="<?php htmlspecialchars("PHP_SELF");?>">

                  <div class="box-body">
                  
                    <table id="users" class="table table-bordered table-striped ">
                      <thead>
                      
                       
                            <th> ID </th>
                            <th> Full Name </th>
                            <th> username </th>
                            <th > Email</th>                                                                 
                           <th> Contact No. </th>
                            <th> Status </th>
                            <th> Approved </th>
                            
                          
                      </thead>

                      <tbody>
                           
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
    <!-- <form class =form-horizontal method ="POST" action = "updatecredentials.php"  enctype="multipart/form-data">
         <div class = "modal-body ">

         <label class = "col-sm-2 col-form-label"> User ID:</label>
         <input type = "text" name = "userId" readonly class="form-control" id="userId">
         <label class = "col-sm-3 col-form-label"> Full Name:</label>
         <input type = "text" name = "fullname" readonly class="form-control" id="fullname">
         <div class="modal-footer">            
        
        
         <button type="submit" class="btn btn-primary btn-sm " name = "approved" ><i class="fa fa-save"></i> YES</button>

         <button type="button" class="btn  btn-primary btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>CLOSE</button>
         </div>
       
         </div>                 

    </form> -->
    </div>
    </div>
     </div>



    </div>

  <!-- footer here -->
  <?php include('../adduser_modal.php');?>
  
    <?php include('footer.php');?>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/jquery/jquery.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- PACE -->

<script src="../plugins/pace/pace.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script>
    //  $('#users').DataTable({
    //   'paging'      : true,
    //   'lengthChange': true,
    //   'searching'   : true,
    //   'ordering'    : true,
    //   'info'        : true,
    //   'autoWidth'   : true,
    //   'scrollX'     : true
   
    // });

  //            $(document).ready(function() {
  //               $(document).ajaxStart(function() {
  //                   Pace.restart()
  //               })


       

  //           });
  // //   $('.approved').click(function(e){
  //   e.preventDefault();
  //   $('#approved').modal('show');
  //   var id = $(this).data('id');
  //   var name = $(this).data('name');
  //     $('#userId').val(id);
  //     $.post("getUserdetail.php",
  //     {id:id},
  //     function(response){
  //       $("#fullname").html(response);
  //     }
  //     );
    
  //  function getDetails(id){
  //   alert(id);
  //   alert(name);
  //   $.ajax({
  //   type: 'POST',
  //   url: 'updatecredentials.php',
  //   data: {id:id},
  //   dataType: 'json'
   
  // };





  $(document).ready(function() {  
        // var office = $('#department').val();
        
				var dataTable = $('#users').DataTable( {
          
          "page"      : true,
          "stateSave" :true,
					"processing": true,
          "serverSide": true,
          'scrollX'   : true,
					"ajax":{
						url :"search_user.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$("#users-error").html("");
							$("#users").append('<tbody class="users-error"><tr>< th colspan="3">No data found in the server</th></tr></tbody>');
							$("#users_processing").css("display","none");
             
						}
					},
          "columnDefs": [{
                "targets" : -1,
                "data" : null,
                "defaultContent": '<button class="btn btn-success btn-sm btn-flat approved" id ="btn">  <i class="fa fa-check"></i></button> <button class="btn btn-danger btn-sm btn-flat " id = "edituser" name = "editu">  <i class="fa fa-edit"></i></button>'
          
         
              }],
   
				} );
       $('#users tbody').on( 'click', '#btn', function(){
        // $("#users").on("click","button.btn",function(){
        // $('.approved').on( 'click',function() {
      
         var table = $('#users').DataTable();
         var data = table.row( $(this).parents('tr') ).data();
    
          var id = data[0];
          $.ajax({
       type: 'POST',
      url: 'updatecredentials.php',
      data: {id:id},
       dataType: 'json',
       
       })
      //  table.ajax.reload();
  });
 
     
        $('#users tbody').on( 'click', '#edituser', function(){
        // $("#users").on("click","button.btn",function(){
        // $('.approved').on( 'click',function() {
          event.preventDefault();
         var table = $('#users').DataTable();
         var data = table.row( $(this).parents('tr') ).data();
    
          var id = data[0];
          $('#edit').modal('toggle');
          getRow(id);
          // console.log(id);
        });
       
       
       
       
   function getRow(id){
    $.ajax({
           type:"POST",
            url:'getUserdetail.php',
            data:{userId:id},
         
            success:function(response){
        console.log("hello");
        var result = jQuery.parseJSON(response);
         $('#user_id').val(id);
        $('#username').val(result.username);
        $('#fullname').val(result.fullname);
        $('#gender').val(result.gender);
        $('#address').val(result.address);
        $('#datepicker').val(result.birthdate);
        $('#email').val(result.email);
        $('#contactno').val(result.mobileno);
        $('#usertype').val(result.account_type);
        $('#user_id').val(result.id);
         console.log(result.account_type);
        
       },
       error: function (xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
     });
 
} 
  });

</script> 
</body>
</html>