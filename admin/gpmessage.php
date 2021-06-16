<?php
	include ('../config/db_chatconfig.php');
	
	$totalUnread = 0;
	$tempUnread = 0;
	$unreadcountDV1 = 0;
	
	$sqlDV1 = "SELECT chatRoomNo,chatHis FROM tb_chatgroup WHERE chatMember=:chatMember";
	$queryDV1 = $connect -> prepare($sqlDV1);
	$queryDV1->bindParam(':chatMember',$_SESSION['entityno'],PDO::PARAM_STR);
	$queryDV1->execute();
	$resultsDV1=$queryDV1->fetchAll(PDO::FETCH_OBJ);
	
	if($queryDV1->rowCount() > 0){
		foreach($resultsDV1 as $resultDV1)
		{
			$unreadcountDV1 = 0;
			$unreadcountDV1 = $resultDV1->chatHis;
			
			$sqlDV2 = "SELECT chatCount FROM tb_gpchat WHERE chatRoomNo=:cid ORDER BY chatCount DESC LIMIT 1";
			$queryDV2 = $connect -> prepare($sqlDV2);
			$queryDV2->bindParam(':cid',$resultDV1->chatRoomNo,PDO::PARAM_STR);
			$queryDV2->execute();
			$resultsDV2=$queryDV2->fetchAll(PDO::FETCH_OBJ);
			$unreadcountDV2 = 0;
			if($queryDV2->rowCount() > 0){
				foreach($resultsDV2 as $resultDV2)
				{
					$unreadcountDV2= $resultDV2->chatCount;
				}
			}
			
			$tempUnread = $unreadcountDV2 - $unreadcountDV1;
			
			if ($tempUnread > 0){
				$totalUnread = $totalUnread + $tempUnread;
			}
			
			
			
		}
	}
	
	if ($totalUnread <= 0){
		echo "";
	}
	else{
		echo $totalUnread;
	}
	
	
	
	
	
	
	
	
?>