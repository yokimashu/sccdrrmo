<?php

?>

<style>
    .size{
      width:100%;
    }

</style>
<div class="modal fade" id="addnew" role="dialog">
     <div class="modal-dialog">
         
        <div class="modal-content">
            	<div class="modal-header" >
               
                    <h4 class="modal-title"><b>Sign up</b></h4>
                    
          	</div>
               	<div class="modal-body" style =align:center; width:80%;>
                    
                    	<form class="form-horizontal" method="POST" action="<?php htmlspecialchars("PHP_SELF");?>" enctype="multipart/form-data">
                           
                  <div class="input-group mb-3 size">
            <div class="input-group-prepend">
                    <span class="input-group-text" >Username:</span>
                        </div>
                <input type="text" class="form-control" id = "username" name ="username" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            
                            
                            
                       <div class="input-group mb-3 size">
            <div class="input-group-prepend">
                    <span class="input-group-text" >Password:</span>
                        </div>
                <input type="text" class="form-control"  id = "password" name ="password" aria-label="Password" aria-describedby="basic-addon1">
                                </div>
                            
                            
                            
                            
                       <div class="input-group mb-3 size">
            <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">First Name:</span>
                        </div>
                <input type="text" class="form-control" id = "fname"  name = "fname" aria-label="First Name" aria-describedby="basic-addon1">
                        </div>    
                     
                            
                            
                                    
                     <div class="input-group mb-3 size">
            <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Middle Name:</span>
                        </div>
                <input type="text" class="form-control" id = "mname"  name = "mname"aria-label= "Last Name" aria-describedby="basic-addon1">
                                </div>
                            
                            
                     <div class="input-group mb-3 size">
            <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Last Name:</span>
                        </div>
                <input type="text" class="form-control"  id = "lname"  name = "lname"aria-label="Last Name" aria-describedby="basic-addon1">
                                </div>
                            
                            
                   <div class="input-group mb-3 size">
            <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Address:</span>
                        </div>
                <input type="text" class="form-control"  id = "address" name = "address" aria-label="Address" aria-describedby="basic-addon1">
                                </div>
                            
                  <div class="input-group mb-3 size">
            <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Contact Number:</span>
                        </div>
                <input type="text" class="form-control"  id = "cnumber" name = "cnumber" aria-label="Contact Number " aria-describedby="basic-addon1">
                                </div>
                            
                
                            
                          
              
                <button type="submit" id = "save" class="btn btn-primary btn-flat" name="add"> Register</button>         
                          
                                   
                        </div>
                    </form>
                            
                    
                    
                    
         </div>
               
         </div>
         
         
    </div>
    
</div>