<?php 
$entity = '';
$photo = '';
$fullname = '';
$message = '';
$date = '';
$time = '';
$unread_messages= '';
$unread_message_query = "SELECT COUNT(sender)AS countsender,notif_objid ,sender,photo, fullname,m.message, m.date, m.time  from 
tbl_individual i inner join tbl_message m on i.entity_no = m.sender inner join tbl_notification n on
m.notif_objid = n.objid where n.status = 'UNREAD'  ";

$pre_message = $con->prepare($unread_message_query);
$pre_message->execute();


$no_unread= "SELECT COUNT(status) as stat from tbl_notification WHERE status = 'UNREAD'";
$pre_unread = $con->prepare($no_unread);
$pre_unread->execute();
 while($result = $pre_unread->fetch(PDO::FETCH_ASSOC)){
    $unread_messages= $result['stat'];
 }
?>
