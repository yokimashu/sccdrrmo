<div  class="modal fade"   id="addnew">
     <div class="modal-dialog">
         
        <div style ="width:500px;" class="modal-content">
            	 <div class="modal-header card-outline card-primary" >
                    <h4 class="modal-title"><b>Sign up</b></h4>
               </div>  

                <form class="form-horizontal" method="POST" action= "insert_user.php"  enctype="multipart/form-data">
               	<div class="modal-body" style =align:center; width:80%;>
                    
                    <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label ">Username </label>
                    <div class="col-sm-10">
                      <input type="text" name ="username" class="form-control" id="username" required>
                    </div>  
                    </div>

                    <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label ">Password </label>
                    <div class="col-sm-10">
                      <input type="password" name ="userpass" class="form-control" id="userpass" required>
                    </div>  
                    </div>

                    <div class="form-group row">
                    <label for="fullname" style = "font-size:13px;"class="col-md-2 col-form-label ">Full Name</label>
                    <div class="col-sm-10">
                      <input type="text" name ="fullname" class="form-control" id="fullname1" required>
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

                    <div class="form-group row ">
                    <label for="birthdate" class="col-md-2 col-form-label " style = "font-size:13px;">Birth Date</label>
                    <div class="col-sm-10">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                      <input type="text" name ="birthdate" class="form-control date" data-provide="datepicker" id="datepicker" required>
                    </div>
                    </div>  
                    </div>
                    
                    <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label ">Email</label>
                    <div class="col-sm-10">
                      <input type="email" name ="email" class="form-control" id="email" required>
                    </div>  
                    </div>

                    <div class="form-group row">
                    <label for="contactno" class="col-md-2 col-form-label ">Contact No.</label>
                    <div class="col-sm-10">
                      <input type="number" name ="contactno" class="form-control" id="contactno" required>
                    </div>  
                    </div>

                    </div> <!-- modal body -->
                     
                    <div class="modal-footer">
                       <button type="submit" class="btn btn-primary btn-sm" name="add"><i class="fa fa-save"></i> Save</button>
                       <button class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>              
                    </div> <!-- modal footer -->
                 </form>      
         </div> <!-- modal content -->
    </div> <!-- modal dialog -->
</div> <!-- modal -->