<?php
$bk_center = "SELECT bc_code,bc_name from tbl_bakuna_center";
$bk_stmt = $con->prepare($bk_center);
$bk_stmt->execute();


if(isset($_POST['selectcenter'])){
  $user = $_SESSION['entityno'];
  $cbcr = $_POST['bakuna'];
$update_center= "UPDATE tbl_users SET cbcr = :cbcr WHERE entity_no = :entityno";
$exec_center = $con->prepare($update_center);
$exec_center->execute([':cbcr'  =>  $cbcr,
                        ':entityno'=>$user]);
$_SESSION['selectcenter'] = 'Yes';
}
?>
<?php if($_SESSION['selectcenter'] == "No"){?>
<div class="modal fade" id="myModal" role="dialog">
<form role="form" enctype="multipart/form-data" method="post" id="input-form" action="<?php htmlspecialchars("PHP_SELF"); ?>">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Select Bakuna Center</h4>
        </div>
        <div class="modal-body">
        <select class="form-control select2" id="bakuna" style="width: 100%;margin-bottom:50px;" name="bakuna" value="<?php echo $barangay; ?>" required>
         <option selected="selected">Select Bakuna Center</option>
         <?php while ($get_center = $bk_stmt->fetch(PDO::FETCH_ASSOC)) { ?>
          <option value="<?php echo $get_center['bc_code']; ?>"><?php echo $get_center['bc_name']; ?></option>
           <?php } ?>
        </div>
        <div class="modal-footer">
        <input type="submit" id="approve" name="selectcenter" class="btn btn-warning" value="SELECT">
        </div>
      </div>
      
    </div>  
         </form>
</div>
<?php } ?>
     


     
     
