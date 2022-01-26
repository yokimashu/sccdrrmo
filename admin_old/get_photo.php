<?php
include('../config/db_config.php');
// $imageresult = '';
//Checks if the objid of the user is set.
if(isset($_POST['photo'])){
$img = $_POST['photo'];
$sql ="SELECT image from tbl_incident where  objid = :image";
$get_image = $con->prepare($sql);
$get_image->execute([':image' => $img]);

//fetch the image path from the database.
while($result = $get_image->fetch(PDO::FETCH_ASSOC))
{
    $loadImage = $result['image'];

}
//if the image field is empty return another file.
if($loadImage == "")
{
$loadImage= 'scdrrmo_logo.png';
}

//get the data from the database and return as a json format.
$data  = array(
                'loadImage' => $loadImage,
                'id'        =>  $img
            );

echo json_encode($data);
}
// if($loadImage == ""){
//     $loadImage = '../postimage/sancarlos.png';
// }


?>