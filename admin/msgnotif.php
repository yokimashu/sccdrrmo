<?php
	session_start();
	$user_id = $_SESSION['id'];
	
	if (!isset($_SESSION['id'])) {
		header('location:../index.php');
		} else {
		
	}
	
	include ('../config/db_config.php');
	
	
	
	
	$sql = "SELECT * FROM tbl_message ORDER BY message_objid DESC LIMIT 1";
    $execute_sql = $con->prepare($sql);
    $execute_sql->execute();
    while($result = $execute_sql->fetch(PDO::FETCH_ASSOC))
    {
		$intChat = $result['message_objid'];
		
		$intResult = $intChat - $_SESSION['chatNo'];
		if ($intResult != 0){
			echo "&nbsp " . $intResult . " &nbsp";
			
		?>
		<p id="bLASTCHAT" hidden><?php echo $intChat;?></p>
		<p id="vLASTCHAT" hidden><?php echo $_SESSION['chatNo'];?></p>
		<?php
		}
		else{
			echo "";
		?>
		<p id="bLASTCHAT" hidden>0</p>
		<p id="vLASTCHAT" hidden>0</p>
		<?php
		}
	}
	
?>
