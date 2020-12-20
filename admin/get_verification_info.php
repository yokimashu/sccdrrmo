<?php
include('../config/db_config.php');
$entity_no = $_POST['entityno'];

    $sql = "SELECT e.username , i.firstname,i.middlename,i.lastname,i.gender,i.birthdate, 
            i.barangay,i.mobile_no, i.photo, v.photo FROM tbl_individual i inner join tbl_entity e on 
             i.entity_no = e. entity_no inner join tbl_verification v on i.entity_no = v.entity_no  
             WHERE i.entity_no = :entity LIMIT 1"; 

$exe_sql = $con->prepare($sql);
$exe_sql->execute([':entity' => $entity_no]);


$username='';
$firstname ='';
$middlename ='';
$lastname ='';
$gender ='';
$birthdate ='';
$barangay ='';
$mobile = '';
$userphoto = '';
$verifyphoto = '';


while($result = $exe_sql->fetch(PDO::FETCH_ASSOC)) {
    $username= $result['e.username'];
    $firstname= $result['i.firstname'];
    $middlename= $result['i.middlename'];
    $lastname= $result['i.lastname'];
    $gender= $result['i.gender'];
    $birthdate= $result['i.birthdate'];
    $barangay= $result['i.barangay'];
    $mobile= $result['i.mobile_no'];
    $userphoto= $result['i.photo'];
    $verifyphoto= $result['v.photo'];
}


$data = array(
    'username'   =>         $username,
    'firstname'      =>     $firstname,
    'middlename'    =>      $middlename,
    'lastname'   =>          $lastname, 
    'gender'         =>      $gender,
    'birthdate'   =>         $birthdate,
    'barangay'   =>           $barangay, 
    'mobile'=>               $mobile,
    'userphoto'   =>         $userphoto,
    'verifyphoto'   =>      $verifyphoto
   );
   echo json_encode($data);

   
   ?>