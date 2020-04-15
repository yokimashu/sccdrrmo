<?php
include('config/db_config.php');

if(isset($_POST['uname'])){
$uname = $_POST['uname'];
$username= '';
$email = '';
$sql = "SELECT * from tbl_users where username = :usname";
$check_sql = $con->prepare($sql);
$check_sql->execute([':usname' => $uname]);
while($result = $check_sql->fetch(PDO::FETCH_ASSOC)){

    $username = $result['username'];
    $email = $result['email'];
}
$data = array('data1' => $username,
                'data2' => $email);
echo json_encode($data);
}


if(isset($_POST['email'])){
    $uname = $_POST['email'];
    $username= '';
    $email = '';
    $sql = "SELECT * from tbl_users where email = :usname";
    $check_sql = $con->prepare($sql);
    $check_sql->execute([':usname' => $uname]);
    while($result = $check_sql->fetch(PDO::FETCH_ASSOC)){
    
        $username = $result['email'];
        $email = $result['email'];
    }
    $data = array('data1' => $username,
                    'data2' => $email);
    echo json_encode($data);
    }
    
    

?>