

 <div  class="modal fade"   id="push_notify">
   <div class="small-box modal-dialog">
   <div class="modal-content bg-info">

     
       
         <form class="form-horizontal" id ="userform" method="POST" action= "<?php htmlspecialchars("PHP_SELF");?>"  enctype="multipart/form-data">  
         <div class = "modal-body">
           <div class = "container">
             

             <div class="inner">
              
               <h3>SEND MOBILE ALERT</h3>

               <div class="form-group">
                 <p for="title" class="col-form-label ">Title</p>
                 <input type="text" name ="title" class="form-control" id="title" value="SCCDRRMO" required>
               </div>

               <div class="form-group">
                 <p for="message" class="col-form-label ">Message</p>
                 <input type="text" name ="message" class="form-control" id="message" required>
               </div>
        
             </div> <!-- inner -->
             <div class="icon">
               <i class="fa fa-mobile"></i>
             </div>
             </div> <!-- modal body -->
             <div class="modal-footer">
               <button type="submit" class="btn btn-dark btn-sm"  name="send"><i class="fa fa-bell"></i>  Send</button>
               <button class="btn btn-dark btn-sm pull-left" data-dismiss="modal"><i class="fa fa-close"></i>  Close</button>              
             </div> <!-- modal footer -->
           </div> <!-- container -->
         </form> 
       
     </div> <!-- modal content -->
   </div> <!-- modal dialog -->
</div> <!-- modal -->