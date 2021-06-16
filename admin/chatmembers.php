<?php
	
	include('../config/db_chatconfig.php');		
	
	$powerAdmin = 0;
	$sql = "SELECT * FROM tb_chatgroup WHERE chatRoomNo=:chatRoomNo";
	$query = $connect -> prepare($sql);
	$query->bindParam(':chatRoomNo',$_GET['memberID'],PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	
	if($query->rowCount() > 0)
	{
		foreach($results as $result)
		{        
			if ($_SESSION['entityno'] == $result->chatMember){
				$powerAdmin = $result->chatPower;
			}
			
			if ($result->chatMType == 'USER'){
				$field = "entity_no";
				$table = "tbl_users";
			}
			else{
				$field = "entity_no";
				$table = "tbl_individual";
			}
			
			$sql1 = "SELECT * FROM " . $table . " WHERE " . $field . "=:value1";
			$query1 = $connect -> prepare($sql1);
			$query1->bindParam(':value1',$result->chatMember,PDO::PARAM_STR);
			$query1->execute();
			$results1=$query1->fetchAll(PDO::FETCH_OBJ);
			
			
			if($query1->rowCount() > 0)
			{
				foreach($results1 as $result1)
				{ 
					if ($table == "tbl_users"){
						if ($powerAdmin == 1){
							echo "<button class='fa fa-times' value='" . $result->chatConNo . "'
							onclick='delChatmate(this.value);' style='padding: 0;border: none;background: none;color: red;'></button> &nbsp &nbsp";
							if ($result->chatMute == 1){
								echo "<button class='fa fa-microphone-slash' value='" . $result->chatConNo . "'
								onclick='muteChatmate(this.value);' style='padding: 0;border: none;background: none;color: black;'></button> &nbsp";
							}
							else{
								echo "<button class='fa fa-microphone' value='" . $result->chatConNo . "'
								onclick='muteChatmate(this.value);' style='padding: 0;border: none;background: none;color: black;'></button> &nbsp";
							}
							
						}
						
						echo "<p class='badge badge-success' style='font-size:14px;margin-top:15px;word-wrap: break-word;'>" . strtoupper($result1->fullname) . "</p>";
						echo "<br>";
					}
					else{
						if ($powerAdmin == 1){
							echo "<button class='fa fa-times' value='" . $result->chatConNo . "'
							onclick='delChatmate(this.value);' style='padding: 0;border: none;background: none;color: red;'></button> &nbsp &nbsp";
							echo "<button class='fa fa-microphone' value='" . $result->chatConNo . "'
							onclick='muteChatmate(this.value);' style='padding: 0;border: none;background: none;color: black;'></button> &nbsp";
						}
						echo "<p class='badge badge-warning' style='font-size:14px;margin-top:15px;word-wrap: break-word;'>" . strtoupper($result1->fullname) . "</p>";
						echo "<br>";
					}
					
				}
			}
		} 
	}
?>