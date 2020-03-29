<?php



if(isset($_POST['id2'])){
    $id = $_POST['id2'];
    $sql = "SELECT * from tbl_users where id = '$id'";
    $query = $con->query($sql);
    $row = $query->fetch_assoc();

    echo json_encode($row);
}
?>