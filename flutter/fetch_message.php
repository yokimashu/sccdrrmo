<?php

include "dbconfig.php";

$entity_no = $_POST["entityID"];


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

    //retrieve messages
    $sql_data = "SELECT * FROM tb_gpchat WHERE chatRoomNo = :chatRoomNo";
    $get_sql_data = $con->prepare($sql_data);
    $get_sql_data->execute([':chatRoomNo' => $chatRoomNo]);
    $results = $get_sql_data->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($results);
} else {

    echo json_encode('No Record');
}
