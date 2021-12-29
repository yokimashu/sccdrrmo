<?php

include('../config/db_config.php');

?>





<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>ISABELA | Scan QR Code</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">



    <!-- Main footer -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="login-logo">
          <!-- <img src="../dist/img/isabela.jpg" width="150px"> -->
        </div>
        <div class="login-logo">
          <img src="../dist/img/isabela.jpg" width="115px">
        </div>
        <!-- <h2 class="text-center display-6">SCAN QR CODE</h2> -->
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <form role="form" enctype="multipart/form-data" method="post" id="input-form" action="<?php htmlspecialchars("PHP_SELF"); ?>">
              <div class="input-group">
                <input type="text" disable class="form-control form-control-lg" id="entityno" name="entityno" placeholder="SCAN / ENTER QR CODE HERE">
                <div class="input-group-append">
                  <!-- <button type="submit" class="btn btn-lg btn-default">
                    <i class="fa fa-search"></i>
                  </button> -->
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>


      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="../flutter/images/<?php echo $photo ?>" id="tphoto">
                </div>

                <h3 class="profile-username text-center"><span id="fullname"><span></h3>

                <div id="status"></div>
                <p class="text-muted text-center"><span id="entity"><span></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Birthdate:</b> <a class="float-right"><span id="birthdate"><span></a>
                  </li>
                  <li class="list-group-item">
                    <b>Gender:</b> <a class="float-right"><span id="gender"><span></a>
                  </li>
                  <li class="list-group-item">
                    <b>Address:</b> <a class="float-right"><span id="address"><span></a>
                  </li>
                  <li class="list-group-item">
                    <b>Contact No.:</b> <a class="float-right"><span id="contactno"><span></a>
                  </li>
                </ul>

                <!-- | <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>


    </section>


    <!-- Content Header (Page header) -->

    <!-- Main content -->


    <!-- Control Sidebar -->

  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src=" ../dist/js/demo.js"></script>


  <script>
    document.getElementById('entityno').focus();


    $('#entityno').on('change', function() {
      var entityno = document.getElementById('entityno').value
      // alert(entityno);

      console.log(entityno);

      $.ajax({
        type: "POST",
        url: 'profile_vaccine.php',
        data: {
          entity_no: entityno
        },
        error: function(xhr, b, c) {
          console.log(
            "xhr=" +
            xhr.responseText +
            " b=" +
            b.responseText +
            " c=" +
            c.responseText
          );
        },
        success: function(response) {
          var result = jQuery.parseJSON(response);
          console.log('response from server', result);

          jQuery("#entity").text(result.data);
          jQuery("#fullname").text(result.data1);
          jQuery("#birthdate").text(result.data5);
          jQuery("#gender").text(result.data10);
          jQuery("#address").text(result.data7);
          jQuery("#contactno").text(result.data12);
          $('#tphoto').attr("src", "../flutter/images/" + result.data13);

          document.getElementById('entityno').focus();
          document.getElementById('entityno').select();

          // $('#fullname').val(result.data1);
          // $('#firstname').val(result.data2);
          // $('#middlename').val(result.data3);
          // $('#lastname').val(result.data4);
          // $('#birthdate').val(result.data5);
          // $('#street').val(result.data7);
          // $('#barangay').val(result.data8);
          // $('#ages').val(result.data9);
          // $('#email-add').val(result.data14);
          // $('#acct-stat').val(result.data15);

        },

      });
      document.getElementById('entityno').focus();
      document.getElementById('entityno').select();

    });
  </script>
</body>

</html>