<?php
include('../config/db_config.php');
// $imageresult = '';
if(isset($_POST['photo'])){
$img = $_POST['photo'];
$sql ="SELECT image from tbl_incident where  objid = :image";
$get_image = $con->prepare($sql);
$get_image->execute([':image' => $img]);
$result = $get_image->fetch(PDO::FETCH_ASSOC)){
    $loadImage = $result['image'];


$data  = array('loadImage' =>$loadImage,
                'id'       =>  $img);



}
echo json_encode($data);
}
// if($loadImage == ""){
//     $loadImage = '../postimage/sancarlos.png';
// }


?>