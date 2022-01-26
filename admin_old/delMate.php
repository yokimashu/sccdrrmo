<?php
	include('../config/db_chatconfig.php');	
	
	$user=$_POST['user'];
	$pwd=$_POST['pwd'];
	$chatMType = "";
	$chatMember = "";
	
	$input2 = $user;
	$input3 = $pwd;
	$messageT = "";
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
	
	$sqlC = "SELECT chatRoomNo FROM tb_gpchat WHERE chatRoomNo=:chatRoomNo";
	$queryC = $connect -> prepare($sqlC);
	$queryC->bindParam(':chatRoomNo',$chatRoomNo,PDO::PARAM_STR);
	$queryC->execute();
	$resultsC=$queryC->fetchAll(PDO::FETCH_OBJ);
	$countC=$queryC->rowCount();
	$countC++;
	$messageT = $messageT . " has been removed from the chat!";
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
	
	$sqlAA = "DELETE FROM tb_chatgroup WHERE chatConNo=:sloID";
	$queryAA = $connect -> prepare($sqlAA);
	$queryAA->bindParam(':sloID',$input2,PDO::PARAM_STR);
	$queryAA->execute();
	
?>