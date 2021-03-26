<style>
	body {font-family: Arial, Helvetica, sans-serif;}
	* {box-sizing: border-box;}
	
	/* Button used to open the chat form - fixed at the bottom of the page */
	.open-button {
	background-color: #555;
	color: white;
	padding: 5px 5px;
	border: none;
	cursor: pointer;
	opacity: 0.8;
	position: fixed;
	bottom: 15px;
	right: 28px;
	width: 120px;
	z-index: 999;
	}
	
	#MainBody{
	max-width: 700px;
	padding: 10px;
	background-color: white;
	
	}
	
	#MainText{
	width: 100%;
	padding: 10px;
	border: none;
	background: #f1f1f1;
	resize: none;
	min-height: 50px; 
	
	}
	
	/* The popup chat - hidden by default */
	.chat-popup {
	display: none;
	position: fixed;
	bottom: 0;
	right: 15px;
	border: 3px solid #f1f1f1;
	z-index: 1000;
	height:600px;
	width:350px;
	}
	
	/* Add styles to the form container */
	.form-container {
	max-width: 700px;
	padding: 10px;
	background-color: white;
	}
	
	/* Full-width textarea */
	.form-container textarea {
	width: 100%;
	padding: 10px;
	position: fixed;
	border: none;
	background: #f1f1f1;
	resize: none;
	min-height: 50px; 
	}
	
	/* When the textarea gets focus, do something */
	.form-container textarea:focus {
	background-color: #ddd;
	outline: none;
	}
	
	/* Set a style for the submit/send button */
	#btn_submit {
	background-color:red;
	color: white;
	border: none;
	cursor: pointer;
	width: 100%;
	margin-bottom:10px;
	opacity: 0.8;
	}
	
	#chatHere {
	background-color:white;
	color: black;
	border: none;
	cursor: pointer;
	width: 100%;
	margin-bottom:10px;
	opacity: 1;
	}
	
	/* Add a red background color to the cancel button */
	#btnCancel {
	background-color: red;
	color: white;
	border: none;
	cursor: pointer;
	width: 100%;
	margin-bottom:10px;
	opacity: 0.8;
	}
	
	/* Add some hover effects to buttons */
	.form-container .btn:hover, .open-button:hover {
	opacity: 1;
	}
</style>


<div>
	<button id="chatButton" class="open-button" onclick="openForm();startChat()">Chat &nbsp
		<b style="font-size:16px;" class="label label-danger" id="chatNotify"></b>
	</button>
</div>

<div class="chat-popup" id="myForm">
	<div class="box-tools pull-right" style="margin-right:10px;">
		<button type="button" class="btn btn-box-tool" onclick="closeForm()" title="Collapse">
		<i class="fa fa-times"></i></button>  
	</div>
	<div id="MainBody" style="bg-color:white;">
		<h3><b style="color:green">VAMOS</b> Chat</h3>
		
		<script src="jquery-3.5.1.min.js"></script>
		<script>
			
			$(document).ready(function(){
			
			$("#chatNotify").load("../admin/msgnotif.php");
			
			setInterval(function(){
			$("#chatNotify").load("../admin/msgnotif.php");
			},4000);
			})
		</script>
		<script>
			var Vcounter = 2000;
			var refreshChat = null;
			var autoScroll = 1;
			
			
			
			function autoScrollVar() {
				if (autoScroll == 1){
					autoScroll = 0;
					$("#AutoScrollButton").text("Enable Auto Scroll Down");
					$("#AutoScrollButton").css('font-weight', 'bold');
					}else{
					autoScroll = 1;
					$("#AutoScrollButton").text("Disable Auto Scroll Down");
				$("#AutoScrollButton").css('font-weight', 'bold');
				}
				}
				
				
				function startChat() {
				
				$("#chatHere").load("../admin/message.php");
				
				refreshChat = setInterval(function(){
				
				if($("#vLASTCHAT").text() != $("#bLASTCHAT").text()) 
				{
					$("#chatHere").load("../admin/message.php");
				}
				
				},Vcounter);
				}
				
				
				
				
		</script>
		
		
		<div id="chatHere" class="box-body" style="height:350px;word-wrap: break-word;overflow-x:hidden;overflow-y:scroll;">
		</div>
		
		<p id="replyVal">Enter Text Here:</p>
		<p id="replyVal2" style="color:red;">Message Sent! </p>
		<input onkeyup="notEmptyText();" autocomplete="off" type="text" style="height:50px;word-wrap: break-word;overflow:scroll;" placeholder="Type message.." name="msgMain" id="msgMain" class="form-control" value="">
		<br>
		<button style="height:30px" type="submit" class="btn" id="btn_submit" onclick="disableBut();saveForm();" disabled>Send</button>
		
	</div>
</div>






<script>
	$('#msgMain').keypress(function (e) {
		var key = e.which;
		if(key == 13)  // the enter key code
		{
			disableBut();
			saveForm(); 
		}
		
	});  
	function removeSpaces(string) {
		return string.split(' ').join('');
	}
	
	function notEmptyText() {
		var strVal = removeSpaces($("#msgMain").val());
		
		if(strVal.length > 0){
			enable();
			} else { 
			disableBut();	
		}
	}
	
	function openForm() {
		document.getElementById("myForm").style.display = "block";
		var d = $('#chatHere');
		d.scrollTop(d.prop("scrollHeight"));
		$("#replyVal2").hide();
	}
	
	function closeForm() {
		document.getElementById("myForm").style.display = "none";
		clearInterval(refreshChat);
	}
	function runImm(){
		$("#chatHere").load("../admin/message.php");
		
	}
	function enable() {
		$('#btn_submit').removeAttr('disabled');
		$('#btn_submit').css('background',"#4CAF50");
	}
	function disableBut() {
		$("#btn_submit").attr('disabled', 'disabled');
		$('#btn_submit').css('background',"red");
	}
	
	
	function saveForm() {
		
		var data1=$("#msgMain").val();
		var data2=$("#msgMain").val();
		var dataTosend='user='+data1+'&pwd='+data2;
		$.ajax({
			
			url: 'sendMes.php',
			
			type: 'POST',
			
			data:dataTosend,
			
			async: true,
			
			success: function (data) {
				runImm();
				$("#msgMain").val("");
				$("#replyVal").hide();
				$("#replyVal2").show();
				
				setTimeout(
				function() {
					$("#replyVal").show();
					$("#replyVal2").hide();
				}, 5000);
				
			},
			
		});
		
	}
	
	
	
	
</script>
