<?php

$alert_msg = '';

// -------------------------------------- PUBLISH POST -------------------------------------------------------------------

if (isset($_POST['submit_publish'])) {
  $id = $_POST['id'];

  $sql = "UPDATE tbl_announcement SET status = 'published' WHERE id = '$id'";
  if ($con->query($sql)) {
    $alert_msg .= ' 
      <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
       <i class="icon fa fa-check Ashake"></i>
       Announcement has been published!
      </div>     
      ';
  }

  if (isset($_POST['notify'])) {

    $get_sql = "SELECT * FROM tbl_announcement WHERE id = '$id'";
    $get_sql_data = $con->prepare($get_sql);
    $get_sql_data->execute();
    while ($result = $get_sql_data->fetch(PDO::FETCH_ASSOC)) {
      $sqltitle    = $result['title'];
      $sqlimage    = $result['image'];
      $sqlauthor    = $result['author'];
      $sqlpostdate    = $result['postdate'];
      $sqlcontent    = $result['content'];
      $sqlimage    = $result['image'];
    }

    $notifTitle = 'Vamos Mobile';

    $token = array();


    $get_token_sql = "SELECT token FROM tbl_entity WHERE token IS NOT NULL";
    $get_token_data = $con->prepare($get_token_sql);
    $get_token_data->execute();
    while ($result = $get_token_data->fetch(PDO::FETCH_ASSOC)) {

      $token[] = $result['token'];
    }
    $regIdChunk=array_chunk($token,1000);

    foreach($regIdChunk as $RegId){

    $url              =   'https://fcm.googleapis.com/fcm/send';
    $serverKey          = 'AAAAaPnV-84:APA91bGk6kvJYwBUsPxjtwSDtewC-pWQsFXJR9Pyf72uVlNHpToe4wZ8-zK4YkkxAJ4U0dcQuVKMgnGPV6-HCIt_vgOKrhpNsdr3u3ecDfe0M3t7fHnXKJ_r8j8AeIB6eAqLjf44fZpE';
    $feedID             = $id;
    $notifImage         = 'https://vamosmobile.app/sccdrrmo/postimage/' . $sqlimage;


    $notification       = array('title' => $notifTitle, 'body' => $sqltitle, 'image' => $notifImage, 'sound' => 'beep.mp3', 'badge' => '1');
    $data               = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $feedID);
    $arrayToSend        = array('registration_ids' => $RegId, 'notification' => $notification, 'data' => $data, 'priority' => 'high');
    $json               = json_encode($arrayToSend);
    $headers            = array();
    $headers[]          = 'Content-Type: application/json';
    $headers[]          = 'Authorization: key=' . $serverKey;
    $ch                 = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //Send the request
    $response = curl_exec($ch);
    echo "<script>console.log(\"$response\")</script>'";
    //Close request
    if ($response === FALSE) {
      die('FCM Send Error: ' . curl_error($ch));
   
      //  die();
    }
    curl_close($ch);
  
  }
}
  
}

//  -------------------------------------- UNPUBLISH POST -------------------------------------------------------------------

if (isset($_POST['submit_unpublish'])) {
  $id = $_POST['id'];

  $sql = "UPDATE tbl_announcement SET status = 'draft' WHERE id = '$id'";
  if ($con->query($sql)) {
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

if (isset($_POST['submit_delete'])) {
  $id = $_POST['id'];
  $image = $_POST['image'];

  if ($image != "sancarlos.png") {
    unlink('../postimage/' . $image); // delete image in the file directory
  }

  $sql = "DELETE FROM tbl_announcement WHERE id = '$id';
              DELETE FROM tbl_comment WHERE post_id = '$id'";
  if ($con->query($sql)) {
    $alert_msg .= ' 
      <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
       <i class="icon fa fa-warning Ashake"></i>
       Announcement has been deleted!
      </div>     
      ';
  }
}
