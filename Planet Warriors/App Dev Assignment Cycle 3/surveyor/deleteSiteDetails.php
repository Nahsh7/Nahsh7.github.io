<?php
	include("services/security.php");
	
	//get the siteID from the URL
	$siteID = $_GET["id"];
	
	//include the database connection
	include("services/databaseConnection.php");
	
	//write a query to remove the surveyor details from the database
	if($stmt = mysqli_prepare($mysqli, "DELETE FROM volunteeredsites WHERE siteID = ?"))
	{
		//bind the parameters
		mysqli_stmt_bind_param($stmt, "i", $siteID);
		
		//execute the query
		mysqli_stmt_execute($stmt);
		
		//close the statement
		mysqli_stmt_close($stmt);
		
	}
	//close the connection
	mysqli_close($mysqli);
	
	//include the database connection
	include("services/databaseConnection.php") ;
	
	//write a query to remove the site details from the database
	if($stmt = mysqli_prepare($mysqli, "DELETE FROM site WHERE siteID = ?"))
	{
		//bind the parameters
		mysqli_stmt_bind_param($stmt, "i", $siteID);
		
		//execute the query
		mysqli_stmt_execute($stmt);
		
		//close the statement
		mysqli_stmt_close($stmt);
		
	}
	//close the connection
	mysqli_close($mysqli);
	
	//send the user to te delete confirmation page
	Header("Location: deleteSiteSuccess.php");
	
	
?>