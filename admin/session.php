<?php
//this page controls the user access to the system.

//admin 
$registration_list='';

//user

$user_id = $_SESSION['id'];
$account_type = $_SESSION['user_type'];
if($account_type == 1){
    require_once('user_controls.php');
} else {

}
// echo "<pre>";
// echo print_r($user_id);
// echo "</pre>";
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
} 

?>