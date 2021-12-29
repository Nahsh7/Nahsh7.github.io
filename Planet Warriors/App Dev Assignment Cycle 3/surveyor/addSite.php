<?php
	include("services/security.php");
	
	//get the surveyorID of the user that is logged in from the session
	$surveyorID = $_SESSION["surveyorID"];
	
	//set up the error placeholders
	$error1 = "";	
	$error2 = "";	
	$error3 = "";	
	$error4 = "";	
	$error5 = "";	
	$error6 = "";	
	$error7 = "";	
	$error8 = "";	
	$error9 = "";
	
	//determine if the user has clicked the submit button
	if(isset($_POST['addSiteSubmit']))
	{
		//getting the values from the form
		$siteName = trim($_POST['siteName']);		
		$siteGeography = trim($_POST['siteGeography']);		
		$siteAddress = trim($_POST['siteAddress']);		
		$generalDescription = trim($_POST['generalDescription']);
		$accessFee = trim($_POST['accessFee']);					
		$warden= trim($_POST['warden']);		
		$wardenNo = trim($_POST['wardenNo']);		
		$status = trim($_POST['status']);		
		$imageName = trim($_POST['imageName']);
		
		//validation
		$errorCounter = 0;
		//validate siteName
		if($siteName =="" || $siteName == null)
		{
			$errorCounter++;
			$error1 = "You must enter a site name"; 
		}
		else
		{
		$siteName1 = filter_var($siteName, FILTER_SANITIZE_STRING);
				
		include("services/databaseConnection.php");
				
		if($stmt=mysqli_prepare($mysqli, "SELECT * FROM Site WHERE siteName = ?"))
		{
			mysqli_stmt_bind_param($stmt, "s", $siteName1);
					
			mysqli_stmt_execute($stmt);
					
			mysqli_stmt_store_result($stmt);
					
			$numRows= mysqli_stmt_num_rows($stmt);
					
				if($numRows != 0)
				{
						$errorCounter++;
						$error1 = "This site name already exists";
				}
					
			mysqli_stmt_close($stmt);
		}
			mysqli_close($mysqli);
		}	
		if($siteGeography =="" || $siteGeography == null)
		{
			$errorCounter++;
			$error2 = "You must enter a site geography";
		}		
		if($siteAddress =="" || $siteAddress == null)
		{
			$errorCounter++;
			$error3 = "You must enter a site address";
		}		
		if($generalDescription =="" || $generalDescription == null)
		{
			$errorCounter++;
			$error4 = "You must enter a General Description";
		}		

		if($accessFee =="" || $accessFee == null)
		{
			$errorCounter++;
			$error5 = "You must enter an access fee site ";
		}		
		if($warden =="" || $warden == null)
		{
			$errorCounter++;
			$error6 = "You must enter a warden name";
		}		
		if($wardenNo =="" || $wardenNo == null)
		{
			$errorCounter++;
			$error7 = "You must enter a warden number";
		}
		if($status =="" || $status == null)
		{
			$errorCounter++;
			$error8 = "You must enter a status";
		}		
		if($imageName =="" || $imageName == null)
		{
			$errorCounter++;
			$error9 = "You must enter a image name";
		}		
		
		//store the data-bs-toggle
		
		if($errorCounter == 0)
		{
			//sanitize the data
			$siteName = filter_var($siteName, FILTER_SANITIZE_STRING);			
			$siteGeography = filter_var($siteGeography, FILTER_SANITIZE_STRING);
			$siteAddress = filter_var($siteAddress, FILTER_SANITIZE_STRING);
			$generalDescription = filter_var($generalDescription, FILTER_SANITIZE_STRING);
			$accessFee = filter_var($accessFee, FILTER_SANITIZE_STRING);
			$warden = filter_var($warden, FILTER_SANITIZE_STRING);
			$wardenNo = filter_var($wardenNo, FILTER_SANITIZE_STRING);
			$status = filter_var($status, FILTER_SANITIZE_STRING);
			$imageName = filter_var($imageName, FILTER_SANITIZE_STRING);
			
			//include the database connection
			include("services/databaseConnection.php");
			
			//write an insert query to store the data in the database
			if($stmt = mysqli_prepare($mysqli,"INSERT INTO Site(siteName, siteGeography, address, generalDescription, accessFee, warden, wardenNo, status, imageName, surveyorID) VALUES (?,?,?,?,?,?,?,?,?,?)"))
			{
				//bind the parameters for the markers
				mysqli_stmt_bind_param($stmt, "sssssssssi",$siteName,$siteGeography,$generalDescription, $siteAddress, $accessFee,$warden, $wardenNo,$status,$imageName,$surveyorID);
				
				//execute the query or die with an error message
				mysqli_stmt_execute($stmt) or die(mysqli_error($mysqli));
				
				//close the statement
				mysqli_stmt_close($stmt);
			}
			//close the connection
			mysqli_close($mysqli);
		
		include("services/databaseConnection.php");
		
		//write a query to retrieve the siteID
		$siteID = 0;
		
		if($stmt = mysqli_prepare($mysqli, "SELECT siteID FROM Site WHERE siteName = ?"))
		{
			//bind the param to markers
			mysqli_stmt_bind_param($stmt, "s", $siteName);

			//execute the query
			mysqli_stmt_execute($stmt);
			
			//bind th results
			mysqli_stmt_bind_result($stmt, $siteID);
			
			//fetch value
			if(mysqli_stmt_fetch($stmt))
			{
				$siteID = $siteID;
			}
			//close statement
			mysqli_stmt_close($stmt);
		}
		//close the connection
		mysqli_close($mysqli);
		
		
		
			//send the user to the add site success page 
			Header("Location: addSiteSuccess.php?siteID=$siteID");
			
			//echo("site has been added, check db");
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Planet Warrior</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
    crossorigin="anonymous"></script>
	<meta charset="utf-8">
		<title>HTML</title>
		<style>
			.row {
			  display: flex;
			}
			.column {
			  flex: 50%;
			  padding: 16px;
			  height: 250px;
			}
		</style>
</head>

<body>
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="surveyor.html">Planet Warriors</a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
        class="fas fa-bars"></i></button>
		
      <div class="input-group">
      </div>

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Location </div>
            <!-- TODO change to the Actual form of Adding Locations -->
            <a class="nav-link" href="siteList.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              View Site List
            </a>
            <a class="nav-link" href="addSite.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Add Site
            </a>
            <a class="nav-link" href="editSite.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Edit Site
            </a>
            <a class="nav-link" href="siteSearch.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Search Site
            </a>
          </div>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
			</br>
			
			
			
			
			 <div class="container-fluid px-4">
			 <ol class="breadcrumb animate-box">
			<li class="breadcrumb-item underline"><a href="surveyorHome.php">Home</a></li>
			<li class="breadcrumb-item underline"><a href="addSite.php">Add Site</a></li>
		</ol>
		<h1> Add Site Form </h1>
			<form method="post" action="addSite.php" name="addSiteForm">
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="siteName">Site Name:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="siteName" class="form-control" name="siteName" value="" />
			</div>
			<span><?php echo($error1); ?> </span>
			</div>
			
			
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="siteGeography">Site Geography:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="siteGeography" class="form-control" name="siteGeography" value="" />
			</div>
			<span><?php echo($error2); ?> </span>
			</div>
			
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="siteAddress">Site Address:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="siteAddress" class="form-control" name="siteAddress" value="" />
			</div>
			<span><?php echo($error3); ?> </span>
			</div>

			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="generalDescription">General Description:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="generalDescription" class="form-control" name="generalDescription" value="" />
			</div>
			<span><?php echo($error4); ?> </span>
			</div>
			
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="accessFee">Access Fee:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="accessFee" class="form-control" name="accessFee" value="" />
			</div>
			<span><?php echo($error5); ?> </span>
			</div>
			
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="warden">Warden:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="warden" class="form-control" name="warden" value="" />
			</div>
			<span><?php echo($error6); ?> </span>
			</div>
			
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="wardenNo">Warden Number:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="wardenNo" class="form-control" name="wardenNo" value="" />
			</div>
			<span><?php echo($error7); ?> </span>
			</div>		
			
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Status:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="status" class="form-control" name="status" value="" />
			</div>
			<span><?php echo($error8); ?> </span>
			</div>		
			
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="imageName">Site Image:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="imageName" class="form-control" name="imageName" value="" />
			</div>
			<span><?php echo($error9); ?> </span>
			</div>	
			<div>
			</br>
			<div class="container-fluid px-4">
			<div class="container-fluid px-4">
			<div class="container-fluid px-4">
			<div class="container-fluid px-4">
			<div class="container-fluid px-4">
			<div class="container-fluid px-4">
			<div class="container-fluid px-4">
			<div class="container-fluid px-4">
			<div class="container-fluid px-4">
				<input type="submit" name="addSiteSubmit" value="Add Site" class="btn btn-m btn-primary btn-block" />
				<button type="reset" name="editSiteReset" value="Reset" class="btn btn-success">Reset</button>
			</div>
			
		</form>
		</div>
      </main>
	  </br>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2021</div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="js/scripts.js"></script>
</body>

</html>