<?php
	session_start();
	//destroy the session
	session_destroy();
	
	//send the user back to the login screen
	Header("Location: ../index.php");
?>