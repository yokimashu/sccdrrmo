<?php
	
	session_start();
	$user_id = $_SESSION['id'];
	
	if (!isset($_SESSION['id'])) {
		header('location:../index.php');
		} else {
		
	}
	
	include ('../config/db_config.php');
	
	
	$user=$_POST['user'];
	$pwd=$_POST['pwd'];
	
	
	$input1 = $_SESSION['user'];
	$input2 = $user;
	
	
	if (substr_count($input2, '@') > 0) {
		
		
		$INParray =  explode(' ', $input2);
		$cnt_array = count($INParray) - 1;
		
		for ($x = 0; $x <= $cnt_array; $x++) {
			if (substr_count($INParray[$x], '@') > 0) {
				$INParray[$x] = "<b style='color:red;'>" . $INParray[$x] . "</b>";
				
			}
			
		}
		$input2 = join(" ",$INParray);
		
	}
	//Temporary
	$sample = 40;
	
	
	date_default_timezone_set('Asia/manila');
	$date=date('Y-m-d', strtotime("now"));
	$time=date('G:i:s', strtotime("now"));
	
	$insert_send_sql = "INSERT INTO tbl_message SET 
	
	notif_objid           = :notif_objid,
	sender           = :sender,
	date           = :date,
	time           = :time,
	message             = :message";
	
    $notif_data = $con->prepare($insert_send_sql);
    $notif_data->execute([
	
	':notif_objid'    => $sample,
	':sender'         => $input1,
	':date'         => $date,
	':time'         => $time,
	':message'        => $input2
	
    ]);
	
	
?>