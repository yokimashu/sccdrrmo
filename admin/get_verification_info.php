<?php
include('../config/db_config.php');
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

$entity_no = $_POST['entityno'];

    $sql = "SELECT e.username , i.firstname,i.middlename,i.lastname,i.gender,i.birthdate, 
            i.barangay,i.mobile_no, i.photo as iphoto, v.photo as vphoto FROM tbl_individual i inner join tbl_entity e on 
             i.entity_no = e. entity_no inner join tbl_verification v on i.entity_no = v.entity_no  
             WHERE i.entity_no = :entity LIMIT 1"; 

$exe_sql = $con->prepare($sql);
$exe_sql->execute([':entity' => $entity_no]);




while($result = $exe_sql->fetch(PDO::FETCH_ASSOC)) {
    $username= $result['username'];
    $firstname= $result['firstname'];
    $middlename= $result['middlename'];
    $lastname= $result['lastname'];
    $gender= $result['gender'];
    $birthdate= $result['birthdate'];
    $barangay= $result['barangay'];
    $mobile= $result['mobile_no'];
    $userphoto= $result['iphoto'];
    $verifyphoto= $result['vphoto'];
}


$data = array(
    'entityno'   =>         $entity_no,
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