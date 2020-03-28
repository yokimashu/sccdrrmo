<?php
include ('../config/db_config.php');
echo "<pre>";
print_r("hello");
echo "</pre>";
if(isset($_POST['userId'])){

$update_credentials= "update tbl_users SET status =:status where user_id = :id";
$update_documents_data = $con->prepare($update_credentials);
    $update_documents_data->execute([
        ':status'             => 'Active',
        ':id'             => $_POST['userId'],


    ]);
    header('location: list_users.php');
}
?>