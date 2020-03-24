<?php

   include('db-config.php');
//variable declaration
  //  $alert_msg = '';
  //    echo "<pre>";
  //    print_r($_POST);
  //    echo "</pre>";

   //sign in button
    // if (isset($_POST['email'])){
        //to check if data are passed
        // echo "<pre>";
        //     print_r($_POST);
        // echo "</pre>";

        $email = $_POST['email'];
        $password = $_POST['password'];

        $check_username_sql = "SELECT * FROM users where email = :email";
        
        $username_data = $con->prepare($check_username_sql);
        $username_data ->execute([
          ':email' => $email
        ]);

          if ($username_data->rowCount() > 0){
            while ($result = $username_data->fetch(PDO::FETCH_ASSOC)) {
          
              //from database already hash
              $hash_password = $result['password'];
    
              //hash the $u_pass and compared to $hashed_password
              if (password_verify($password, $hash_password)) {
               session_start();
               $_SESSION['id'] = $result['id'];

                    if ($result['status'] == "INACTIVE") {
                       echo "inactive";
                   }
                   
              }
            }
            }else{
              echo "invalid";

      }

  

?>