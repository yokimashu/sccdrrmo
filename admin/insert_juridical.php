<?php



//include('import_pdf.php');

$alert_msg = '';
$alert_msg1 = '';

if (isset($_POST['insert_juridical'])) {


    $entity_no = $_POST['entity_no'];



    $insert_juridical_sql = "INSERT INTO add_juridical SET 

    entity_no        = :entity_no
 


    
    
    
    
    
    ";

    $juridical__data = $con->prepare($insert_juridical__sql);
    $juridical__data->execute([



        ':entity_no'         => $entity_no






    ]);

    $alert_msg .= ' 
    <div class="new-alert new-alert-success alert-dismissible">
        <i class="icon fa fa-success"></i>
        Data Inserted
    </div>  
      ';
    //   

}
