<?php
include('../config/db_config');
// $imageresult = '';
if(isset($_POST['photo'])){
$img = $_POST['objid'];
$sql ="SELECT * from tbl_incident where  objid = :image";
$get_image = $con->prepare($sql);
$get_image->execute([':image' => $img]);
// $result = $get_image->fetch(PDO::FETCH_ASSOC)){
//     $loadImage = $result['image'];



// $data  = array('loadImage' =>$loadImage,
//                 'id'       =>  $img);



// }
$row = $get_image->fetch_assoc();
echo json_encode($row);
}
// if($loadImage == ""){
//     $loadImage = '../postimage/sancarlos.png';
// }


?>