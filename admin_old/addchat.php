<?php include('../config/db_chatconfig.php');
	
	
	if(isset($_POST['addEmp']))
	{
		$vl_chatname = $_POST['v_chatname'];
		$vl_user = 'USER';
		$vl_user2 = '1';
		$vl_user3 = '0';
		
		date_default_timezone_set('Asia/manila');
		$admremarkdate2=date('m/d/Y H:i A ', strtotime("now"));
		$admremarkdate=date('m/d/Y G:i:s ', strtotime($admremarkdate2));
		
		$sql="INSERT INTO tb_chatroom (chatName,chatCreatedOn,chatCreator,chatCrtType) 
		VALUES (:chatName,:chatCreatedOn,:chatCreator,:chatCrtType)";
		$query = $connect->prepare($sql);
		$query->bindParam(':chatName',$vl_chatname,PDO::PARAM_STR);
		$query->bindParam(':chatCreatedOn',$admremarkdate2,PDO::PARAM_STR);
		$query->bindParam(':chatCreator',$_SESSION['entityno'],PDO::PARAM_STR);
		$query->bindParam(':chatCrtType',$vl_user,PDO::PARAM_STR);
		$query->execute();
		
		$lastInsertId = $connect->lastInsertId();
		if($lastInsertId)
		{
			
		}
		
		//new
		$zeroVar = 0;
		$zeroVar2 = "SYSTEM BOT #10";
		$countR = 1;
		$input2 = $_SESSION['flname'] . " has created chat room - " . $vl_chatname . ".";
		$sql4="INSERT INTO tb_gpchat (chatRoomNo,chatCount,chatSenderID,chatSender,chatMessage,chatSendTime) 
		VALUES (:chatRoomNo,:chatCount,:chatSenderID,:chatSender,:chatMessage,:chatSendTime)";
		$query4 = $connect->prepare($sql4);
		$query4->bindParam(':chatRoomNo',$lastInsertId,PDO::PARAM_STR);
		$query4->bindParam(':chatCount',$countR,PDO::PARAM_STR);
		$query4->bindParam(':chatSenderID',$zeroVar,PDO::PARAM_STR);
		$query4->bindParam(':chatSender',$zeroVar2,PDO::PARAM_STR);
		$query4->bindParam(':chatMessage',$input2,PDO::PARAM_STR);
		$query4->bindParam(':chatSendTime',$admremarkdate,PDO::PARAM_STR);
		$query4->execute();
		
		$lastInsertId4 = $connect->lastInsertId();
		if($lastInsertId4)
		{
			
		}
		
		$sql="INSERT INTO tb_chatgroup (chatRoomNo,chatMember,chatMType,chatPower,chatMute,chatInv,chatInvDate,chatHis) 
		VALUES (:chatRoomNo,:chatMember,:chatMType,:chatPower,:chatMute,:chatInv,:chatInvDate,:chatHis)";
		$query = $connect->prepare($sql);
		$query->bindParam(':chatRoomNo',$lastInsertId,PDO::PARAM_STR);
		$query->bindParam(':chatMember',$_SESSION['entityno'],PDO::PARAM_STR);
		$query->bindParam(':chatMType',$vl_user,PDO::PARAM_STR);
		$query->bindParam(':chatPower',$vl_user2,PDO::PARAM_STR);
		$query->bindParam(':chatMute',$vl_user3,PDO::PARAM_STR);
		$query->bindParam(':chatInv',$_SESSION['entityno'],PDO::PARAM_STR);
		$query->bindParam(':chatInvDate',$admremarkdate2,PDO::PARAM_STR);
		$query->bindParam(':chatHis',$vl_user3,PDO::PARAM_STR);
		$query->execute();
		
		$lastInsertId3 = $connect->lastInsertId();
		if($lastInsertId3)
		{
			header("location:../admin/chatroom.php?an=1");
		}
		
		
		
		
		
		
		
		
		$msg = 333;
	}
	
?>

<!DOCTYPE html>
<html>
	
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>VAMOS | User Credentials Update </title>
		<?php include('heading.php'); ?>
		
		
		
	</head>
	
	
	
	<body class="hold-transition sidebar-mini">
		<div class="wrapper">
			
			<?php include('sidebar.php'); ?>
			
			<div class="content-wrapper">
				<div class="content-header"></div>
				
				
				<section class="content ">
					<div class="card">
						<div class="card-header text-white bg-success">
							<h4>Create</h4>
						</div>
						
						<div class="card-body">
							<form role="form" enctype="multipart/form-data" method="post" id="input-form" action="<?php htmlspecialchars("PHP_SELF"); ?>">
								<div class="box-body">
									<!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
									<div class="card ">
										<div class="card-header">
											<h6>Chat Room Name / Title</h6>
										</div>
										<div class="box-body">
											<br>
											<div style="margin:20px;">
											<form name="adminaction" method="post">
												
												<div class="form-group">
													<label for="v_chatname">Chat Name / Title</label>
													<input type="text" id="v_chatname" class="form-control" name="v_chatname" value="" maxlength="40" autocomplete="off" required />
												</div>
												<button style="width:200px;" type="submit" class="btn btn-info" name="addEmp">Create Room</button>
											</form>
											</div>
										</div>
									</div>
									
								</div>
							</form>
						</div>
					</div>
				</section> <br><br>
			</div>
			
			<?php include('footer.php') ?>
			
		</div>
		
		
		<!-- jQuery -->
		<script src="../plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- datepicker -->
		<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
		<!-- Bootstrap WYSIHTML5 -->
		<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
		<!-- Slimscroll -->
		<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
		<script src="../plugins/fastclick/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="../dist/js/adminlte.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="../dist/js/pages/dashboard.js"></script>
		<!-- AdminLTE for demo purposes -->
	<script src="../dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.js"></script>
    <!-- DataTables Bootstrap -->
    <script src="../plugins/datatables/dataTables.bootstrap4.js"></script>
    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js"></script>
	
    <script>
	$('#users').DataTable({
	'paging': true,
	'lengthChange': true,
	'searching': true,
	'ordering': true,
	'info': true,
	'autoWidth': true,
	'autoHeight': true,
	initComplete: function() {
	this.api().columns([4]).every(function() {
	var column = this;
	var select = $('<select class="form-control select2"><option value="">show all</option></select>')
	.appendTo('#combo')
	.on('change', function() {
	var val = $.fn.dataTable.util.escapeRegex(
	$(this).val()
	);
	column
	.search(val ? '^' + val + '$' : '', true, false)
	.draw();
	});
	column.data().unique().sort().each(function(d, j) {
	select.append('<option value="' + d + '">' + d + '</option>')
	});
	});
	}
	
	});
	$('.select2').select2();
	
	
	
	
	
	function checkUsername() {
	var username = $('#username').val();
	if (username.length >= 3) {
	$("#status").html('<img src="loader.gif" /> Checking availability...');
	$.ajax({
	type: 'POST',
	data: {
	username: username
	},
	url: 'check_username.php',
	success: function(data) {
	$("#status").html(data);
	
	}
	});
	}
	};
	
	
	// $(document).ready(function() {
	
	
	//     $('#username').change(function() {
	//         if ($('#entity_no').val() == '') {
	//             $.ajax({
	//                 type: 'POST',
	//                 data: {},
	//                 url: 'generate_id.php',
	//                 success: function(data) {
	//                     //$('#entity_no').val(data);
	//                     document.getElementById("entity_no").value = data;
	//                     console.log(data);
	//                 }
	//             });
	//         }
	//     });
	
	
	// });
	
	
	// $("#insert_user").click(function(e) {
	//     e.preventDefault();
	//     var name = $("#name").val();
	//     var last_name = $("#last_name").val();
	//     var 
	//     var dataString = 'name=' + name + '&last_name=' + last_name;
	//     $.ajax({
	//         type: 'POST',
	//         data: dataString,
	//         url: 'insert_user.php',
	//         success: function(data) {
	//             alert(data);
	//         }
	//     });
	// });
    </script>
	</body>
	
	</html>	