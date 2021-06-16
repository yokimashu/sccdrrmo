<?php 
	include('../config/db_chatconfig.php');
	
	$sql = "SELECT * FROM tb_chatroom 
	INNER JOIN tb_chatgroup ON tb_chatroom.chatRoomNo = tb_chatgroup.chatRoomNo 
	INNER JOIN tb_gpchat ON tb_chatroom.chatRoomNo = tb_gpchat.chatRoomNo 
	AND tb_gpchat.chatGPNo = (SELECT chatGPNo FROM tb_gpchat WHERE tb_gpchat.chatRoomNo = tb_chatroom.chatRoomNo ORDER BY chatCount DESC LIMIT 1)
	WHERE chatMember = :chatMember 
	ORDER BY chatGPNo DESC";
	$query = $connect -> prepare($sql);
	$query->bindParam(':chatMember',$_SESSION['entityno'],PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	$cnt=1;
	
	if($query->rowCount() > 0)
	{
		foreach($results as $result)
		{        
			
		?>  
		<tr>
			<td style="font-size:11px;"><b><?php echo htmlentities($cnt);?></b></td>
			<td style="font-size:14px;"><?php 
				$totalUnread = 0;
				$tempUnread = 0;
				$unreadcountDV1 = 0;
				
				
				$unreadcountDV1 = 0;
				$unreadcountDV1 = $result->chatHis;
				
				$sqlDV2 = "SELECT chatCount FROM tb_gpchat WHERE chatRoomNo=:cid ORDER BY chatCount DESC LIMIT 1";
				$queryDV2 = $connect -> prepare($sqlDV2);
				$queryDV2->bindParam(':cid',$result->chatRoomNo,PDO::PARAM_STR);
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
				
				
				
				
				
				if ($totalUnread <= 0){
					echo "";
				}
				else{
					echo "<b style='font-size:13px;' class='badge badge-danger'>". $totalUnread . "</b> &nbsp";
				}
				
			echo htmlentities($result->chatName);?></td>
			<td style="font-size:14px;"><?php echo htmlentities($result->chatCreatedOn);?></td>
			<td style="font-size:14px;">
				<?php 
					if ($result->chatCrtType == 'USER'){
						$field = "entity_no";
						$table = "tbl_users";
					}
					else{
						$field = "entity_no";
						$table = "tbl_individual";
					}
					
					$sql1 = "SELECT * FROM " . $table . " WHERE " . $field . "=:value1";
					$query1 = $connect -> prepare($sql1);
					$query1->bindParam(':value1',$result->chatCreator,PDO::PARAM_STR);
					$query1->execute();
					$results1=$query1->fetchAll(PDO::FETCH_OBJ);
					
					
					if($query1->rowCount() > 0)
					{
						foreach($results1 as $result1)
						{ 
							if ($table == "tbl_users"){
								echo $result1->fullname;
							}
							else{
								echo $result1->fullname;
							}
							
						}
					}
					
				?></td>
				<td>
					<form action="msgpui.php" method="post">
						<input type="hidden" name="nameTR" id ="nameTR" value="<?php echo htmlentities($result->chatName);?>" />
						<button type="submit" name="trCHAT" value="<?php echo htmlentities($result->chatRoomNo);?>" class="btn btn-block btn-primary btn-sm">Enter Chat</button>
					</form>
					
				</td>
				
				
				
		</tr>
		
		
	<?php $cnt++;} }?>		