<?php


include('config/db_config.php');


//variable declaration
$alert_msg = '';

//sign in button
if (isset($_POST['signin'])) {
  //to check if data are passed
  // echo "<pre>";
  //     print_r($_POST);
  // echo "</pre>";

  $entity_no = $_POST['entity_no'];
  // $password = $_POST['password'];

  $check_username_sql = "SELECT * FROM tbl_individual where entity_no = :entity";

  $username_data = $con->prepare($check_username_sql);
  $username_data->execute([
    ':entity' => $entity_no
    // ':status' => 'ACTIVE',
  ]);
  if ($username_data->rowCount() > 0) {
    while ($result = $username_data->fetch(PDO::FETCH_ASSOC)) {

      //from database already hash
      // $hash_password = $result['password'];

      //hash the $u_pass and compared to $hashed_password
      if ($result['entity_no'] == $entity_no) {
        session_start();
        $_SESSION['id'] = $result['entity_no'];
        $phonenumber = $result['mobile_no'];
        $_SESSION['phone'] = '+63'.ltrim($phonenumber,$phonenumber[0]);
        // $_SESSION['user_type'] = $result['account_type'];
        // if ($result['account_type'] == 1) {

        // header('location: verify.html?phonenumber='. $phonenumber.''); //location is folder
        header('location: send_code.php');
        // }
        // else {
        //   header('location: user');
        // }
      } else {
        //echo "Password does not match!";
        $alert_msg .= ' 
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-warning"></i>
                    Password did not match!
                    </div>     
                    
                ';
      }
    }
  } else {
    $alert_msg .= ' 
              <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="icon fa fa-warning"></i>
              Vamos ID does not exist!
              </div>     
          ';
  }
}



?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Lockscreen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
      <a href="../../index2.html"><b>Vaccine</b>Registry</a>
    </div>
    <!-- User name -->
    <!-- <div class="lockscreen-name">John Doe</div> -->

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
      <!-- lockscreen image -->
      <div class="lockscreen-image">
        <img src="dist/img/scclogo.png">
      </div>
      <!-- /.lockscreen-image -->

      <!-- lockscreen credentials (contains the form) -->
      <form class="lockscreen-credentials" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php echo $alert_msg; ?>
        <div class="input-group">
          <input type="text" class="form-control" name="entity_no" placeholder="VAMOS ID Number">
          <div id="firebaseui-auth-container"></div>
          <div class="input-group-append">
            <button type="submit" name="signin" id="signin" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
          </div>
        </div>
      </form>
      <!-- /.lockscreen credentials -->

    </div>

    
    <!-- /.lockscreen-item -->
    <!-- <div class="help-block text-center">
    Please enter your VAMOS ID No.
  </div> -->
    <div class="text-center">
      <!-- <a href="login.html">Or sign in as a different user</a> -->
    </div>
    <!-- <div class="lockscreen-footer text-center">
    Copyright &copy; 2014-2018 <b><a href="http://adminlte.io" class="text-black">AdminLTE.io</a></b><br>
    All rights reserved
  </div> -->
  </div>
  <!-- /.center -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>

  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- The core Firebase JS SDK is always required and must be listed first -->


  <!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<!-- The core Firebase JS SDK is always required and must be listed first -->


<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->


</body>

</html>