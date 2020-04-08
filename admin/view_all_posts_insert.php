<?php

$alert_msg = ''; 

  if(isset($_POST['submit_publish'])){
		$id = $_POST['id'];

		$sql = "UPDATE tbl_announcement SET status = 'published' WHERE id = '$id'";
		if($con->query($sql)){
      $alert_msg .= ' 
      <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
       <i class="icon fa fa-check Ashake"></i>
       Announcement has been published!
      </div>     
      ';
		}
  }
  
  if(isset($_POST['submit_unpublish'])){
		$id = $_POST['id'];

		$sql = "UPDATE tbl_announcement SET status = 'draft' WHERE id = '$id'";
		if($con->query($sql)){
      $alert_msg .= ' 
      <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
       <i class="icon fa fa-warning Ashake"></i>
       Announcement has been unpublished!
      </div>     
      ';
		}
  }
  
  if(isset($_POST['submit_delete'])){
      $id = $_POST['id'];
      $image = $_POST['image'];

      unlink('../postimage/'.$image);
      $sql = "DELETE FROM tbl_announcement WHERE id = '$id';
              DELETE FROM tbl_comment WHERE post_id = '$id'";
		if($con->query($sql)){
      $alert_msg .= ' 
      <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
       <i class="icon fa fa-warning Ashake"></i>
       Announcement has been deleted!
      </div>     
      ';
		}
	}



?>