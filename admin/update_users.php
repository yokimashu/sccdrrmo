 <?php

include ('../config/db_config.php');
//include('import_pdf.php');

$alert_msg = '';
$alert_msg1 = '';
if (isset($_POST['update_users'])) {

    //     echo "<pre>";
    //     print_r($_POST);
    // echo "</pre>";
  
    
// if ($type!="DV"){


    $status = 'Approved';


    $update_users_sql = "UPDATE tbl_users SET 
    status = :stat
  ";
            
    $update_users_data = $con->prepare($update_users_sql);
    $update_userss_data->execute([
        ':stat'             => $status
    
       
        ]);


        header("location: list_users.php?id=$user_id"); 


}

?>