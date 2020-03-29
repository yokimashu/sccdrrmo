<?php
    
    include('config/db_config.php');
   
    //variable declaration
       $alert_msg = '';
       include('insert_user.php');
       //sign in button
        if (isset($_POST['signin'])){
            //to check if data are passed
            // echo "<pre>";
            //     print_r($_POST);
            // echo "</pre>";
    
            $username = $_POST['username'];
            $password = $_POST['password'];
    
            $check_username_sql = "SELECT * FROM tbl_users where username = :uname and status =:status";
            
            $username_data = $con->prepare($check_username_sql);
            $username_data ->execute([
              ':uname' => $username,
              ':status' => 'ACTIVE',
            ]);
              if ($username_data->rowCount() > 0){
                while ($result = $username_data->fetch(PDO::FETCH_ASSOC)) {
              
                  //from database already hash
                  $hash_password = $result['password'];
        
                  //hash the $u_pass and compared to $hashed_password
                  if (password_verify($password, $hash_password)) {
                   session_start();
                   $_SESSION['id'] = $result['id'];
    
                    if ($result['account_type'] == 1) {
                      
    
    
                      header('location: admin'); //location is folder
                    }
                    else {
                      header('location: user');
                    }
                  }
                  else{
                    //echo "Password does not match!";
                    $alert_msg .= ' 
                    <div class="alert alert-danger alert-dismissible">
                        <i class="icon fa fa-warning"></i>
                        Incomplete Details!
                    </div>     
                    
                ';
             
                  }
        
                    
                }
            }else{
              $alert_msg .= ' 
              <div class="alert alert-danger alert-dismissible">
                  <i class="icon fa fa-warning"></i>
                  Username does not exist!
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
  <title>SCCDRRMO ERP | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="../dist/css/ionicons.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart
  <link rel="stylesheet" href="../plugins/morris/morris.css">
  jvectormap -->
  <!-- <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css"> -->
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
   <!-- DataTables -->
   <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap4.css">
   <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    
    <img src="dist/img/scdrrmo_logo.png" class="ArotateHover img-circle" width="150px">
    
    <br>
    <a><b>SCCDRRMO</b> Emergency Response Portal</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
      <div class="form-group has-feedback">
        
                  <?php echo $alert_msg; ?>
                
                             
      </div>

      <div class="form-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-user"></i></span>
        <input type="text" class="form-control" name="username" placeholder="Username">
      </div>
      </div>

      <div class="form-group">
      <div class="input-group-prepend">
      <span class="input-group-text"><i class="fa fa-lock"></i></span>
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>
      </div>

      <br>

      <div class="row">
        <div class="col-md-6">
          <a href="#addnew" data-toggle="modal" style ="color:white;"  data-backdrop="static"  class="btn btn-primary pull-left">Sign Up</a>
        </div>
        <div class="col-md-6">
          <input type="submit" class="btn btn-success pull-right" name="signin" value="Sign In">
        </div>
      </div>
    
    </form>
  </div><!-- /.login-box-body -->
 
</div><!-- /.login-box -->
</body> 

<?php include('adduser_modal.php'); ?>
<?php include('insert_user.php');?>
<!-- jQuery 3 -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>

</body>

</html>
