<?php 

if(isset($_GET['entity_no'])){
 
    $landtranspo = $_GET['entity_no'];
    // echo "<p>";
    // echo print_r($landtranspo);
    // echo "</p>";
    $sql = "SELECT *,e.username FROM tbl_landtranspo l inner join 
    tbl_entity e on l.entity_no = e.entity_no where l.entity_no  = :entity_no limit 1 ";
    $execute_sql = $con->prepare($sql);
    $execute_sql->execute([':entity_no' => $landtranspo]);
    while($result = $execute_sql->fetch(PDO::FETCH_ASSOC))
    {
 $date_reg = $result['date_register'];
$entity_no = $result['entity_no'];
$user_name = $result['username'];$
$transpo = $result['trans_type'];
$vehicle_name =$result['vehicle_name'];
$vehicle_no = $result['vehicle_no'];
$plate_no = $result['plate_no'];
$route = $result['route'];
$contact_name =$result['contact_name'];
$contact_position =$result['contact_position'];
$mobile_no = $result['mobile_no'];
$tel_no = $result['telephone_no'];
$email_address = $result['email'];
$get_photo = $result['photo'];
//    echo "<p>";
//     echo print_r($photo);
//     echo "</p>";
    }
}

?>