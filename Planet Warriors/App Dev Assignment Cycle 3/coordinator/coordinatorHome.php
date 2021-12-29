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
                          <!-- TODO change to the Actual form of Adding volunteers -->

                          <a class="nav-link" href="volunteerList.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            View Volunteer
                          </a>

                          <a class="nav-link" href="addVolunteer.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Add Volunteer
                          </a>

                          <a class="nav-link" href="VolunteerList.php">
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
				  <ol class="breadcrumb animate-box">
				  <li class="breadcrumb-item underline"><a href="coordinatorHome.php">Home</a></li>
				  </ol>
		<h1>Coordinator Homepage</h1>
		<h3>Welcome <?php echo($firstName." ".$lastName)?> </h3>
        <div class="row">
		  <div class="column" style="background: #FFFFFF;">
			   <div class="card-header">View Volunteer List
			   </div>
			   <div class="card-body"><a href="volunteerList.php" class="btn btn-primary">View Volunteer</a>
			   </div>
		  </div>
		  
		  <div class="column" style="background: #FFFFFF;">
		   <div class="card-header">Add Volunteer
			   </div>
			   <div class="card-body"><a href="addVolunteer.php" class="btn btn-primary">Add Volunteer</a>
			   </div>
		</div>
		
		<div class="column" style="background: #FFFFFF;">
		   <div class="card-header">Edit Volunteer
			   </div>
			   <div class="card-body"><a href="volunteerList.php" class="btn btn-primary">Edit Volunteer</a>
			   </div>
		</div>
		
		<div class="column" style="background: #FFFFFF;">
		   <div class="card-header">Search Volunteer
			   </div>
			   <div class="card-body"><a href="volunteerSearch.php" class="btn btn-primary">Search Volunteer</a>
			   </div>
		</div>
		
		<div class="column" style="background: #FFFFFF;">
		   <div class="card-header">View Site List
			   </div>
			   <div class="card-body"><a href="siteList.php" class="btn btn-primary">View Site List</a>
			   </div>
		</div>
		
		<div class="column" style="background: #FFFFFF;">
		   <div class="card-header">Search Site
			   </div>
			   <div class="card-body"><a href="siteSearch.php" class="btn btn-primary">Search Site</a>
			   </div>
		</div>
		
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
