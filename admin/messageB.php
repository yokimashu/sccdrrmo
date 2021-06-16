<?php
	include('../config/db_chatconfig.php');		
	
	
	
	$sql = "(SELECT * FROM tb_gpchat WHERE chatRoomNo=:lid ORDER BY chatGPNo DESC LIMIT 1000) ORDER BY chatGPNo ASC";
	
	$query = $connect -> prepare($sql);
	$query->bindParam(':lid',$_GET['chatid'],PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	$cntHis=0;
	$lastChat = 0;
	if($query->rowCount() > 0)
	{
		foreach($results as $result)
		{
			if ($result->chatSender == "SYSTEM BOT #10"){
				echo "<b style='padding-right:5px;'>" . $result->chatSender . "</b><br>";
			?>
			<div class="row">
				<div style="width:95%;background-color:#e3a4f5;border-radius:8px;margin:auto;height:auto;min-height:35px;">
					<?php 
						$htmldtext = $result->chatMessage;
						$htmldtext = preg_replace("/\\\\u([0-9A-F]{2,5})/i", "&#x$1;", $htmldtext);
						echo "<p style='margin-top:4px;padding:8px;color:black;'>" . $htmldtext
					. "<br><span style='font-size:10px;color:black;'>" . $result->chatSendTime . "</span></p>";?>
					
				</div>
			</div>
			<br>
			<?php
			}
			else if ($_SESSION['flname'] == $result->chatSender){
				echo "<b class='pull-right' style='padding-right:5px;'>" . strtoupper($result->chatSender) . "</b><br>";
			?>
			<div class="row">
				<div style="width:95%;background-color:#80ccff;border-radius:8px;margin:auto;height:auto;min-height:35px;">
					<?php 
						$htmldtext = $result->chatMessage;
						$htmldtext = preg_replace("/\\\\u([0-9A-F]{2,5})/i", "&#x$1;", $htmldtext);
						echo "<p style='margin-top:4px;padding:8px;color:black;'>" . $htmldtext
					. "<br><span style='font-size:10px;color:black;'>" . $result->chatSendTime . "</span></p>";?>
				</div>
			</div>
			<?php 
				if ($result->chatSeen != "Seen By"){
					echo "<p style='width:85%;font-size:10px;'>" . substr_replace($result->chatSeen,"", -1) . "</p>";
				}
			?>
			<br>
			<?php
			}
			else{
				echo "<b>" . strtoupper($result->chatSender) . "</b><br>";
			?>
			
			<div class="row">
				
				<div style="width:95%;background-color:#d6d6d4;border-radius: 8px;margin:auto;height:auto;min-height:35px;">
					<?php 
						$htmldtext = $result->chatMessage;
						$htmldtext = preg_replace("/\\\\u([0-9A-F]{2,5})/i", "&#x$1;", $htmldtext);
						echo "<p style='margin-top:4px;padding:8px;color:black;'>" . $htmldtext
					. "<br><span style='font-size:10px;color:black;'>" . $result->chatSendTime . "</span></p>";?>
				</div>
			</div>
			<?php 
				if ($result->chatSeen != "Seen By"){
					echo "<p style='width:85%;font-size:10px;'>" . substr_replace($result->chatSeen,"", -1) . "</p>";
				}
			?>
			<br>
			<?php
			}
			
			
			$cntHis++;
			$lastChatB = $result->chatCount;
			$lastSeenPB = $result->chatSeen;
		}
		
	?>
	<p id="gpLASTSEEN" hidden><?php echo $lastSeenPB;?></p>
	<script>
		if (autoScrollB == 1){
			$(document).ready(function(){
				var dB = $('#chatHereB');
				dB.scrollTop(dB.prop("scrollHeight"));				
			})}
	</script> 
	<?php
		
		
	}
	
	$sql = "SELECT * FROM tb_chatgroup WHERE chatRoomNo=:lid AND chatMember=:chatMember";
	$query = $connect -> prepare($sql);
	$query->bindParam(':lid',$_GET['chatid'],PDO::PARAM_STR);
	$query->bindParam(':chatMember',$_SESSION['entityno'],PDO::PARAM_STR);
	$query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0)
	{
		foreach($results as $result)
		{
			
			$intNewChat = $result->chatHis;
			
			if ($intNewChat < $cntHis){
				$sql5="UPDATE tb_gpchat SET chatSeen=CONCAT(chatSeen, ' '), 
				chatSeen=CONCAT(chatSeen, :chatBSeen), chatSeen=CONCAT(chatSeen, ',') WHERE chatCount=:chatNo AND chatRoomNo =:chatRoom 
				AND chatSenderID != :chatMemID";
				$query5 = $connect->prepare($sql5);
				$query5->bindParam(':chatNo',$cntHis,PDO::PARAM_STR);
				$query5->bindParam(':chatRoom',$_GET['chatid'],PDO::PARAM_STR);
				$query5->bindParam(':chatBSeen',$_SESSION['flname'],PDO::PARAM_STR);
				$query5->bindParam(':chatMemID',$_SESSION['entityno'],PDO::PARAM_STR);
				$query5->execute();
			}
			
			
			
		}
		
	}
	
	//EDIT
	$sql5="UPDATE tb_chatgroup SET chatHis=:chatNo WHERE chatMember=:accID AND chatRoomNo=:chatRoomNo";
	$query5 = $connect->prepare($sql5);
	$query5->bindParam(':accID',$_SESSION['entityno'],PDO::PARAM_STR);
	$query5->bindParam(':chatNo',$cntHis,PDO::PARAM_STR);
	$query5->bindParam(':chatRoomNo',$_GET['chatid'],PDO::PARAM_STR);
	$query5->execute();
	//EDIT
	
?>			