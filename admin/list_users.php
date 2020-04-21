<?php

$alert_msg='';

$button ="update";
// include('verify_admin.php');
include('../config/db_config.php');
include('../insert_user.php'); 
include('verify_admin.php');
// include('sms.php');
$state ="edit";

//deactivate user
 if(isset($_POST['delete'])){
   $id = $_POST['user_id'];
   $sql = "UPDATE tbl_users set status = 'INACTIVE' where id = $id";
   $set_sql = $con->prepare($sql);
   $set_sql->execute();
   $alert_msg .= ' 
   <div class="alert alert-danger alert-dismissible">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
   <i class="icon fa fa-check"></i>You have successfully deleted the user.
   </div>     
';
 }
?>

<!DOCTYPE html> 
<html >



<body class="hold-transition sidebar-mini">

<div class="wrapper">
<?php include('header.php');?>
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
         <?php echo $alert_msg;
        //  echo $alert; ?>      
                   
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
                            <th> Options </th>
                            
                          
                      </thead>

                      <tbody>
                           
                      </tbody>
                    </table>
                  </div>
                </form>
              </div>       
         
          </div>
      </section>
      
      <div  class="modal fade"  id="modal-sms">
    <div class="modal-dialog " role="document">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form role="form" method="post" action="<?php htmlspecialchars("PHP_SELF");?>">
      <div class = "container">
      <div class = "row">
      <div class ="col-12">
        <div class = "input-group">
     Full Name:<input type = "text" style="margin-left:10px;" readonly class="form-control" name = "personnum" id = "person">
     </div>
                 <input type="hidden" id="user_id" readonly class="form-control" name="user_id" >
           </div>
           </div>
                
     
     
           </div>
      <div class="modal-footer">
      
        <button type="submit" name = "delete" class="btn btn-primary" >DELETE</button>
        <button   class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
  </div>
  </div>

    </div>
    </div>
     </div>


     <?php include('../adduser_modal.php');?>
    </div>

  <!-- footer here -->
 
  
  
    <?php include('footer.php');?>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/jquery/jquery.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- datepicker -->
<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- PACE -->
<script src="../plugins/pace/pace.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables/jquery.dataTables.js"></script>
<script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="../plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
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
        
function post_notify(message, type){

if (type == 'success') {

  $.notify({
    message: message
  },{
    type: 'success',
    delay: 10000
  });

} else{

  $.notify({
    message: message
  },{
    type: 'danger',
    delay: 2000
  }); 

}

}
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
							$("#users").append('<tbody class="users-error"><tr>< td colspan="3">No data found in the server</td></tr></tbody>');
							$("#users_processing").css("display","none");
             
						}
            // error: function (xhr, b, c) {
            //     console.log("xhr=" + xhr.responseText + " b=" + b.responseText + " c=" + c.responseText);
            // }
					},
          "columnDefs": 
          
          [ { "width": "30px", "targets": 0 },
           {   "width": "150px", "targets": 1 },
           {   "width": "200px", "targets": 3 },
           {   "width": "120px", "targets": 4 },
            {    "width": "90px",
                "targets" : -1,
                "data" : null,
                "defaultContent": '<button class="btn btn-success btn-sm btn-flat approved" id ="btn">  <i class="fa fa-check"></i></button> <button class="btn btn-danger btn-sm btn-flat " id = "edituser" name = "editu">  <i class="fa fa-edit"></i> </button> <button class="btn btn-warning btn-sm btn-flat" id ="delete">  <i class="fa fa-trash"></i></button> '
          
         
              }],

				} );
//         setInterval( function () {
//     dataTable.ajax.reload();
// }, 10000 ); 
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
       success: post_notify('User Activated', 'success')
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
        $('#users tbody').on( 'click', '#delete', function(){
        // $("#users").on("click","button.btn",function(){
        // $('.approved').on( 'click',function() {
          event.preventDefault();
         var table = $('#users').DataTable();
         var data = table.row( $(this).parents('tr') ).data();
         var id = data[0];
          var fullname = data[1];
          $('#modal-sms').modal('toggle');
          $('#person').val(fullname);
          $('#user_id').val(id);
          // getnumber(id);
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
         $('#user_id_edit').val(id);
        $('#username').val(result.username);
        $('#firstname').val(result.firstname);
        $('#middlename').val(result.middlename);
        $('#lastname').val(result.lastname);
        $('#gender').val(result.gender);
        $('#address').val(result.address);
        $('#datepicker').val(result.birthdate);
        $('#email').val(result.email);
        $('#contactno').val(result.mobileno);
        $('#usertype').val(result.account_type);
        // $('#user_id').val(result.id);
        var img = document.getElementById("profilepic");
        img.src = '../userimage/'+result.photo;
         console.log(result.account_type);
        
       },
       error: function (xhr, b, c) {
                console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            }
     });
 
}


$(document).ready(function() {  
  
  $('#username').keyup(function(){
    var username = $('#username').val();
   
  $.ajax({
    type:"POST",
    url:"../check_username.php",
    data:{uname:username},
    success: function(response){
      var result = jQuery.parseJSON(response);
      if(result.data1!= ''){
        // $('#username').toggle("tooltip");
        // $('#username').attr("title","This username is already taken.");
        $('#checkusername').html('This username is already taken.');
        $('#save').prop('disabled', true);
  // console.log(result.data1);
  }
  else{
    if(username !=''){
      $('#checkusername').html('This username is available.');
      $('#save').prop('disabled', false);
  }
  }
    },
    error: function (xhr, b, c) {
     console.log("xhr=" + xhr.responseText + " b=" + b.responseText + " c=" + c.responseText);
       }
  })
  if(username == ''){
    $('#checkusername').html('');
    $('#save').prop('disabled', true);
  }
  
  })
  
  $('#email').keyup(function(){
    var mail = $('#email').val();
   
  $.ajax({
    type:"POST",
    url:"../check_username.php",
    data:{email:mail},
    success: function(response){
      var result = jQuery.parseJSON(response);
      if(result.data2!= ''){
        $('#checkemail').html('This email is already taken.');
        $('#save').prop('disabled', true);
  // console.log(result.data1);
  }
  else{
    if(mail !=''){
      $('#checkemail').html('This email is available.');
      $('#save').prop('disabled', false);
  }
  }
    },
    error: function (xhr, b, c) {
     console.log("xhr=" + xhr.responseText + " b=" + b.responseText + " c=" + c.responseText);
       }
  })
  if(mail == ''){
    $('#checkemail').html('');
    $('#save').prop('disabled', false);
  }
  
  
  })
  
  
  });
  

  });


  function loadImage(){
var input = document.getElementById("fileToUpload");
var fReader = new FileReader();
fReader.readAsDataURL(input.files[0]);
fReader.onloadend = function(event){
    var img = document.getElementById("profilepic");
    img.src = event.target.result;
}
}


</script> 
</body>
</html>