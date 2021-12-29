<?php
	include("services/security.php");
	//get the firstname and the lastname from the session

	//get the volunteerID from the url
  $volunteerID = $_GET["id"];

  //sanitize the value from the url
  $volunteerID = filter_var($volunteerID, FILTER_SANITIZE_STRING);

  //check to see if the value is a number
  if(!is_numeric($volunteerID))
  {
    Header("Location: volunteerList.php");
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
    <a class="navbar-brand ps-3" href="surveyorHome.php">Planet Warriors</a>

    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
        class="fas fa-bars"></i></button>

      <div class="input-group">
      </div>




    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><hr class="dropdown-divider" /></li>
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
                  <div class="sb-sidenav-menu-heading">Volunteer </div>
                  <!-- TODO change to the Actual form of Adding volunteers -->

                  <a class="nav-link active" href="volunteerList.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    View Volunteer List
                  </a>

                  <a class="nav-link" href="addVolunteer.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Add Volunteer
                  </a>

                  <a class="nav-link" href="volunteerList.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Edit Volunteer
                  </a>
                  <a class="nav-link" href="volunteerSearch.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Search Volunteer
                  </a>
				  <a class="nav-link" href="siteList.php">
					<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
					View Site List
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
            <div class="container-fluid px-4">
                <h1 class="mt-4"></h1>
        <div class="container">
  <ol class="breadcrumb animate-box">
  </ol>
</div>
<h1>Volunteer's Details</h1>
<?php
		//include the databse connection
		include("services/databaseConnection.php");

		//write a query to retrieve the necessary details from the volunteer table
		if($stmt = mysqli_prepare($mysqli, "SELECT volunteerID, firstName, lastName, imageName, nationalID, phoneNo, email, address, gender, DoB FROM Volunteer WHERE volunteerID = ?"))
		{
			//bind the param to the marker
			mysqli_stmt_bind_param($stmt, "i", $volunteerID);

			//execute the query
			mysqli_stmt_execute($stmt);

			//bind results
			mysqli_stmt_bind_result($stmt, $vID, $fn, $ln, $in, $nid, $pn, $e, $a, $g, $DoB);

			//print out the values from db
			if(mysqli_stmt_fetch($stmt))
			{
				echo("<label>Volunteer ID:</label> ".$vID."<br>");
				echo("<label>Name:</label> ".$fn." ".$ln."<br>");
				echo("<label>National ID:</label> ".$nid."<br>");
				echo("<label>Phone No:</label> ".$pn."<br>");
				echo("<label>Email:</label> ".$e."<br>");
				echo("<label>Address:</label> ".$a."<br>");
				echo("<label>Gender:</label> ".$g."<br>");
				echo("<label>Date of Birth:</label> ".$DoB."<br>");
				echo("</br>");
				echo("<h2>Sites</h2>");

				include ("services/databaseConnection3.php");
				
				if($secondQuery = mysqli_prepare($newConnection, "SELECT volunteeredSitesID, volunteerID, siteID FROM volunteeredSites WHERE volunteerID = ?" ))
				{
					//bind the param to the marker
					mysqli_stmt_bind_param($secondQuery, "i", $volunteerID);

					
					mysqli_stmt_execute($secondQuery);
					
					mysqli_stmt_bind_result($secondQuery, $vsd, $vid, $sid );
					
					while(mysqli_stmt_fetch($secondQuery))
					{
						echo("</br>");
						echo("</br>");
						include("services/databaseConnection4.php");	
						if($thirdQuery = mysqli_prepare($thirdConnection, "SELECT siteID, siteName, siteGeography, address, generalDescription, accessFee, dateAdded, warden, wardenNo, status, imageName FROM Site WHERE siteID = ?"));
						{
							//bind the param to the marker
							mysqli_stmt_bind_param($thirdQuery, "i", $sid);

							//execute the query
							mysqli_stmt_execute($thirdQuery);

							//bind results
							mysqli_stmt_bind_result($thirdQuery, $sID, $sn, $sg, $a, $gd, $af, $da, $w, $wn, $s, $in);
							
							      //print out the values from db
				while(mysqli_stmt_fetch($thirdQuery))
				{
        echo("<img src='images/".$in."' title='".$sn."'style='height: 250px; width: 250px;'/><br/>");
				echo("</br>");
        echo("<label>Site ID:</label> ".$sID."<br>");
        echo("<label>Site Name:</label> ".$sn."<br>");
        echo("<label>Geography:</label> ".$sg."<br>");
        echo("<label>Address:</label> ".$a."<br>");
				
				}
				mysqli_stmt_close($thirdQuery);
				
					}
					mysqli_close($thirdConnection);
					
					}
					mysqli_stmt_close($secondQuery);
					
				}
				mysqli_close($newConnection);
				
				

			}
			mysqli_stmt_close($stmt);
		} 
		mysqli_close($mysqli);


		//include the link to edit and delete (this can't be accessed by coordinators, only surveyors)
		echo("</br>");
		echo("</br>");
		echo("<a href='assignSite.php?id=$volunteerID'>Assign Site</a>");
		echo("<br />");
		echo("<a href='editVolunteer.php?id=$volunteerID'>Edit Volunteer</a>");
		echo("<br />");
		echo("<a href='challengeDeleteVolunteer.php?id=$volunteerID'>Delete Volunteer</a>");
	?>

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
