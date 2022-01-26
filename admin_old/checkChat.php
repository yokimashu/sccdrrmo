<?php
	include('../config/db_chatconfig.php');	
	
	$user=$_POST['user'];
	$pwd=$_POST['pwd'];
	$seenb=$_POST['seenb'];
	
	
	$sqlC = "SELECT chatRoomNo FROM tb_gpchat WHERE chatRoomNo=:chatRoomNo";
	$queryC = $connect -> prepare($sqlC);
	$queryC->bindParam(':chatRoomNo',$pwd,PDO::PARAM_STR);
	$queryC->execute();
	$resultsC=$queryC->fetchAll(PDO::FETCH_OBJ);
	$countC=$queryC->rowCount();
	
	
	
	$sql1G = "SELECT chatHis FROM tb_chatgroup WHERE chatRoomNo=:lid AND chatMember=:lid2";
	$query1G = $connect -> prepare($sql1G);
	$query1G->bindParam(':lid',$pwd,PDO::PARAM_STR);
	$query1G->bindParam(':lid2',$_SESSION['entityno'],PDO::PARAM_STR);
	$query1G->execute();
	$results1G=$query1G->fetchAll(PDO::FETCH_OBJ);
	if($query1G->rowCount() > 0){
		foreach($results1G as $result1G)
		{
			$data1 = $result1G->chatHis;
			
		}
	}
	$data1 = $data1 - $countC;
	
	if ($data1 == 0){
		$sql1G = "SELECT chatSeen FROM tb_gpchat WHERE chatRoomNo=:lid AND chatCount=:lid2";
		$query1G = $connect -> prepare($sql1G);
		$query1G->bindParam(':lid',$pwd,PDO::PARAM_STR);
		$query1G->bindParam(':lid2',$countC,PDO::PARAM_STR);
		$query1G->execute();
		$results1G=$query1G->fetchAll(PDO::FETCH_OBJ);
		if($query1G->rowCount() > 0){
			foreach($results1G as $result1G)
			{
				if ($seenb != $result1G->chatSeen){
					$data1 = 1;
				}
			}
		}
	}
	
	$data = $data1;
	echo json_encode($data);
	
	
?>