<?php



if($_REQUEST["id"]){
    $id = $_REQUEST["id"];
    $sql = "SELECT * from tbl_users where id = :id";
    user_data = $con->prepare($sql);
    user_data  ->execute([':id' => $id])
    while ($result =  user_data ->fetch(PDO::FETCH_ASSOC)) {
        $fullname = result['fullname'];

    }
    echo $fullname;
}
?>