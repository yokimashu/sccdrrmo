<?php
	include('../config/db_chatconfig.php');	
	
	$user=$_POST['user'];
	$pwd=$_POST['pwd'];
	$chatMType = "";
	$chatMember = "";
	
	$input2 = $user;
	$input3 = $pwd;
	$messageT = "";
	$muteVar = 0;
	date_default_timezone_set('Asia/manila');
	$admremarkdate=date('m/d/Y G:i:s ', strtotime("now"));
	
	$zeroVar = 0;
	$zeroVar2 = "SYSTEM BOT #10";
	
	
	$sqlDV = "SELECT chatMType,chatMember,chatRoomNo FROM tb_chatgroup WHERE chatConNo=:accID";
	$queryDV = $connect -> prepare($sqlDV);
	$queryDV->bindParam(':accID',$input2,PDO::PARAM_STR);
	$queryDV->execute();
	$resultsDV=$queryDV->fetchAll(PDO::FETCH_OBJ);
	
	if($queryDV->rowCount() > 0){
		foreach($resultsDV as $resultDV)
		{
			$chatMType = $resultDV->chatMType;
			$chatMember = $resultDV->chatMember;
			$chatRoomNo = $resultDV->chatRoomNo;
		}
	}
	
	
	if ($chatMType == "USER"){
		$sqlDV = "SELECT fullname FROM tbl_users WHERE entity_no=:accID";
		$queryDV = $connect -> prepare($sqlDV);
		$queryDV->bindParam(':accID',$chatMember,PDO::PARAM_STR);
		$queryDV->execute();
		$resultsDV=$queryDV->fetchAll(PDO::FETCH_OBJ);
		
		if($queryDV->rowCount() > 0){
			foreach($resultsDV as $resultDV)
			{
				$messageT = $resultDV->fullname;
			}
		}
	}
	else{
		$sqlDV = "SELECT fullname FROM tbl_individual WHERE entity_no=:empNo";
		$queryDV = $connect -> prepare($sqlDV);
		$queryDV->bindParam(':empNo',$chatMember,PDO::PARAM_STR);
		$queryDV->execute();
		$resultsDV=$queryDV->fetchAll(PDO::FETCH_OBJ);
		
		if($queryDV->rowCount() > 0){
			foreach($resultsDV as $resultDV)
			{
				$messageT = $resultDV->fullname;
			}
		}
	}
	
	$sqlDV = "SELECT chatMute FROM tb_chatgroup WHERE chatConNo=:sloID";
	$queryDV = $connect -> prepare($sqlDV);
	$queryDV->bindParam(':sloID',$input2,PDO::PARAM_STR);
	$queryDV->execute();
	$resultsDV=$queryDV->fetchAll(PDO::FETCH_OBJ);
	
	if($queryDV->rowCount() > 0){
		foreach($resultsDV as $resultDV)
		{
			$muteVar = $resultDV->chatMute;
		}
	}
	
	$sqlC = "SELECT chatRoomNo FROM tb_gpchat WHERE chatRoomNo=:chatRoomNo";
	$queryC = $connect -> prepare($sqlC);
	$queryC->bindParam(':chatRoomNo',$chatRoomNo,PDO::PARAM_STR);
	$queryC->execute();
	$resultsC=$queryC->fetchAll(PDO::FETCH_OBJ);
	$countC=$queryC->rowCount();
	$countC++;
	if ($muteVar == 0){
		$messageT = $messageT . " has been muted!";
		//EDIT
		$sql5="UPDATE tb_chatgroup SET chatMute=1 WHERE chatConNo=:sloID";
		$query5 = $connect->prepare($sql5);
		$query5->bindParam(':sloID',$input2,PDO::PARAM_STR);
		$query5->execute();
		//EDIT
		$data = 1;
		echo json_encode($data);
	}
	else{
		$messageT = $messageT . " has been unmuted!";
		//EDIT
		$sql5="UPDATE tb_chatgroup SET chatMute=0 WHERE chatConNo=:sloID";
		$query5 = $connect->prepare($sql5);
		$query5->bindParam(':sloID',$input2,PDO::PARAM_STR);
		$query5->execute();
		//EDIT
		$data = 2;
		echo json_encode($data);
	}
	
	$sql4="INSERT INTO tb_gpchat (chatRoomNo,chatCount,chatSenderID,chatSender,chatMessage,chatSendTime) 
	VALUES (:chatRoomNo,:chatCount,:chatSenderID,:chatSender,:chatMessage,:chatSendTime)";
	$query4 = $connect->prepare($sql4);
	$query4->bindParam(':chatRoomNo',$chatRoomNo,PDO::PARAM_STR);
	$query4->bindParam(':chatCount',$countC,PDO::PARAM_STR);
	$query4->bindParam(':chatSenderID',$zeroVar,PDO::PARAM_STR);
	$query4->bindParam(':chatSender',$zeroVar2,PDO::PARAM_STR);
	$query4->bindParam(':chatMessage',$messageT,PDO::PARAM_STR);
	$query4->bindParam(':chatSendTime',$admremarkdate,PDO::PARAM_STR);
	$query4->execute();
	
	$lastInsertId = $connect->lastInsertId();
	
	
	
	
	
?>