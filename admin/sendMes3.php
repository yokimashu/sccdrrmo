<?php
include('../config/db_chatconfig.php');

$user = $_POST['user'];
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
$muteVar = 0;
$matchFoundAJ = 0;

$input1 = $_SESSION['flname'];
$input2 = $user;

$input2 = str_replace("[[", "", $input2);
$input2 = str_replace("]]", "", $input2);

date_default_timezone_set('Asia/manila');
$admremarkdate = date('m/d/Y G:i:s ', strtotime("now"));


$sqlAJ = "SELECT chatMute FROM tb_chatgroup WHERE chatRoomNo=:chatRoomNo AND chatMember=:chatMember";
$queryAJ = $connect->prepare($sqlAJ);
$queryAJ->bindParam(':chatRoomNo', $pwd2, PDO::PARAM_STR);
$queryAJ->bindParam(':chatMember', $_SESSION['entityno'], PDO::PARAM_STR);
$queryAJ->execute();
$resultsAJ = $queryAJ->fetchAll(PDO::FETCH_OBJ);

if ($queryAJ->rowCount() > 0) {
	foreach ($resultsAJ as $resultAJ) {
		$matchFoundAJ = 1;
	}
}

if ($matchFoundAJ == 1) {
	$sqlDV = "SELECT chatMute FROM tb_chatgroup WHERE chatRoomNo=:chatRoomNo AND chatMember=:chatMember";
	$queryDV = $connect->prepare($sqlDV);
	$queryDV->bindParam(':chatRoomNo', $pwd2, PDO::PARAM_STR);
	$queryDV->bindParam(':chatMember', $_SESSION['entityno'], PDO::PARAM_STR);
	$queryDV->execute();
	$resultsDV = $queryDV->fetchAll(PDO::FETCH_OBJ);

	if ($queryDV->rowCount() > 0) {
		foreach ($resultsDV as $resultDV) {
			$muteVar = $resultDV->chatMute;
		}
	}

	if ($muteVar == 0) {
		if (substr_count($input2, '@') > 0) {
			//$input2 = str_replace("@","<b style='color:red;'>@</b>", $input2);
			//$input2 = "<b style='color:red;'>" . $input2 . "</b>";

			$INParray =  explode(' ', $input2);
			$cnt_array = count($INParray) - 1;

			for ($x = 0; $x <= $cnt_array; $x++) {
				if (substr_count($INParray[$x], '@') > 0) {
					$INParray[$x] = "<b style='color:red;'>" . $INParray[$x] . "</b>";
				}
			}
			$input2 = join(" ", $INParray);
		}

		if (substr_count($input2, '\u') > 0) {
			//$input2 = str_replace("@","<b style='color:red;'>@</b>", $input2);
			//$input2 = "<b style='color:red;'>" . $input2 . "</b>";

			$INParray =  explode(' ', $input2);
			$cnt_array = count($INParray) - 1;

			for ($x = 0; $x <= $cnt_array; $x++) {
				if (substr_count($INParray[$x], '\u') > 0) {
					$INParray[$x] = "<span style='font-size:25px;'>" . $INParray[$x] . "</span>";
				}
			}
			$input2 = join(" ", $INParray);
		}

		$sqlC = "SELECT chatRoomNo FROM tb_gpchat WHERE chatRoomNo=:chatRoomNo";
		$queryC = $connect->prepare($sqlC);
		$queryC->bindParam(':chatRoomNo', $pwd2, PDO::PARAM_STR);
		$queryC->execute();
		$resultsC = $queryC->fetchAll(PDO::FETCH_OBJ);
		$countC = $queryC->rowCount();
		$countC++;


		date_default_timezone_set('Asia/manila');
		$date = date('Y-m-d', strtotime("now"));
		$time = date('G:i:s', strtotime("now"));

		$sql4 = "INSERT INTO tb_gpchat (chatRoomNo,chatCount,chatSenderID,chatSender,chatMessage,chatSendTime,chatSeen) 
			VALUES (:chatRoomNo,:chatCount,:chatSenderID,:chatSender,:chatMessage,:chatSendTime,'Seen By')";
		$query4 = $connect->prepare($sql4);
		$query4->bindParam(':chatRoomNo', $pwd2, PDO::PARAM_STR);
		$query4->bindParam(':chatCount', $countC, PDO::PARAM_STR);
		$query4->bindParam(':chatSenderID', $_SESSION['entityno'], PDO::PARAM_STR);
		$query4->bindParam(':chatSender', $input1, PDO::PARAM_STR);
		$query4->bindParam(':chatMessage', $input2, PDO::PARAM_STR);
		$query4->bindParam(':chatSendTime', $admremarkdate, PDO::PARAM_STR);
		$query4->execute();




		$lastInsertId = $connect->lastInsertId();
		$data = 2;
		echo json_encode($data);

	// 	$insert_send_sql = "INSERT INTO tbl_message SET 
	
	// 	notif_objid           = :notif_objid,
	// 	sender           	  = :sender,
	// 	date           		  = :date,
	// 	time           		  = :time,
	// 	message               = :message";

	// $notif_data = $connect->prepare($insert_send_sql);
	// $notif_data->execute([

	// 	':notif_objid'    	  => $pwd2,
	// 	':sender'             => $input1,
	// 	':date'               => $date,
	// 	':time'               => $time,
	// 	':message'            => $input2

	// ]);
	
	} else {
		$data = 1;
		echo json_encode($data);
	}
} else {
	$data = 3;
	echo json_encode($data);
}
