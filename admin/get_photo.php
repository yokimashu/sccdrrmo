<?php
  $loadImage = '';
// include('../config/db_config');
// $imageresult = '';
if(isset($_POST['image'])){
$img = $_POST['objid'];
$sql ="SELECT image from tbl_incident where  objid = :image";
$get_image = $con->prepare($sql);
$get_image->execute([':image' => $img]);
while ($result = $get_image->fetch(PDO::FETCH_ASSOC)){
    $loadImage = $result['image'];

}
}
if($loadImage == ""){
    $loadImage = '../postimage/sancarlos.png';
}
$data  = array('loadImage' =>$loadImage);
echo json_encode($data);
}

?>