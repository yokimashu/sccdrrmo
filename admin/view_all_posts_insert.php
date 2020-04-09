<?php

$alert_msg = ''; 

// -------------------------------------- PUBLISH POST -------------------------------------------------------------------

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
      
      $token = array();

      $get_token_sql = "SELECT token FROM tbl_users";
      $get_token_data = $con->prepare($get_token_sql);
      $get_token_data->execute();
      while ($result = $get_token_data->fetch(PDO::FETCH_ASSOC)) {
       
          $token[]=$result['token'];
      }
      
          $url = "https://fcm.googleapis.com/fcm/send";
          //$token              = "your device token";
          $serverKey          = 'AAAAPN2sEA0:APA91bFJNXG0TYDBo51vJbCJh2bMEL_uO3KJ5qGhzkW9V1w32wEz5HgQLRBmP2nJwAz1-_rS3g4xdQQKRWHNmF00fqShvDNRwEnNP5GTMLAkY23ABb6uGdPjtm2P5Yqjrc_4bObc_J7G';
          $message            = $_POST['title'];
          $title              = 'SCCDRRMO ANNOUNCEMENT';
          $notification       = array('title' =>$title , 'body' => $message, 'sound' => 'default', 'badge' => '1');
          $arrayToSend        = array('registration_ids' => $token, 'notification' => $notification,'priority'=>'high');
          $json               = json_encode($arrayToSend);
          $headers            = array();
          $headers[]          = 'Content-Type: application/json';
          $headers[]          = 'Authorization: key='. $serverKey;
          $ch                 = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
          curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
          curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
          //Send the request
          $response = curl_exec($ch);
          //Close request
          if ($response === FALSE) {
          //die('FCM Send Error: ' . curl_error($ch));
          die();
          }
          curl_close($ch);




  }

//  -------------------------------------- UNPUBLISH POST -------------------------------------------------------------------
  
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

// -------------------------------------- DELETE POST -------------------------------------------------------------------
  
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