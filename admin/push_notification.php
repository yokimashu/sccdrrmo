
<?php
$title = '';

if($state == 'edit' ){
$title = 'Modify User';
}else{
  $title = 'Sign Up';
}

?>

<style>
  .modalsize{
    width:700px;

  }
    .margin{
      margin-right:30px;  
    }
    .margin-small{
        margin-right:5px;
      
    }
    .margin-medium{
        margin-right:20px;
    }
    .margin-bottom{
          margin-bottom:10px;
    }
    
</style>
<div  class="modal fade"   id="<?php echo $state?>">
     <div class="modal-dialog modalsize">
        
             
        <div class="modal-content">
            	 <div class="modal-header card-outline card-primary" >
                    <h4 class="modal-title"><b><?php echo $title;?></b></h4>
               </div>  

                <form class="form-horizontal" id ="userform" method="POST" action= "<?php htmlspecialchars("PHP_SELF"); ?>"  enctype="multipart/form-data">  
                   
               	<div class="modal-body"  >
                    <div class = "container">
                        <div class = "row margin-bottom">
                            
                         <div class = "col-12" style="margin-left:150px;margin-right:100px;">
                          <img src= "userimage/avatar5.png" id="profilepic" style = "width:150px"; class = "img-fluid img-thumbnail" > 
                            
                            
                            </div>
                                     
                        </div>
                        <div class ="row">
                        <div class = "col-12" style="margin-left:180px;margin-right:100px;">
                         <input type="file" name="myFiles" id="fileToUpload" onchange = "loadImage()">

                            
                            </div>
                        </div>
                    <div class = "row">
                      <div class = "col-6">
                    <div class="form-group " >
<!--                        <div class = ".col-lg-6 .col-md-6 .col-sm-6 .col-xs-6" >-->
                    <label for="username" class="col-form-label ">Username </label>
                     
                     <input type="text" name ="username" class="form-control " id="username" required>
                    
                    </div>
                       </div>
                  <?php if($state =='addnew'){// if the state is addnew the password field will show else hidden.
                  echo '<div class ="col-6">';
                  echo  '<div class="form-group">';
//                  echo '<div class = ".col-lg-6 .col-md-6 .col-sm-6 .col-xs-6">';
                  echo '<label for="password" class="col-form-label ">Password </label>';
                  echo  '<input type="password" name ="userpass" class="form-control" id="userpass" required>';
                 
                  echo '</div>' ;
                  echo '</div>';
                  } ?>
                         </div>
                     <div class = "row">
                     <div class = "col-4 ">   
                         
                    <div class="form-group">
                    <label for="firstname" style = "font-size:13px;"class="col-form-label ">First Name</label>
            
                      <input type="text" name ="firstname" class="form-control" id="firstname" required>
                   
                    </div>
                       </div>   
                         
                          <div class = "col-4">   
                         
                    <div class="form-group">
                    <label for="middlename" style = "font-size:13px;"class="col-form-label ">Middle Name</label>
            
                      <input type="text" name ="middlename" class="form-control" id="middlename" required>
                   
                    </div>
                       </div>   
                          <div class = "col-4">   
                         
                    <div class="form-group">
                    <label for="lastname" style = "font-size:13px;"class="col-form-label ">Last Name</label>
            
                      <input type="text" name ="lastname" class="form-control" id="lastname" required>
                   
                    </div>
                       </div>   
                         
                         </div>
                        <div class = "row">
                            <div class = "col-6">
                    <div class="form-group">
                    <label for="gender" class=" col-form-label ">Gender </label>
                      <select name ="gender" class="form-control" id="gender">
                      <option value = "Male">Male </option> 
                      <option value = "Female">Female </option> 
                      </select>  
                    </div>
                         </div>   
                        <div class = "col-6">   
                <div class="form-group" style = "margin-top:5px">
                    <label for="birthdate" class="col-form-label " style = "font-size:13px;">Birth Date</label>
                  
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                      <input type="text" name ="birthdate" class="form-control date" data-provide="datepicker" id="datepicker" required>
                    </div>
                    </div>
                    </div>
                        </div> 
                        
                        <div class = "row">
                       <div class = "col-12">    
                    <div class="input-group margin-bottom">
                    <label for="address" class="col-form-label margin-small">Address:</label>                   
                    <input type="text" name ="address" class="form-control" id="address" required>
                    </div>                    
                    </div>
                            
                   </div> 
                    <div class="row">
                    <div class ="col-12">
                    <div class="input-group margin-bottom">
                    <label for="email" class=" col-form-label margin-medium">Email:</label>             
                    <input type="email"  name ="email" class="form-control" id="email" required>
                    </div>                   
                    </div>
                    </div> 
                        
                    <div class = "row">
                    <div class = "col-12">
                    <div class="input-group margin-bottom">
                    <label for="contactno" class="col-form-label margin-small">Contact No.:</label>                   
                    <input type="number" name ="contactno" class="form-control" id="contactno" required>
                    </div>  
                    </div>
                    </div>
                   <?php if($state == 'edit'){
                    echo '<div class="row">';
                    echo '<div class="col-12">';
                   echo '<div class="input-group">';
                   echo '<label for="usertype" class=" col-form-label margin-small">User Type: </label>';
                   
                   echo  '<select name ="user_type" class="form-control" id="usertype">';
                   echo  '<option value = "Administrator">Administrator </option>' ;
                   echo  '<option value = "User">User </option>' ;
                   echo  '<option value = "Mobile">Mobile </option>';
                   echo  '</select>';
                   echo '</div>';
                    echo '</div>';
                   echo '</div>';
                   echo  '<input type="hidden" id="user_id" readonly class="form-control" name="user_id" >';
                   
                   
                   }?>


                    <div class="modal-footer">
                
                       <button type="submit" class="btn btn-primary btn-sm" name="<?php echo $button ?>"><i class="fa fa-save"></i> Save</button>
                       
                       <button class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>              
                    </div> <!-- modal footer -->
                 </form> 
              </div>
         </div> <!-- modal content -->
    </div> <!-- modal dialog -->
</div> <!-- modal -->