
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
							<h4>Private Message / Chatroom</h4>
						</div>
						
						<div class="card-body">
							
                            <div class="box-body">
                                <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                                <div class="card ">
                                    <div class="card-header">
                                        <h6><?php if(isset($_POST['nameTR']))
											{
												echo "<b>" . $_POST['nameTR'] . "</b>";
											}
										?> - (Private / Group Chat)</h6>
									</div>
                                    <div class="box-body">
										<?php if (isset($_POST['trCHAT'])){?>
											<div style="margin:20px;">
												<div class="row">
													<div class="col-lg-4">
														<style>
															.modal-dialog {
															width: 90%;
															height: 90%;
															margin: auto;
															margin-top: 30px;
															padding: 0;
															}			
															
															.modal-content {
															height: auto;
															min-height: 100%;
															border-radius: 0;
															}
														</style>
														<button type="button" class="btn btn-default" style="width:100%;" data-toggle="modal" 
														data-target="#modalGPChat">Add New Chat Member
														</button>
														<div class="modal fade" id="modalGPChat">
															<div class="modal-dialog">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title">Add New Chat Member</h4>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																		<span aria-hidden="true">&times;</span></button>
																	</div>
																	<div class="box-body">
																		<div style="margin:20px;">
																			<div class="form-group">
																				<label for="v_enttype">Entity Type</label>
																				<select name="v_enttype" id="v_enttype" class="form-control">
																					<option value="USER">USER</option>
																					<option value="INDIV">INDIVIDUAL</option>
																				</select>
																			</div>
																			<div class="form-group">
																				<label for="v_chatmem">Entity No</label>
																				<input type="text" id="v_chatmem" class="form-control" name="v_chatmem" value="" maxlength="40" autocomplete="off" required />
																			</div>
																			<button onclick="saveMember(v_chatmem.value,v_enttype.value)" style="width:auto;" type="submit" class="btn btn-info" name="addEmp" aria-label="Close">Add New Chatroom Member</button>
																		</div>
																	</div>
																	
																</div>
															</div>
														</div>
														
														<div style="height:435px;margin-top:15px;overflow-x:hidden;overflow-y:scroll;">
															<?php 
																echo "<input id='yxa22s' type='hidden' value='" . $_POST['trCHAT'] . "'></input>";
																echo "<br>";
																echo "Chat Members: <b style='font-size:16px;' class='label label-danger' id='chatNotifyB'></b>" . "<br>";
																
																
																
																include('../config/db_chatconfig.php');
																echo "<div id='membersHereB'>";
																
																
																echo "</div>";
															?>
															
														</div>
													</div>
													<div class="col-lg-8">
														<div id="succesAlertB" style="position: absolute; left: 50%;z-index:999;display:none;" >
															<div class="alert alert-success" style="position: relative; left: -50%; width:500px; text-align: center;font-size:20px;">
																A New Member is added to chat!
															</div>
															
														</div>
														
														<div id="succesAlertC" style="position: absolute; left: 50%;z-index:999;display:none;">
															<div class="alert alert-success" style="position: relative; left: -50%; width:500px; text-align: center;font-size:20px;">
																Member is removed from the chat!
															</div>
															
														</div>
														
														<div id="succesAlertD" style="position: absolute; left: 50%;z-index:999;display:none;">
															<div class="alert alert-success" style="position: relative; left: -50%; width:500px; text-align: center;font-size:20px;">
																Member is now muted!
															</div>
															
														</div>
														
														<div id="succesAlertE" style="position: absolute; left: 50%;z-index:999;display:none;">
															<div class="alert alert-warning" style="position: relative; left: -50%; width:500px; text-align: center;font-size:20px;">
																You are muted, you cannot send a message!
															</div>
															
														</div>
														
														<div id="succesAlertE1" style="position: absolute; left: 50%;z-index:999;display:none;">
															<div class="alert alert-warning" style="position: relative; left: -50%; width:500px; text-align: center;font-size:20px;">
																You are removed from this chat, you cannot send a message!
															</div>
															
														</div>
														
														<div id="succesAlertD1" style="position: absolute; left: 50%;z-index:999;display:none;">
															<div class="alert alert-success" style="position: relative; left: -50%; width:500px; text-align: center;font-size:20px;">
																Member is now unmuted!
															</div>
															
														</div>
														
														<div id="existingAlertB" style="position: absolute; left: 50%;z-index:999;display:none;">
															<div class="alert alert-danger" style="position: relative; left: -50%; width:500px; text-align: center;font-size:20px;">
																Error: The person you are adding is already a member/paticipant of this chat!
															</div>
														</div>
														
														<div id="chatHereB" class="box-body" style="height:350px;word-wrap: break-word;overflow-x:hidden;overflow-y:scroll;">
															
														</div>
														<br>
														<p id="replyValB">Enter Text Here: 
															<button class="btn btn-success" data-toggle="modal" data-target="#modalEmoji" type="button">&#128512;</button>
															<button id="copyMode1" class="btn btn-default pull-right" style="height:30px;font-size:12px;margin-left:5px;" type="submit"  onclick="copyMode1();"><b>Copy Mode</b></button>
														</p>
														<p id="replyVal2B" style="color:red;display:none;">Message Sent! </p>
														<p style="height:2px;"></p>
														<input onkeyup="notEmptyTextB();" autocomplete="off" type="text" style="height:50px;word-wrap: break-word;overflow:scroll;" 
														placeholder="Type message.." name="msgMainB" id="msgMainB" class="form-control" value="">
														<br>
														
														<button style="height:35px" type="submit" class="btn btn-danger" id="btn_submitB" onclick="disableButB();saveFormB();" disabled>Send</button>
													</div>
												</div>
											</div>
											<?php }else{
												echo "Action not allowed! Try Again!";
											}?>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
				</section> <br><br>
			</div>
			<div class="modal fade" id="modalEmoji">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Select Emoji</h4>
						</div>
						<div style="margin-left:15px;margin-right:10px;">
							<h4 style="color:red;">*It is normal to see [[\u1F44D]] in your textarea, 
							the system will automatically convert that into a emoji after sending it.</h4>
						</div>
						<div class="modal-body">
							
							<div style="margin-left:2%;margin-right:2%">
								<button style="font-size:30px;margin-top:5px;" value="1F44D" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#128077;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F44E" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#128078;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F355" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#127829;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F354" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#127828;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F382" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#127874;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F3E3" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#127971;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F489" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#128137;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F48A" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#128138;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F496" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#128150;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F494" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#128148;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F4E2" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#128226;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F600" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#128512;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F618" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#128536;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F637" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#128567;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F61C" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#128540;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F631" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#128561;</button>
								
								<button style="font-size:30px;margin-top:5px;" value="1F625" onclick="passEmoji(this.value);" 
								type="button" data-dismiss="modal" aria-label="Close">
								&#128549;</button>
							</div>
						</div>
					</div>
				</div>
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
			
			
			function passEmoji(strVal) {
				$('#msgMainB').val($('#msgMainB').val() + "[[\\u" + strVal + "]]");
				enableB();
			}
			
			
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
			var VcounterB = 3000;
			var refreshChatB = null;
			var autoScrollB = 1;
			var copyModeVar = 1;
			
			$(document).ready(function(){
				
				startChatB();
				
				startChatC();
				
				
			})
			
			
			function copyMode1(){
				$("#copyMode1").attr('disabled', 'disabled');
				copyModeVar = 2;
				$('#copyMode1').css('background',"orange");
				$('#copyMode1').css('font-weight',"bold");
				$('#copyMode1').text("Copy Mode (15)");
				var minusVar = 1;
				var displayVar = 0;
				var timerVar = setInterval(function () {
					displayVar = 15 - minusVar;
					$('#copyMode1').text("Copy Mode (" + displayVar + ")");
					minusVar = minusVar + 1;
					if (minusVar == 16){
						clearInterval(timerVar);
						$('#copyMode1').text("Copy Mode");
					}
				}, 1000);
				
				setTimeout(
				function() {
					$('#copyMode1').removeAttr('disabled');
					copyModeVar = 1;
					$('#copyMode1').css('background',"white");
					
				}, 15000);
			}
			
			function displayImmB(){
				
				var dats2 = $("#yxa22s").val();
				$("#membersHereB").load("../admin/chatmembers.php?memberID=" + dats2);
			}
			
			function startChatC() {
				var dats2 = $("#yxa22s").val();
				
				$("#membersHereB").load("../admin/chatmembers.php?memberID=" + dats2);
				
				refreshChatB = setInterval(function(){
					$("#membersHereB").load("../admin/chatmembers.php?memberID=" + dats2);
					
				},40000);
			}
			
			function startChatB() {
				var dats = $("#yxa22s").val();
				
				$("#chatHereB").load("../admin/messageB.php?chatid=" + dats);
				
				refreshChatB = setInterval(function(){
					var intVal = $("#yxa22s").val();
					var strSeen = $("#gpLASTSEEN").text();
					var vData = 0;
					var dataTosend2='user='+intVal+'&pwd='+intVal+'&seenb='+strSeen;
					
					$.ajax({
						url: 'checkChat.php',
						type: 'POST',
						data:dataTosend2,
						async: false,
						success: function (data) {
						
							vData = +data;
							
						},
						
					});
					
					if (vData != 0){
						if (copyModeVar == 1){
							$("#chatHereB").load("../admin/messageB.php?chatid=" + dats);
							displayImmB();
						}
					}
					
					
				},VcounterB);
			}
		</script>
		<script>
			$('#msgMainB').keypress(function (e) {
				var key = e.which;
				if(key == 13)  // the enter key code
				{
					disableButB();
					saveFormB(); 
				}
				
			});  
			function removeSpacesB(string) {
				return string.split(' ').join('');
			}
			
			function notEmptyTextB() {
				var strVal = removeSpacesB($("#msgMainB").val());
				//alert(strVal.length);
				//if($("#msgMain").val().length > 0){
				if(strVal.length > 0){
					enableB();
					} else { 
					disableButB();	
				}
			}
			
			
			
			
			function runImmB(){
				var dats = $("#yxa22s").val();
				$("#chatHereB").load("../admin/messageB.php?chatid=" + dats);
			}
			function enableB() {
				$('#btn_submitB').removeAttr('disabled');
				$('#btn_submitB').css('background',"#4CAF50");
			}
			function disableButB() {
				$("#btn_submitB").attr('disabled', 'disabled');
				$('#btn_submitB').css('background',"red");
			}
			function saveMember(strVal,strVal2) {
				
				var skey1 = $("#yxa22s").val();
				var data1= strVal;
				var data2= strVal2;
				var data3 = 0;
				
				var dataTosend='user='+skey1+'&pwd='+data1+'&pwd1='+data2;
				
				$.ajax({
					url: 'saveChatMember.php',
					type: 'POST',
					data:dataTosend,
					async: true,
					success: function (data) {
						//alert(data);
						data3 = +data;
						displayImmB();
						$(modalGPChat).modal('hide');
						
						if (data3 == 1){
							$("#succesAlertB").show();
							setTimeout(
							function() {
								$("#succesAlertB").hide();
							}, 4000);
						}
						else if (data3 == 2){
							$("#existingAlertB").show();
							setTimeout(
							function() {
								$("#existingAlertB").hide();
							}, 4000);
						}
						else{
							alert("Entity Does not Exist!");
						}
						
						
						
					},
					
				});
			}
			
			function delChatmate(strVal) {
				
				var data1= strVal;
				
				var dataTosend='user='+data1+'&pwd='+data1;
				
				$.ajax({
					url: 'delMate.php',
					type: 'POST',
					data:dataTosend,
					async: true,
					success: function (data) {
						displayImmB();
						//alert(data);
						$("#succesAlertC").show();
						
						
						setTimeout(
						function() {
							$("#succesAlertC").hide();
						}, 5000);
						
						
					},
					
				});
				
			}
			
			function muteChatmate(strVal) {
				
				var data1= strVal;
				
				var dataTosend='user='+data1+'&pwd='+data1;
				
				$.ajax({
					url: 'muteMate.php',
					type: 'POST',
					data:dataTosend,
					async: true,
					success: function (data) {
						displayImmB();
						var vData = +data;
						if (vData == 2){
							$("#succesAlertD1").show();
							
							setTimeout(
							function() {
								$("#succesAlertD1").hide();
							}, 5000);
						}
						else{
							$("#succesAlertD").show();
							
							setTimeout(
							function() {
								$("#succesAlertD").hide();
							}, 5000);
						}
						
						
						
					},
					
				});
				
			}
			
			function saveFormB() {
				
				var data3=$("#yxa22s").val();
				var data1=$("#msgMainB").val();
				
				var data2=$("#msgMainB").val();
				
				var dataTosend='user='+data1+'&pwd='+data2+'&pwd2='+data3;
				
				$.ajax({
					
					url: 'sendMes3.php',
					
					type: 'POST',
					
					data:dataTosend,
					
					async: true,
					
					success: function (data) {
						runImmB();
						
						var vData2 = +data;
						if (vData2 == 2){
							$("#msgMainB").val("");
							$("#replyValB").hide();
							$("#replyVal2B").show();
							
							setTimeout(
							function() {
								$("#replyValB").show();
								$("#replyVal2B").hide();
							}, 5000);
						}
						else if (vData2 == 3){
							$("#succesAlertE1").show();
							
							setTimeout(
							function() {
								$("#succesAlertE1").hide();
							}, 5000);
						}
						else{
							$("#succesAlertE").show();
							
							setTimeout(
							function() {
								$("#succesAlertE").hide();
							}, 5000);
						}
						
						
					},
					
				});
				
			}
			
			
			
			
		</script>
	</body>
	
</html>