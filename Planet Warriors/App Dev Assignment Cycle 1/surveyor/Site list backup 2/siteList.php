<?php
	include("services/security.php");
	//get the firstname and the lastname from the session
	$firstName = $_SESSION['firstName'];
	$lastName = $_SESSION['lastName'];
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

    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
      <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
          aria-describedby="btnNavbarSearch" />
        <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
      </div>
    </form>

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
            <a class="nav-link" href="surveyorAddLocation.html">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              View Site List
            </a>
            <a class="nav-link" href="surveyorAddLocation.html">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Add Site
            </a>
            <a class="nav-link" href="surveyorEditLocation.html">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Edit Site
            </a>
            <a class="nav-link" href="surveyorEditLocation.html">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Remove Site
            </a>
          </div>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
       <div class="container-fluid px-4">
<?php
			//include the database connection 
			include("services/databaseConnection.php");
			
			//write a query to retrieve the necessary details from the customer table
			if($stmt=mysqli_prepare($mysqli, "SELECT siteID, siteName, generalDescription, imageName FROM Site ORDER BY siteName ASC")) 
			{
				//execute the query"
				mysqli_stmt_execute($stmt);
				
				//bind results
				mysqli_stmt_bind_result($stmt, $sid, $sn, $gd, $in);
				
				//print out the values from the dba_close
				while(mysqli_stmt_fetch($stmt))
				{
               
					echo("<label>Site ID :</label>".$sid."<br />");
					echo("<label>Site Name : </label>".$sn."<br />");
					echo("<a href='viewSiteDetails.php?id=".$sid."'>View Site Details</a>"); 
					echo("<br /><br />");
					
					
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