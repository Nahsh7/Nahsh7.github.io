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
    <a class="navbar-brand ps-3" href="coordinatorHome.php">Planet Warriors</a>

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
						  <a class="nav-link" href="volunteerList.php">
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
						  <a class="nav-link active" href="siteSearch.php">
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
			<li class="breadcrumb-item underline"><a href="siteSearch.php">Site Search</a></li>
		</ol>
	   
	    <div class="row justify-content-around">
     <div class="col-lg-8 col-md-12 mb-4">
       <h1 class="m-0 text-dark center"> Search For a Site Available for Cleaning </h1>
       <form name ="siteSearchBox" action="siteSearch.php" method="post">
         <fieldset class="labels">
           <br>
           <div class="row">
             <h5> Please enter a Site's Name </h5>
             <input type="text" name="siteSearchBox" value="" placeholder="Enter Name" class="form-control" />

           </div>
           <br>
         <div class="row justify-content-center">
           <div class="col-md-2 mb-4">
            <button type="submit" name="siteSearchSubmit" value="search" class="btn btn-primary" id="btnSearch" type="button"><i class="fas fa-search"></i> <a href="siteSearch.php" </button></a>
           </div>
         </div>
       </form>
     </div>
   </div>
		<?php
			//determine if the submit button was pressed
			if(isset($_POST["siteSearchSubmit"]))
			{
				//get the search criteria that the user entered
				$criteria = trim($_POST["siteSearchBox"]);
			
				//do some validation
				if($criteria == "" || $criteria == null )
				{
					echo("Invalid Criteria Entered");
				}
				else{
				//sanatize the data
				$criteria = filter_var($criteria, FILTER_SANITIZE_STRING);
				
				//include the database connection 
				include("services/databaseConnection.php");
			
				$preparedCriteria = "%".$criteria."%";
			
				//write a query to retrieve the necessary details from the customer table
				if($stmt=mysqli_prepare($mysqli, "SELECT DISTINCT siteID, siteName, generalDescription, imageName FROM Site WHERE siteName LIKE ?")) 
				{
				
				//bind param to markers
				mysqli_stmt_bind_param($stmt, "s", $preparedCriteria);
				//execute the query
				mysqli_stmt_execute($stmt);
				
				//store result
				mysqli_stmt_store_result($stmt);
				
				
				//get the number of rows
				$numRows = mysqli_stmt_num_rows($stmt);
				echo("Search returned $numRows for the criteria '$criteria'.");
				//bind results
				mysqli_stmt_bind_result($stmt, $sid, $sn, $gd, $in);
				
				//print out the values from the dba_close
				while(mysqli_stmt_fetch($stmt))
				{
					echo("<div class='row' >");
					echo("<div class='col-lg-4 mb-4'>");
					echo("<div class='card-body'>");
					echo("<div class='card h-100'>");
					echo("<div class ='card-header'> <label>Site Name: </label> ".$sn."<br /> <br />");
					echo("<img src='images/".$in."'title='".$sid." ".$gd."'style =' height: 150px; width: 150px;' /> <br /> <class='card-header'> <br />");
					echo("<label>Site ID: </label> ".$sid."<br />");				
					echo("<label>General Description: </label> ".$gd."<br /> <br />");
					echo("<a href='SViewSiteDetails.php?id=".$sid."' class='btn btn-primary' >View Site Details</a>"); 
					echo ("</div>");					
					echo ("</div>");					
					echo ("</div>");						
					echo ("</div>");					
					echo ("</div>");
					echo("<br /><br />");
					
					
					}
				}				
				
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