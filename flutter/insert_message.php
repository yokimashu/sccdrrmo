<?php

include "dbconfig.php";

$message = $_POST["message"];
$entity_no = $_POST["entity_no"];


date_default_timezone_set('Asia/manila');
$admremarkdate2 = date('m/d/Y H:i A ', strtotime("now"));
$admremarkdate = date('m/d/Y G:i:s ', strtotime("now"));

$chatCrtType = 'Mobile';

$chatMType1 = 'INDIV';
$chatMType2 = 'USER';

$chatPower1 = 1;
$chatPower0 = 0;
$chatMute = 0;
$chatHistory = 0;

$chatCount = 1;


// sir mikoy ID
$adminID = 'HZJJPZ1670';




// get name

$sql_name = "SELECT * FROM tbl_individual where entity_no = :entity_no";
$sql_name_data = $con->prepare($sql_name);
$sql_name_data->execute([':entity_no' => $entity_no]);
while ($result = $sql_name_data->fetch(PDO::FETCH_ASSOC)) {
    $fullname = $result['fullname'];
    $firstname = $result['firstname'];
}

$chatName = $fullname . ' - Chat Support';




// check if chat room is already existed for the entity no

$sql_chatroom = "SELECT * FROM tb_chatroom WHERE chatCreator = :entity_no";
$sql_chatroom_data = $con->prepare($sql_chatroom);
$sql_chatroom_data->execute([':entity_no' => $entity_no]);

if ($sql_chatroom_data->rowCount() > 0) {


    //chat room existed

    // get chat room objid
    while ($result = $sql_chatroom_data->fetch(PDO::FETCH_ASSOC)) {
        $chatRoomNo = $result['chatRoomNo'];
    }

    // get chat count
    $chatCountCurrentRoom = "SELECT chatRoomNo FROM tb_gpchat WHERE chatRoomNo=:chatRoomNo";
    $chatCountCurrentRoom_data = $con->prepare($chatCountCurrentRoom);
    $chatCountCurrentRoom_data->execute([':chatRoomNo' => $chatRoomNo]);
    $countC = $chatCountCurrentRoom_data->rowCount();
    $countC++;


    // insert message ------------------------------- //

    $sqlc1 = "INSERT INTO tb_gpchat SET

            chatRoomNo          = :chatRoomNo,
            chatCount           = :chatCount,
            chatSenderID        = :chatSenderID,
            chatSender          = :chatSender,
            chatMessage         = :chatMessage,    
            chatSendTime        = :chatSendTime

            ";

    $sqlc1_data = $con->prepare($sqlc1);
    $sqlc1_data->execute([

        ':chatRoomNo'       => $chatRoomNo,
        ':chatCount'        => $countC,
        ':chatSenderID'     => $entity_no,
        ':chatSender'       => $fullname,
        ':chatMessage'      => $message,
        ':chatSendTime'     => $admremarkdate
    ]);

    //

} else {



    // no chat room found
    // create chat room


    $botID = 0;
    $botName = "SYSTEM BOT #10";
    $botMessage = "Hi " . $firstname . "!
\n
Thanks for contacting Vamos Chat Support!
\n
This is just a quick note to let you know we've received your message, and will respond as soon as we can.
\n
-Vamos Team";


    $sql = "INSERT INTO tb_chatroom SET
        chatName        =   :chatName,
        chatCreatedOn   =   :chatCreatedOn,
        chatCreator     =   :Creator,
        chatCrtType     =   :ChartType
        ";

    $sql_data = $con->prepare($sql);
    $sql_data->execute([

        ':chatName'         => $chatName,
        ':chatCreatedOn'    => $admremarkdate2,
        ':Creator'          => $entity_no,
        ':ChartType'        => $chatCrtType,

    ]);


    // get chatroom objid

    $lastInsertId = $con->lastInsertId();

    // insert message ------------------------------- //

    $sql2 = "INSERT INTO tb_gpchat SET
        chatRoomNo          = :chatRoomNo,
        chatCount           = :chatCount,
        chatSenderID        = :chatSenderID,
        chatSender          = :chatSender,
        chatMessage         = :chatMessage,    
        chatSendTime        = :chatSendTime
        ";

    $sql_data2 = $con->prepare($sql2);
    $sql_data2->execute([

        ':chatRoomNo'       => $lastInsertId,
        ':chatCount'        => $chatCount,
        ':chatSenderID'     => $entity_no,
        ':chatSender'       => $fullname,
        ':chatMessage'      => $message,
        ':chatSendTime'     => $admremarkdate
    ]);


    // // create first bot message -------------------- //

    $sql3 = "INSERT INTO tb_gpchat SET
        chatRoomNo          = :chatRoomNo,
        chatCount           = :chatCount,
        chatSenderID        = :chatSenderID,
        chatSender          = :chatSender,
        chatMessage         = :chatMessage,    
        chatSendTime        = :chatSendTime
        ";

    $sql_data3 = $con->prepare($sql3);
    $sql_data3->execute([

        ':chatRoomNo'       => $lastInsertId,
        ':chatCount'        => $chatCount + 1,
        ':chatSenderID'     => $botID,
        ':chatSender'       => $botName,
        ':chatMessage'      => $botMessage,
        ':chatSendTime'     => $admremarkdate
    ]);



    // add user to group chat ------------------ //

    $sql4 = "INSERT INTO tb_chatgroup SET
        chatRoomNo          = :chatRoomNo,
        chatMember          = :chatMember,
        chatMType           = :chatMType,
        chatPower           = :chatPower, 
        chatMute            = :chatMute,
        chatInv             = :chatInv,
        chatInvDate         = :chatInvDate,
        chatHis             = :chatHis
        ";

    $sql_data4 = $con->prepare($sql4);
    $sql_data4->execute([
        ':chatRoomNo'       => $lastInsertId,
        ':chatMember'       => $entity_no,
        ':chatMType'        => $chatMType1,
        ':chatPower'        => $chatPower1,
        ':chatMute'         => $chatMute,
        ':chatInv'          => $entity_no,
        ':chatInvDate'      => $admremarkdate2,
        ':chatHis'          => $chatHistory

    ]);



    // add admin to group chat ------------------ //

    $sql5 = "INSERT INTO tb_chatgroup SET
        chatRoomNo          = :chatRoomNo,
        chatMember          = :chatMember,
        chatMType           = :chatMType,
        chatPower           = :chatPower, 
        chatMute            = :chatMute,
        chatInv             = :chatInv,
        chatInvDate         = :chatInvDate,
        chatHis             = :chatHis
        ";

    $sql_data5 = $con->prepare($sql5);
    $sql_data5->execute([
        ':chatRoomNo'       => $lastInsertId,
        ':chatMember'       => $adminID,
        ':chatMType'        => $chatMType2,
        ':chatPower'        => $chatPower0,
        ':chatMute'         => $chatMute,
        ':chatInv'          => $entity_no,
        ':chatInvDate'      => $admremarkdate2,
        ':chatHis'          => $chatHistory

    ]);


    //     //

}


echo json_encode('Success');
