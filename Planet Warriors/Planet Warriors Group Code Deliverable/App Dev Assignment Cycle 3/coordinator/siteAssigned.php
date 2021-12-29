<?php

	include("services/security.php");
	
	//get volunteer ID from the session
	
  $siteID = $_GET["id"];
	//get the siteID from the URL
 //sanitize the value from the url
  $siteID = filter_var($siteID, FILTER_SANITIZE_STRING);

  //check to see if the value is a number
  if(!is_numeric($siteID))
  {
    Header("Location: volunteerList.php");
  }	
	
	$volunteerID = $_SESSION{'volunteerID'};

	include("services/databaseConnection.php");
			//write an insert query to store the data in the database
			if($stmt = mysqli_prepare($mysqli,"INSERT INTO volunteeredSites(volunteerID, siteID) VALUES(?,?)"))
			{
				//bind the parameters for the markers
				mysqli_stmt_bind_param($stmt, "ii",$volunteerID,$siteID);
				
				//execute the query or die with an error message
				mysqli_stmt_execute($stmt) or die(mysqli_error($mysqli));
				//close the statement
				mysqli_stmt_close($stmt);
			
			mysqli_close($mysqli);
			}
		include("services/databaseConnection.php");
		//write a query to retrieve the volunteeredSitesID
		$volunteeredSitesID = 0;
		
		if($stmt = mysqli_prepare($mysqli, "SELECT volunteeredSitesID FROM volunteeredSites WHERE volunteerID = ?"))
		{
			//bind the param to markers
			mysqli_stmt_bind_param($stmt, "i", $volunteerID);

			//execute the query
			mysqli_stmt_execute($stmt);
			
			//bind th results
			mysqli_stmt_bind_result($stmt, $volunteeredSitesID);
			
			//fetch value
			if(mysqli_stmt_fetch($stmt))
			{
				$volunteeredSitesID = $volunteeredSitesID;
			}
			//close statement
			mysqli_stmt_close($stmt);
		}
		//close the connection
		mysqli_close($mysqli);

		//store the volunteeredSitesID in the session
		$_SESSION["volunteeredSitesID"] = $volunteeredSitesID;
	
	  //send the user to the Success page
		Header("Location: assignVolunteerSuccess.php?volunteeredSitesID=$volunteeredSitesID");
		
					
?>
