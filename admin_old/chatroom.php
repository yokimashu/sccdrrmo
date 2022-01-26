

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
							<h4>Private Chat / Chatroom</h4>
						</div>
						
						<div class="card-body">
							<div class="box">
								<a href="addchat.php" style="width:300px;" class="btn btn-info" >Create Chat Room</a>
								<br><br>
								<div class="box-header with-border">
									<h3 class="box-title">List of Chat Rooms</h3>
									
								</div>
								
								<div class="box-body">
									
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th style="font-size:11px;">#</th>
												<th>Chat Name:</th>
												<th>Date Created:</th>
												<th>Created By:</th>
												<th>Action:</th>
											</tr>
										</thead>
										<tbody id="chatRoomMes">
											
										</tbody>
										
									</table>
									
								</div>
								<!-- /.box-body -->
								<div class="box-footer">
									
								</div>
								<!-- /.box-footer-->
							</div>
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
		<script>
			$(document).ready(function(){
				
				$("#chatRoomMes").load("messageC.php");
				setInterval(function(){
					$("#chatRoomMes").load("messageC.php");
				},10000);
				
			})
		</script>
	</body>
	
</html>					