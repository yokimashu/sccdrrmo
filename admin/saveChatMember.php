<?php
	include('../config/db_chatconfig.php');	
	
	$user=$_POST['user'];
	$pwd=$_POST['pwd'];
	$pwd1=$_POST['pwd1'];
	$zeroVar = 0;
	$zeroVar2 = "SYSTEM BOT #10";
	$matchFound = 0;
	$existEnt = 0;
	$sql1 = "SELECT chatRoomNo FROM tb_chatgroup WHERE chatRoomNo=:lid AND chatMember=:lid2";
	$query1 = $connect -> prepare($sql1);
	$query1->bindParam(':lid',$user,PDO::PARAM_STR);
	$query1->bindParam(':lid2',$pwd,PDO::PARAM_STR);
	$query1->execute();
	$results1=$query1->fetchAll(PDO::FETCH_OBJ);
	if($query1->rowCount() > 0){
		$matchFound = 1;
	}
	
	if ($matchFound == 0){
		
		
		
		if ($pwd1 == "USER"){
			$sql1 = "SELECT entity_no FROM tbl_users WHERE entity_no=:accID";
		}
		else{
			$sql1 = "SELECT entity_no FROM tbl_individual WHERE entity_no=:accID";
		}
		
		$query1 = $connect -> prepare($sql1);
		$query1->bindParam(':accID',$pwd,PDO::PARAM_STR);
		$query1->execute();
		$results1=$query1->fetchAll(PDO::FETCH_OBJ);
		if($query1->rowCount() > 0){
			$existEnt = 1;
		}
		
		if ($existEnt == 1){
			$data =  1;
			
			date_default_timezone_set('Asia/manila');
			$admremarkdate=date('m/d/Y H:i A ', strtotime("now"));
			$adm2=date('m/d/Y G:i:s ', strtotime("now"));
			
			$sqlC = "SELECT chatRoomNo FROM tb_gpchat WHERE chatRoomNo=:chatRoomNo";
			$queryC = $connect -> prepare($sqlC);
			$queryC->bindParam(':chatRoomNo',$user,PDO::PARAM_STR);
			$queryC->execute();
			$resultsC=$queryC->fetchAll(PDO::FETCH_OBJ);
			$countC=$queryC->rowCount();
			
			$sql="INSERT INTO tb_chatgroup (chatRoomNo,chatMember,chatMType,chatPower,chatMute,chatInv,chatInvDate,chatHis)
			VALUES (:chatRoomNo,:chatMember,:chatMType,:chatPower,:chatMute,:chatInv,:chatInvDate,:chatHis)";
			$query = $connect->prepare($sql);
			$query->bindParam(':chatRoomNo',$user,PDO::PARAM_STR);
			$query->bindParam(':chatMember',$pwd,PDO::PARAM_STR);
			$query->bindParam(':chatMType',$pwd1,PDO::PARAM_STR);
			$query->bindParam(':chatPower',$zeroVar,PDO::PARAM_STR);
			$query->bindParam(':chatMute',$zeroVar,PDO::PARAM_STR);
			$query->bindParam(':chatInv',$_SESSION['entityno'],PDO::PARAM_STR);
			$query->bindParam(':chatInvDate',$admremarkdate,PDO::PARAM_STR);
			$query->bindParam(':chatHis',$countC,PDO::PARAM_STR);
			$query->execute();
			
			$lastInsertId = $connect->lastInsertId();
			
			if($lastInsertId)
			{
				
			}
			
			$countC++;
			
			
			if ($pwd1 == "USER"){
				$sqlDV = "SELECT fullname FROM tbl_users WHERE entity_no=:accID";
				$queryDV = $connect -> prepare($sqlDV);
				$queryDV->bindParam(':accID',$pwd,PDO::PARAM_STR);
				$queryDV->execute();
				$resultsDV=$queryDV->fetchAll(PDO::FETCH_OBJ);
				
				if($queryDV->rowCount() > 0){
					foreach($resultsDV as $resultDV)
					{
						$input2 = $resultDV->fullname;
					}
				}
			}
			else{
				$sqlDV = "SELECT fullname FROM tbl_individual WHERE entity_no=:accID";
				$queryDV = $connect -> prepare($sqlDV);
				$queryDV->bindParam(':accID',$pwd,PDO::PARAM_STR);
				$queryDV->execute();
				$resultsDV=$queryDV->fetchAll(PDO::FETCH_OBJ);
				
				if($queryDV->rowCount() > 0){
					foreach($resultsDV as $resultDV)
					{
						$input2 = $resultDV->fullname;
					}
				}
			}
			
			$input2 = $input2 . " has been added to the chat!";
			$sql4="INSERT INTO tb_gpchat (chatRoomNo,chatCount,chatSenderID,chatSender,chatMessage,chatSendTime) 
			VALUES (:chatRoomNo,:chatCount,:chatSenderID,:chatSender,:chatMessage,:chatSendTime)";
			$query4 = $connect->prepare($sql4);
			$query4->bindParam(':chatRoomNo',$user,PDO::PARAM_STR);
			$query4->bindParam(':chatCount',$countC,PDO::PARAM_STR);
			$query4->bindParam(':chatSenderID',$zeroVar,PDO::PARAM_STR);
			$query4->bindParam(':chatSender',$zeroVar2,PDO::PARAM_STR);
			$query4->bindParam(':chatMessage',$input2,PDO::PARAM_STR);
			$query4->bindParam(':chatSendTime',$adm2,PDO::PARAM_STR);
			$query4->execute();
			
			$lastInsertId = $connect->lastInsertId();
		}
		else{
			$data =  3;
		}
		
		
		
	}
	else{
		$data =  2;
	}
	echo json_encode($data);
	
	
?>
