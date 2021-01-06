<?php
include('../config/db_config.php');
$alert_msg = '';
if(isset($_POST['approve'])){
    $entity_no = $_POST['entityno'];
   
$sql = "UPDATE tbl_verification set status = 'VERIFIED' ,remarks  =  'Your account is already verified' where entity_no = :entity";
$exe_sql = $con->prepare($sql);
$exe_sql->execute([':entity' => $entity_no]);


$sql = "UPDATE tbl_entity set status = 'VERIFIED' where entity_no = :entity";
$exe_sql = $con->prepare($sql);
$exe_sql->execute([':entity' => $entity_no]);


$alert_msg .= ' 
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-check"></i>
        <strong> Success ! </strong> User has been Verified!
</div>    
';
}
if(isset($_POST['deny'])){
    // $remarks = $_POST['remarks'];
$entity_no = $_POST['entityno'];
 $sql = "UPDATE tbl_verification set  remarks = 'Your account was disapproved, kindly check and upload necesarry requirements! ', status = 'DENIED' where entity_no = :entity";
$exe_sql = $con->prepare($sql);
$exe_sql->execute([':entity' => $entity_no ]);

                $alert_msg .= ' 
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                The application has been denied.
        </div>    
      ';

}

?>