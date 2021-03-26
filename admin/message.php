<?php
	session_start();
	$user_id = $_SESSION['id'];
	
	if (!isset($_SESSION['id'])) {
		header('location:../index.php');
		} else {
		
	}
	$lastChat = 0;
	include ('../config/db_config.php');
	
	$sql = "(SELECT * FROM tbl_message ORDER BY message_objid DESC LIMIT 100) ORDER BY message_objid ASC";
    $execute_sql = $con->prepare($sql);
    $execute_sql->execute();
    while($result = $execute_sql->fetch(PDO::FETCH_ASSOC))
    {
		
		if ($_SESSION['user'] == $result['sender']){
			echo "<b style='font-size:14px;float:right;padding-right:20px;'>" . $result['sender'] . "</b><br>";
		?>
		<div class="row">
			<div style="width:85%;background-color:#80ccff;border-radius:8px;margin:auto;height:auto;min-height:20px;">
				<?php echo "<p style='font-size:14px;margin-top:4px;padding:10px;color:black;'>" . $result['message'] . "</p>";?>
			</div>
			
			
		</div>
		<br>
		<?php
		}
		else{
			echo "<b style='font-size:14px;padding-left:20px;'>" . $result['sender'] . "</b><br>";
		?>
		
		<div class="row">
			
			<div style="width:85%;background-color:#d6d6d4;border-radius: 8px;margin:auto;height:auto;min-height:20px;">
				<?php echo "<p style='font-size:14px;margin-top:4px;padding:10px;color:black;'>" . $result['message'] . "</p>";?>
			</div>
		</div>
		<br>
		
		<?php
		}
		$lastChat = $result['message_objid'];
	}
	
	
?> 

<script>
	if (autoScroll == 1){
		$(document).ready(function(){
			var d = $('#chatHere');
			d.scrollTop(d.prop("scrollHeight"));				
		})}
</script> 
<?php
	$_SESSION['chatNo'] = $lastChat;
	
	
	$sql = "UPDATE tbl_users set chatNo = :chatNo where id = :entity";
    $exe_sql = $con->prepare($sql);
    $exe_sql->execute([':entity' => $_SESSION['id'],':chatNo' => $lastChat]);
	
	
	
?>		