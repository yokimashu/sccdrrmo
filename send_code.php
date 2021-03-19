<?php
session_start();

//variable declaration
$alert_msg = '';
$phonenumber = $_SESSION['phone'];


?>



<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VAMOS| Vaccine Registration System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="stylesheet" href="../plugins/pixelarity/pixelarity.css">
  <!-- <link rel="stylesheet" href="../plugins/pixelarity/jquerysctipttop.css"> -->
  <!-- <link rel="stylesheet" href="../plugins/toastr/toastr.min.css"> -->

  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap4.css">
  <!-- <link rel="stylesheet" href="../plugins/datatables/jquery.dataTables.css"> -->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <script src="https://kit.fontawesome.com/629c6e6cbc.js" crossorigin="anonymous"></script>
  <script src="https://www.gstatic.com/firebasejs/8.2.9/firebase-app.js"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="https://www.gstatic.com/firebasejs/ui/4.7.3/firebase-ui-auth.css" />



</head>

<body class="hold-transition lockscreen">
  <!-- Automatic element centering -->
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <a href="../../index2.html"><b>VERIFY </b>Account</a>
    </div>
    <!-- User name -->
    <!-- <div class="lockscreen-name">John Doe</div> -->

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item" id="sendcode">
      <!-- lockscreen image -->
      <div class="lockscreen-image">
        <img src="dist/img/cellphone.png">
      </div>
      <!-- lockscreen credentials (contains the form) -->
      <form class="lockscreen-credentials">
        <?php echo $alert_msg; ?>
        <div class="input-group">
          <input readonly type="text" style="background-color:beige" class="form-control" id="number" value="<?php echo $phonenumber; ?>">
          <div class="input-group-append">
            <button type="button" id="send" class="btn primary" style="color: #FFFFFF; background-color:green" onclick="phoneAuth();"> SendCode</button>

          </div><br>
          <div align="center" style="transform:scale(0.70);-webkit-transform:scale(0.70);transform-origin:0 0;-webkit-transform-origin:0 0;" id="recaptcha-container"></div>

      </form>
      
    </div>
    
  <div class="text-center">
    <a href="vaccine.php">Sign in as a different user</a>
  </div><br>
  </div>


  <div class="lockscreen-wrapper" >
    <div class="lockscreen-logo">
      <!-- <a href="../../index2.html"><b>ENTER </b>Code</a> -->
    </div>
    <!-- User name -->
    <!-- <div class="lockscreen-name">John Doe</div> -->

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item" id="verify">
      <!-- lockscreen image -->
      <div class="lockscreen-image">
        <img src="dist/img/cellphone.png">
      </div>
      <!-- lockscreen credentials (contains the form) -->
      <form class="lockscreen-credentials">
        <?php echo $alert_msg; ?>
        <div class="input-group">
          <input type="text" style="background-color:beige" class="form-control" id="verificationCode" placeholder="Enter verification code">
          <button type="button" class="btn" onclick="codeverify();"><i class="fa fa-arrow-right text-muted"></i></button>
          <!-- <button type="button" onclick="codeverify();">Verify code</button> -->
        </div>
      </form>
      <div class="help-block text-center">
    Enter the 6-digit code we sent to your registed mobile number.
  </div><br>
  <!-- <div class="text-center">
    <a href="lvaccine.php">Or sign in as a different user</a>
  </div> -->


      <!-- jQuery -->
      <script src="../plugins/jquery/jquery.min.js"></script>
      <!-- Bootstrap 4 -->
      <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- datepicker -->
      <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
      <!-- CK Editor -->
      <script src="../plugins/ckeditor/ckeditor.js"></script>
      <!-- Bootstrap WYSIHTML5 -->
      <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
      <!-- Slimscroll -->
      <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
      <!-- FastClick -->
      <!-- <script src="../plugins/fastclick/fastclick.js"></script> -->
      <!-- AdminLTE App -->
      <script src="../dist/js/adminlte.js"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <!-- <script src="../dist/js/pages/dashboard.js"></script> -->
      <!-- AdminLTE for demo purposes -->
      <script src="../dist/js/demo.js"></script>
      <!-- DataTables -->
      <!-- <script src="../plugins/datatables/jquery.dataTables.js"></script> -->
      <script src="../plugins/pixelarity/pixelarity-face.js"></script>
      <!-- <script src="../plugins/pixelarity/pixelarity-faceless.js"></script>
    <script src="../plugins/pixelarity/script-faceless.js"></script> -->
      <!-- <script src="../plugins/pixelarity/jquery.3.4.1.min.js"></script> -->
      <!-- <script src="../plugins/datatables/dataTables.bootstrap4.js"></script> -->
      <!-- Toastr -->
      <!-- <script src="../plugins/toastr/toastr.min.js"></script> -->
      <!-- Select2 -->
      <!-- <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script> -->
      <script src="../plugins/cameracapture/webcam-easy.min.js"></script>
      <!-- <script src="../plugins/webcamjs/webcam.js"></script> -->
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->
      <!-- textarea wysihtml style -->
      <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
      <!-- <script src="jpeg_camera/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script> -->
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     -->

      <!-- <script src="jpeg_camera/dist/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script> -->

      <script src="../plugins/select2/select2.full.min.js"></script>




      <!-- The core Firebase JS SDK is always required and must be listed first -->
      <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

      <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#config-web-app -->

      <script>
        // Your web app's Firebase configuration
        var firebaseConfig = {
          apiKey: "AIzaSyBcAmZpS6tbd5vvIlXly-60wFr2PgEVZCw",
          authDomain: "vamos-mobile-scc2020.firebaseapp.com",
          projectId: "vamos-mobile-scc2020",
          storageBucket: "vamos-mobile-scc2020.appspot.com",
          messagingSenderId: "450868149198",
          appId: "1:450868149198:web:2188b50906f617bb00499f"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
      </script>
      <!-- <script src="NumberAuthentication.js" type="text/javascript"></script> -->
      <script>
        window.onload = function() {
          render();
          var y = document.getElementById("verify");
          y.style.display = "none";
      


        };

        function render() {
          window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
          recaptchaVerifier.render();
        }

        function phoneAuth() {
          //get the number
          var number = document.getElementById('number').value;
          //phone number authentication function of firebase
          //it takes two parameter first one is number,,,second one is recaptcha
          firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult) {
            //s is in lowercase
            window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;
            console.log(coderesult);

            var x = document.getElementById("sendcode");
            x.style.display = 'none';
            var y = document.getElementById("verify");
            y.style.display = 'block';
            // var y = document.getElementById("verify");
          
           
          }).catch(function(error) {
            alert(error.message);
          });

          // $('sendcode').prop("hidden", true);



        }

        function codeverify() {
          var code = document.getElementById('verificationCode').value;
          coderesult.confirm(code).then(function(result) {
            window.open("vaccine_registry/profile.php", '_parent');
            var user = result.user;
            console.log(user);
          }).catch(function(error) {
            alert(error.message);
          });
        }
      </script>

</body>

</html>