<?php
	include("services/security.php");
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
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
            <a class="navbar-brand ps-3" href="coordinatorHome.php">Planet Warriors</a>
            
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
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

                          <a class="nav-link" href="volunteerList.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            View Volunteer List
                          </a>

                          <a class="nav-link" href="addVolunteer.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Add Volunteer
                          </a>

                          <a class="nav-link" href="editVolunteer.php">
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
		<br/>
		<br/>
      <main>
       <div class="container-fluid px-4">
	   <ol class="breadcrumb animate-box">
			<li class="breadcrumb-item underline"><a href="coordinatorHome.php">Home</a></li>
			<li class="breadcrumb-item underline"><a href="siteList.php">Volunteered Site List</a></li>
		</ol>
		
		<h1>Volunteered Sites List</h1>
<?php
			//include the database connection 
			include("services/databaseConnection.php");
			
		
			if($stmt=mysqli_prepare($mysqli, "SELECT volunteeredSitesID, volunteerID, siteID FROM volunteeredSites")) 
			{
				//execute the query"
				mysqli_stmt_execute($stmt);
				
				//bind results
				mysqli_stmt_bind_result($stmt, $vsd, $vid, $sid);
				
				//print out the values from the dba_close
				while(mysqli_stmt_fetch($stmt))
				{
					echo("<div class='row' >");
					echo("<div class='col-lg-4 mb-4'>");
					echo("<div class='card-body'>");
					echo("<div class='card h-100'>");
					echo("<div class='card-header'>");
					echo("<label>Volunteer Site ID: </label> ".$vsd."<br /> <br />");		
					
				//include 2nd database connection
				include("services/databaseConnection3.php");
				
				if($secondQuery = mysqli_prepare($newConnection, "SELECT siteName FROM Site WHERE siteID = ?"))
				{
					mysqli_stmt_bind_param($secondQuery, "i", $sid);
					
					mysqli_stmt_execute($secondQuery);
					
					mysqli_stmt_bind_result($secondQuery, $siteName);
					
					if(mysqli_stmt_fetch($secondQuery))
					{
						echo("<p> <label> Site Name: </label>".$siteName."</p>");
					}
					mysqli_stmt_close($secondQuery);
					
				}
				mysqli_close($newConnection);
				
				include("services/databaseConnection3.php");
				
				if($secondQuery = mysqli_prepare($newConnection, "SELECT firstName, lastName FROM Volunteer WHERE volunteerID = ?"))
				{
					mysqli_stmt_bind_param($secondQuery, "i", $vid);
					
					mysqli_stmt_execute($secondQuery);
					
					mysqli_stmt_bind_result($secondQuery, $firstName, $lastName);
					
					if(mysqli_stmt_fetch($secondQuery))
					{
						echo("<p> <label> Name:  </label>".$firstName." ".$lastName."</p>");
					}
					mysqli_stmt_close($secondQuery);
				}
				mysqli_close($newConnection);
				
			echo('<a href="viewVolunteeredSitesDetails.php?volunteeredSitesID='.$vsd.'"" class="card-link btn btn-primary">View Site to Clean Details</a>');
			 echo('</div>');
			 echo('</div>');
			 echo('</div>');
			 echo('</div>');
			 echo('</div>');
     }
	}
		?>
       </div>
      </main>
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