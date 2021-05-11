
 <?php


    include('../config/db_config.php');


    session_start();
    date_default_timezone_set('Asia/Manila');
    // $alert_msg = '';
    if (isset($_POST['update_user'])) {


        $get_entity_no              = $_POST['entity_no'];
        $get_username               = $_POST['username'];
        $get_new_password           = $_POST['password'];
        $hashed_password            = password_hash($get_new_password, PASSWORD_DEFAULT);
        $department                 =  $_POST['department'];
        $get_firstname              = $_POST['first_name'];
        $get_middlename             = $_POST['middle_name'];
        $get_lastname               = $_POST['last_name'];
        $get_account                = $_POST['account_type'];
        $alert_msg = '';
        $alert_msg1 = '';

        if (empty($get_new_password)) {

            $insert_users_sql = "UPDATE tbl_users SET 
         
            
            fullname             = :full_name,
            firstname            = :first_name,
            middlename           = :middle_name,
            lastname             = :last_name,
            username             = :username,
            department           = :dept,
            account_type         = :account
            where entity_no      = :entityNo ";

            $add_user_data = $con->prepare($insert_users_sql);
            $add_user_data->execute([
                ':entityNo'                 => $get_entity_no,
                ':full_name'                => $get_firstname . ' ' . $get_middlename . ' ' . $get_lastname,
                ':first_name'               => $get_firstname,
                ':middle_name'              => $get_middlename,
                ':last_name'                => $get_lastname,
                ':username'                => $get_username,
                ':dept'                   => $department,
                ':account'                => $get_account


            ]);
        } else {
            //update password
            $insert_users_sql = "UPDATE tbl_users SET 
         
            
            fullname             = :full_name,
            firstname            = :first_name,
            middlename           = :middle_name,
            lastname             = :last_name,
            username             = :username,
            department           = :dept,
            password           = :passs,
            account_type         = :account
            where entity_no      = :entityNo ";

            $add_user_data = $con->prepare($insert_users_sql);
            $add_user_data->execute([
                ':entityNo'                 => $get_entity_no,
                ':full_name'                => $get_firstname . ' ' . $get_middlename . ' ' . $get_lastname,
                ':first_name'               => $get_firstname,
                ':middle_name'              => $get_middlename,
                ':last_name'                => $get_lastname,
                ':username'                => $get_username,
                ':dept'                   => $department,
                ':passs'                   => $hashed_password,
                ':account'                => $get_account


            ]);
        }


        if ($add_user_data) {

            $_SESSION['status'] = "Update Successful!";
            $_SESSION['status_code'] = "success";

            header('location: view_user.php?id=' . $get_entity_no);
        } else {
            $_SESSION['status'] = "Update Unsuccessful!";
            $_SESSION['status_code'] = "error";

            header('location: view_user.php?id=' . $get_entity_no);
        }
    }
