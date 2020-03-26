<?php
include ('admin/insert_user.php');
?>



</style>
<div  class="modal fade"   id="addnew" role="dialog">
     <div class="modal-dialog">
         
        <div style ="width:500px;" class="modal-content">
            	<div class="modal-header" >
               
                    <h4 class="modal-title"><b>Sign up</b></h4>
                    
          	</div>
               	<div class="modal-body" style =align:center; width:80%;>
                    
                    	<form class="form-horizontal" method="POST" action="<?php htmlspecialchars("PHP_SELF");?>" enctype="multipart/form-data">
                            <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label ">Username </label>
                    <div class="col-sm-10">
                      <input type="text" name ="username" class="form-control" id="username">
                    </div>  
            
                    </div>
                    <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label ">Password </label>
                    <div class="col-sm-10">
                      <input type="text" name ="password" class="form-control" id="password">
                    </div>  
            
                    </div>
                    <div class="form-group row">
                    <label for="fullname" style = "font-size:13px;"class="col-md-2 col-form-label ">Full Name</label>
                    <div class="col-sm-10">
                      <input type="text" name ="fullname" class="form-control" id="fullname">
                    </div>  
            
                    </div>
                    <div class="form-group row">
                    <label for="gender" class="col-sm-2 col-form-label ">Gender </label>
                    <div class="col-sm-6">
                      <select name ="gender" class="form-control" id="gender">
                      <option value = "Male">Male </option> 
                      <option value = "Female">Female </option> 
                      </select>
                    </div>  
            
                    </div>
                    <div class="form-group row " >
                    <label for="birthdate" class="col-md-2 col-form-label " style = "font-size:13px;">Birth Date</label>
                    <div class="col-sm-6">
                      <input type="text" name ="bday" class="form-control date" data-provide="datepicker" id="datepicker">
                    </div>  
            
                    </div>
                    
                    <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label ">Email</label>
                    <div class="col-sm-10">
                      <input type="text" name ="email" class="form-control" id="email">
                    </div>  
            
                    </div>

                    <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label ">Contact No.</label>
                    <div class="col-sm-10">
                      <input type="text" name ="contactno" class="form-control" id="contactno">
                    </div>  
            
                    </div>
                <button id = "save"   class="btn btn-primary btn-flat" name="add"> Submit</button>         
                <button id = "close"   class="btn btn-primary btn-flat" name="close"> Close</button>          
                                   
                        </div>
                    </form>
                            
                    
                    
                    
        
               
         </div>
         
         
    </div>
    
</div>