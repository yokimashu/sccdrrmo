<?php
include('../config/db_config');
// $imageresult = '';
if(isset($_POST['image'])){
$img = $_POST['image'];
$sql ="SELECT image from tbl_incident where  objid = :image";
$get_image = $con->prepare($sql);
$get_image->execute([':image' => $img]);
while ($result = $get_image->fetch(PDO::FETCH_ASSOC)){
    $imageresult = $result['image'];

    // echo json_encode($imageresult);
}
echo '<image src='$imageresult'></image>';
}

?>