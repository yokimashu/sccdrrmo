
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
<div  class="modal fade"   id="push_notify">
     <div class="modal-dialog modalsize">
        
             
        <div class="modal-content">
            	 <div class="modal-header card-outline card-primary" >
                    <h4 class="modal-title"><b><?php echo $title;?></b></h4>
               </div>  

                <form class="form-horizontal" id ="userform" method="POST" action= "<?php htmlspecialchars("PHP_SELF");?>"  enctype="multipart/form-data">  
                   
               	<div class="modal-body"  >
                    <div class = "container">
                        <div class = "row margin-bottom">
                            
                   <!-- <div class = "row">
                     <div class = "col-4 ">   
                          -->
                    <div class="form-group">
                    <label for="title" style = "font-size:13px;"class="col-form-label ">Title</label>
            
                      <input type="text" name ="title" class="form-control" id="title" value="SCCDRRMO" required>
                   
                    </div>
                       </div>   
                         
                          <div class = "col-4">   
                         
                    <div class="form-group">
                    <label for="message" style = "font-size:13px;"class="col-form-label ">Message</label>
            
                      <input type="text" name ="message" class="form-control" id="message" required>
                   
                    </div>
                       </div>   
                          <div class = "col-4">  


                    <div class="modal-footer">
                
                       <button type="submit" class="btn btn-primary btn-sm"  name="send"><i class="fa fa-save"></i> Save</button>
                       
                       <button class="btn btn-default btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>              
                    </div> <!-- modal footer -->
                 </form> 
              </div>
         </div> <!-- modal content -->
    </div> <!-- modal dialog -->
</div> <!-- modal -->