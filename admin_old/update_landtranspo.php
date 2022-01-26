<?php

if(isset($_POST['update_landtranspo'])){
    //     echo "<p>";
    // echo print_r($_POST['entity_no']);
    // echo "</p>";
    $img = $_POST['image'];
    $sql_syntax = "UPDATE tbl_landtranspo SET
        trans_type           =   :transtype,
        vehicle_name         =   :vehicle_name,
        vehicle_no           =  :vehicle_no,
        plate_no              = :plate_no,
        route               =   :route,
        contact_name         =  :contact_name,
        contact_position     =  :contact_position,
        mobile_no           =   :mobile_no,
        telephone_no        =   :tel_no,
        email               =   :email 
        where entity_no =   :entity_no
    ";
    $exe_syntax = $con->prepare($sql_syntax);
    $exe_syntax->execute([
        ':transtype'     =>  $_POST['land_transpo_type'],
        ':vehicle_name' =>  $_POST['vechicle_name'],
        ':vehicle_no' =>    $_POST['vehicle_no'],  
        ':plate_no' =>      $_POST['plate_no'],
        ':route' =>           $_POST['route'],
        ':contact_name' =>  $_POST['contact_name'],
        ':contact_position' =>  $_POST['contact_position'],
        ':mobile_no' =>  $_POST['mobile_no'],
        ':tel_no' =>  $_POST['telephone_no'],
        ':email' =>  $_POST['email'],
        ':entity_no' =>  $_POST['entity_no'],
        
    ]);

    $insert_entity_sql = "UPDATE tbl_entity SET  
    username            = :username
    where entity_no     = :entity";


      $entity_data = $con->prepare($insert_entity_sql);
      $entity_data->execute([

          ':entity'           => $_POST['entity_no'],
          ':username'         =>  $_POST['username']
          
      ]);

      if($img != '' ){
        $folderPath = "../flutter/images/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.jpg';        
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        $update_photo = "update tbl_landtranspo set photo = :photo where entity_no = :entity";
        $exe_update= $con->prepare($update_photo);
        $exe_update->execute([':photo' =>$fileName,
                            ':entity' =>$_POST['entity_no']]);
        $get_photo = $fileName;
        $check_update_photo = $fileName;

    // echo "<p>";
    // echo print_r($fileName);
    // echo "</p>";
    };
    
    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Success ! </strong> Data Inserted.
        </div>    
      ';
        
}

?>