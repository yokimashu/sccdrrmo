<?php include('chat.php') ?>
<script>
	$(document).ready(function(){
		$("#PMessage").load("../admin/gpmessage.php");
		setInterval(function(){
			$("#PMessage").load("../admin/gpmessage.php");
		},10000);
	})
</script>

<?php
	
	$curYear = date('Y');
	
?>

<footer class="main-footer">
    <strong>Copyright &copy; 2020 ITCSO <a href="http://lguscc.gov.ph">Local Government of San Carlos City</a>.</strong>
	
    <div class="float-right d-none d-sm-inline-block">
        All rights reserved.
	</div>
</footer>
