<?php
	include("services/security.php");
	
	//get the volunteerID from the URL
	$volunteerID = $_GET["id"];
	
	//include the database connection
	include("services/databaseConnection.php");
	
	//write a query to remove the volunteer site details from the database
	if($stmt = mysqli_prepare($mysqli, "DELETE FROM volunteeredsites WHERE volunteerID = ?"))
	{
		//bind the parameters
		mysqli_stmt_bind_param($stmt, "i", $volunteerID);
		
		//execute the query
		mysqli_stmt_execute($stmt);
		
		//close the statement
		mysqli_stmt_close($stmt);
		
	}
	//close the connection
	mysqli_close($mysqli);
	
	//include the database connection
	include("services/databaseConnection.php") ;
	
	//write a query to remove the volunteer details from the database
	if($stmt = mysqli_prepare($mysqli, "DELETE FROM volunteer WHERE volunteerID = ?"))
	{
		//bind the parameters
		mysqli_stmt_bind_param($stmt, "i", $volunteerID);
		
		//execute the query
		mysqli_stmt_execute($stmt);
		
		//close the statement
		mysqli_stmt_close($stmt);
		
	}
	//close the connection
	mysqli_close($mysqli);
	
	//send the user to te delete confirmation page
	Header("Location: deleteVolunteerSuccess.php");
	
?>