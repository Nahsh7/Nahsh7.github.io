<?php
	$thirdConnection = new mysqli('localhost','root', '', 'planetwarriors');
	
	if(mysqli_connect_errno()){
		
		echo "Database Connection Failed: " .mysqli_connect_errno();
		exit();
		
	}
	
	
	//echo("database connected");
?>