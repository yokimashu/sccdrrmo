<?php
$alert_msg = '';
include('../config/db_config.php');
include('sql_queries.php');
include('approve_application.php');
session_start();
$user_id = $_SESSION['id'];
$entity_no = '';
// include('verify_admin.php');
if (!isset($_SESSION['id'])) {
  header('location:../index.php');
} else {
}



date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');

$symptoms = $patient = $person_status = $entity_no = '';

//fetch user from database
$get_user_sql = "SELECT * FROM tbl_users where id = :id ";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {


  $db_fullname = $result['fullname'];
}


$get_new_submission = "SELECT * FROM tbl_individual i inner join tbl_verification e on i.entity_no = e.entity_no WHERE status = 'NEW SUBMISSION'";
$get_new_submission_record = $con->prepare($get_new_submission);
$get_new_submission_record->execute();



?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VAMOS | User Verification Master List </title>
  <?php include('heading.php'); ?>


</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include('sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header"></div>
      <div class="float-topright">
                <?php echo $alert_msg; ?>
            </div>
      <section class="content">
        <div class="card card-info">
          <div class="card-header  text-white bg-success">
            <h4> User Verification

              <!-- <a href="add_sea_trans" style="float:right;" type="button" class="btn btn-success bg-gradient-success" style="border-radius: 0px;">
                <i class="nav-icon fa fa-plus-square"></i></a> -->
              <!-- <a href="../cameracapture/capture.php" style="float:right;" type="button" class="btn btn-info bg-gradient-info" style="border-radius: 0px;">
                <i class="nav-icon fa fa-plus-square"></i></a> -->
            </h4>

          </div>

          <div class="card-body">
            <div class="box box-primary">
              <form role="form" method="get" action="">
                <div class="box-body">

                  <div class="table-responsive">
                    <!-- <div class="row">
                      <div class="col-md-3" id="combo"></div>
                    </div>
                    <br> -->


                    <table style="overflow-x: auto;" id="users" name="user" class="table table-bordered table-striped">
                      <thead align="center">
                        <tr style="font-size: 1.10rem">

                          <th> Entity No. </th>
                          <th> Full Name </th>
                          <th> Options</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php while ($list_sea = $get_new_submission_record->fetch(PDO::FETCH_ASSOC)) { ?>
                          <tr>

                            <td><?php echo $list_sea['entity_no'];  ?></td>
                            <td><?php echo $list_sea['fullname']; ?> </td>
                            <td>
                              <button class="btn btn-warning btn-sm" id = "verify" data-toggle="modal">
                                <i class="fa fa-edit"></i></button>
                    </td>
                          </tr>
                        <?php } ?>






                      </tbody>
                    </table>


                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </section>
      <br>
      <?php include('user_verification_modal.php');
      include('enlarge_photo.php');?>

    </div>
    <!-- /.content-wrapper -->
    <?php include('footer.php') ?>

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
  <!-- DataTables Bootstrap -->
  <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
  <!-- Select2 -->
  <script src="../plugins/select2/select2.full.min.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
	<!-- <script src="../plugins/zoomimage2/js/BUP.js" ></script> -->
  <!-- <script src="../plugins/zoomimage2/jquery.zoom.js" ></script> -->
  <!-- <script src="../plugins/zoomimage2/lightense.js" ></script>
  <script src="../plugins/zoomimage2/lightense.min.js" ></script> -->
  <!-- <script src="../plugins/zoomimage2/jquery.zoom.min.js" ></script> -->
<!-- <script src="../plugins/zoomimage/js/jquery.jqZoom.js"></script> -->

  <script>
  var entityglobal = '';


  
  $('#users').DataTable({
    'stateSave':true,
      'destroy':true,
      'paging': true,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': true,
      'autoHeight': true
    });


   


    $('#users tbody').on('click', '#verify', function() {
      // alert ('hello');
      // var row = $(this).closest('tr');
      event.preventDefault();
      var table = $('#users').DataTable();
     var currow=  $(this).closest('tr');
      var col1 = currow.find('td:eq(0)').text();
      //  alert (data[0]);
      //  var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
      // var entity_no = data[0];
      // alert(entity_no);

      $('#verify_modal').modal('toggle');
     
      $.ajax({
        url:'get_verification_info.php',

        
        type:'POST',
        data:{entityno:col1},
        success: function(response){
          var result = jQuery.parseJSON(response);
          $('#entityno').val(result.entityno);      
          $('#username').val(result.username);      
          $('#fname').val(result.firstname);
          $('#mname').val(result.middlename);
          $('#lname').val(result.lastname);
          $('#gender').val(result.gender);  
          $('#bday').val(result.birthdate);
          $('#brgy').val(result.barangay);
          $('#contacts').val(result.mobile);
          $('#photolink').val(result.verifyphoto);
          $('#userimage').attr("src",'../flutter/images/'+result.userphoto);
          $('#userverification').attr("src",'../flutter/verification_images/'+result.verifyphoto);
          $('#enlarge').attr("src",'../flutter/verification_images/'+result.verifyphoto);
        },
        error: function (xhr, b, c) {
     console.log("xhr=" + xhr.responseText + " b=" + b.responseText + " c=" + c.responseText);
       }

      });
    });
    // $(function() {
  //     $("#userverification").jqZoom({
  //     selectorWidth: 30,
  //    selectorHeight: 30,
  //    viewerWidth: 400,
  //    viewerHeight: 300
  // });

// $('[data-toggle="modal"]').hover(function() {
//   var modalId = $(this).data('target');
//   $('#verify_modal').modal('show');
//   event.preventDefault();
//       var table = $('#users').DataTable();
//      var currow=  $(this).closest('tr');
//       var col1 = currow.find('td:eq(0)').text();
//       //  alert (data[0]);
//       //  var data = $('#users').DataTable().row('.selected').data(); //table.row(row).data().docno;
//       // var entity_no = data[0];
//       // alert(entity_no);

//       $('#verify_modal').modal('toggle');
     
//       $.ajax({
//         url:'get_verification_info.php',
//         type:'POST',
//         data:{entityno:col1},
//         success: function(response){
//           var result = jQuery.parseJSON(response);
//           $('#entityno').val(result.entityno);      
//           $('#username').val(result.username);      
//           $('#fname').val(result.firstname);
//           $('#mname').val(result.middlename);
//           $('#lname').val(result.lastname);
//           $('#gender').val(result.gender);  
//           $('#bday').val(result.birthdate);
//           $('#brgy').val(result.barangay);
//           $('#contacts').val(result.mobile);
//           $('#photolink').val(result.verifyphoto);
//           $('#userimage').attr("src",'../flutter/images/'+result.userphoto);
//           $('#userverification').attr("src",'../flutter/verification_images/'+result.verifyphoto);
//           $('#enlarge').attr("src",'../flutter/verification_images/'+result.verifyphoto);
//         },
//         error: function (xhr, b, c) {
//      console.log("xhr=" + xhr.responseText + " b=" + b.responseText + " c=" + c.responseText);
//        }

//       });
// });

// });

$('#userverification').click(function(){

  $('#enlarge_modal').modal('toggle');
  console.log('enlarge');
});

$('#enlarge_cancel').click(function(){

$('#enlarge_modal').modal('hide');
console.log('hide');
});


    // $('#approve').click(function(){
    //   event.preventDefault();
    //   var entity = $('#entityno').val();
    //   console.log(entity);
    // //   var table = $('#users').DataTable();
    // //  var currow=  $(this).closest('tr');
    // //   var col1 = currow.find('td:eq(0)').text();
    //   $.ajax({
    //     url:'approve_application.php',
    //     data:{entityno:entity},
    //     method: 'POST',
    //     dataType:'JSON',
    //     error: function (xhr, b, c) {
    //  console.log("xhr=" + xhr.responseText + " b=" + b.responseText + " c=" + c.responseText);
    //    }

    //   });
    //   $('#users').dataTable().fnDraw();
    // })
  </script>
  <script type="text/javascript">

  // $('img.userverification')
  //   .wrap('<span style="display:inline-block"></span>')
  //   .css('display', 'block')
  //   .parent()
  //   .zoom();
//   window.addEventListener('load', function () {
//   var el = document.querySelectorAll('img.lightense');
//   Lightense(el);
  
// }, false);
  // Lightense("img:not(.no-lightense),.lightense", {

  //     // Example: Event Hooks
  //     beforeShow(config) {
  //       var beforeShowAttr = config.target.getAttribute("before-show-alert");
  //       beforeShowAttr && alert(beforeShowAttr);
  //     },
  //     afterShow(config) {
  //       var afterShowAttr = config.target.getAttribute("after-show-alert");
  //       afterShowAttr && alert(afterShowAttr);
  //     },
  //     beforeHide(config) {
  //       var beforeHideMessage = config.target.getAttribute("before-hide-alert");
  //       beforeHideMessage && alert(beforeHideMessage);
  //     },
  //     afterHide(config) {
  //       var afterHideMessage = config.target.getAttribute("after-hide-alert");
  //       afterHideMessage && alert(afterHideMessage);
  //     }
  //   }); 
  // }
  // , false);
  // document.addEventListener("DOMContentLoaded", function(e) {
  //   function createDom(type, cssClass) {
  //     var div = document.createElement(type);
  //     div.className = cssClass;
  //     return div;
  //   }

  //   var thumb = document.querySelector(".lightense-lazy");
  //   var original = new Image();

  //   // Init wrapper
  //   var wrap = createDom("div", "lightense-lazy-wrap");
  //   thumb.parentNode.insertBefore(wrap, thumb);
  //   wrap.appendChild(thumb);

  //   // Wrap thumbnail
  //   var thumbWrap = createDom("div", "lightense-lazy-thumb");
  //   thumbWrap.appendChild(thumb);
  //   wrap.appendChild(thumbWrap);

  //   // Wrap original
  //   var originalWrap = createDom("div", "lightense-lazy-large");
  //   original.src = thumb.dataset.original;
  //   originalWrap.appendChild(original);
  //   wrap.appendChild(originalWrap);

  //   // Load original image
  //   original.addEventListener(
  //     "load",
  //     function() {
  //       wrap.classList.add("on");
  //     },
  //     false
  //   );
  // });
  </script>
</body>

</html>