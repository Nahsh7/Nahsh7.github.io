<?php
	session_start();
	//check if the user has a staffID in the session
	if(!isset($_SESSION['coordinatorID']))
	{
		//send the user back to the login
		Header("Location: ../index.php");
	}

?>
