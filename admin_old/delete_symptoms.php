<?php
if (isset($_POST['delete_symptoms'])) {

    $delete_user_id = $_POST['user_id'];
    $delete_user_sql = "UPDATE tbl_symptoms SET status ='Inactive' WHERE idno = :id ";
    $delete_user_data = $con->prepare($delete_user_sql);
    $delete_user_data->execute([':id'=>$delete_user_id]);

    header('location: list_symptoms.php');
    
}

?>