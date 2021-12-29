<?php
	include("services/security.php");
	
	//get the surveyorID of the user that is logged in from the session
	$coordinatorID = $_SESSION["coordinatorID"];
	
	  function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
	
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
	
	
	//set up values
		$emailValue = "";						
		$DoBValue = "";	
		
	//determine if the user has clicked the submit button
	if(isset($_POST['addVolunteerSubmit']))
	{
		//getting the values from the form
		$firstName = trim($_POST['firstName']);		
		$lastName = trim($_POST['lastName']);		
		$nationalID = trim($_POST['nationalID']);		
		$phoneNo = trim($_POST['phoneNo']);
		$email = trim($_POST['email']);					
		$address= trim($_POST['address']);			
		$DoB = trim($_POST['DOB']);		
		
		
    $gender = "";
    if(isset($_POST['gender']))
    {
      $gender = trim($_POST['gender']);
    }

		
		//validation
		$errorCounter = 0;
		//validate siteName
		if($firstName =="" || $firstName == null)
		{
			$errorCounter++;
			$error1 = "You must enter a first name"; 
		}
		
		if($lastName =="" || $lastName == null)
		{
			$errorCounter++;
			$error2 = "You must enter a last name";
		}		
		if($nationalID =="" || $nationalID == null)
		{
			$errorCounter++;
			$error3 = "You must enter a national ID number";
		}
		else
		{
		$nationalID1 = filter_var($nationalID, FILTER_SANITIZE_STRING);
				
		include("services/databaseConnection.php");
				
		if($stmt=mysqli_prepare($mysqli, "SELECT * FROM Volunteer WHERE nationalID = ?"))
		{
			mysqli_stmt_bind_param($stmt, "s", $nationalID1);
					
			mysqli_stmt_execute($stmt);
					
			mysqli_stmt_store_result($stmt);
					
			$numRows= mysqli_stmt_num_rows($stmt);
					
				if($numRows != 0)
				{
						$errorCounter++;
						$error1 = "This national ID already exists";
				}
					
			mysqli_stmt_close($stmt);
		}
			mysqli_close($mysqli);
		}			
		if($phoneNo =="" || $phoneNo == null)
		{
			$errorCounter++;
			$error4 = "You must enter a Phone Number";
		}	
		else
		{
		$phoneNo1 = filter_var($phoneNo, FILTER_SANITIZE_STRING);
				
		include("services/databaseConnection.php");
				
		if($stmt=mysqli_prepare($mysqli, "SELECT * FROM Volunteer WHERE phoneNo = ?"))
		{
			mysqli_stmt_bind_param($stmt, "s", $phoneNo1);
					
			mysqli_stmt_execute($stmt);
					
			mysqli_stmt_store_result($stmt);
					
			$numRows= mysqli_stmt_num_rows($stmt);
					
				if($numRows != 0)
				{
						$errorCounter++;
						$error1 = "This phone number already exists";
				}
					
			mysqli_stmt_close($stmt);
		}
			mysqli_close($mysqli);
		}			

		if($email =="" || $email == null)
		{
			$errorCounter++;
			$error5 = "You must enter an email address ";
		}
    else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
      $errorCounter++;
      $error5 = "You must enter a valid email address";
      $emailValue = $email;
    }
    else
    {
      //sanitization
      $email1 = filter_var($email,FILTER_SANITIZE_STRING);
      $email1 = filter_var($email1,FILTER_SANITIZE_EMAIL);

      //include the database connection
      include("services/databaseConnection.php");

      //write a query that tries to find a customer with the same email address
      if($stmt=mysqli_prepare($mysqli,"SELECT * FROM Customer WHERE email = ?"))
      {
        //bind the parameter to the marker
        mysqli_stmt_bind_param($stmt, "s", $email1);

        //execute the query
        mysqli_stmt_execute($stmt);

        //store the result
        mysqli_stmt_store_result($stmt);

        //get the number of rows
        $numRows = mysqli_stmt_num_rows($stmt);

        //check to see if there were ant matches
        if($numRows != 0)
        {
          $errorCounter++;
          $error5 = "The email address already exists";
          $emailValue = $email;
        }
        //close the statements
        mysqli_stmt_close($stmt);
      }
      //close the connection
      mysqli_close($mysqli);
    }
		
		if($address =="" || $address == null)
		{
			$errorCounter++;
			$error6 = "You must enter an address";
		}		
		if($gender =="" || $gender == null)
		{
			$errorCounter++;
			$error7 = "You must select a gender";
		}
		if($DoB =="" || $DoB == null)
		{
			$errorCounter++;
			$error8 = "You must enter a date of birth";
		}
    else if(validateDate($DoB) == false)    
    {
           
     $errorCounter++;
     $error8= "You must enter a valid date of birth (Format: YYYY-MM-DD)";
     $DoBValue = $DoB;
     }
     else
     {
      $DoBValue = $DoB;
     }		
		
		//store the data-bs-toggle
		
		if($errorCounter == 0)
		{
			//sanitize the data
			$firstName = filter_var($firstName, FILTER_SANITIZE_STRING);			
			$lastName = filter_var($lastName, FILTER_SANITIZE_STRING);			
			$nationalID = filter_var($nationalID, FILTER_SANITIZE_STRING);			
			$phoneNo = filter_var($phoneNo, FILTER_SANITIZE_STRING);			
			$email = filter_var($email, FILTER_SANITIZE_STRING);			
			$address = filter_var($address, FILTER_SANITIZE_STRING);			
			$gender = filter_var($gender, FILTER_SANITIZE_STRING);			
			$DoB = filter_var($DoB, FILTER_SANITIZE_STRING);			$imageName = filter_var($imageName, FILTER_SANITIZE_STRING);					
			
			//include the database connection
			include("services/databaseConnection.php");
			
			//write an insert query to store the data in the database
			if($stmt = mysqli_prepare($mysqli,"INSERT INTO Volunteer(firstName, lastName, imageName, nationalID, phoneNo, email, address, gender, DoB, coordinatorID) VALUES (?,?,?,?,?,?,?,?,?,?)"))
			{
				//bind the parameters for the markers
				mysqli_stmt_bind_param($stmt, "sssssssssi",$firstName, $lastName, $imageName, $nationalID, $phoneNo, $email, $address, $gender, $DoB, $coordinatorID);
				
				//execute the query or die with an error message
				mysqli_stmt_execute($stmt) or die(mysqli_error($mysqli));
				
				//close the statement
				mysqli_stmt_close($stmt);
			}
			//close the connection
			mysqli_close($mysqli);
		
		include("services/databaseConnection.php");
		
		//write a query to retrieve the volunteerID
		$volunteerID = 0;
		
		if($stmt = mysqli_prepare($mysqli, "SELECT volunteerID FROM Volunteer WHERE firstName = ?"))
		{
			//bind the param to markers
			mysqli_stmt_bind_param($stmt, "s", $firstName);

			//execute the query
			mysqli_stmt_execute($stmt);
			
			//bind th results
			mysqli_stmt_bind_result($stmt, $volunteerID);
			
			//fetch value
			if(mysqli_stmt_fetch($stmt))
			{
				$volunteerID = $volunteerID;
			}
			//close statement
			mysqli_stmt_close($stmt);
		}
		//close the connection
		mysqli_close($mysqli);
		
		
		
			//send the user to the add volunteer success page 
			Header("Location: addVolunteerSuccess.php?volunteerID=$volunteerID");
			
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

                          <a class="nav-link active" href="addVolunteer.php">
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
      <main>
			</br>
			 <div class="container-fluid px-4">
			<ol class="breadcrumb animate-box">
			<li class="breadcrumb-item underline"><a href="coordinatorHome.php">Home</a></li>
			<li class="breadcrumb-item underline"><a href="addVolunteer.php">Add Volunteer</a></li>
			</ol>
			
			<h1> Add Volunteer Form </h1>
			<form method="post" action="addVolunteer.php" name="addVolunteerForm">
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="firstName">First Name:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="firstName" class="form-control" name="firstName" value="" />
			</div>
			<span><?php echo($error1); ?> </span>
			</div>
			
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="lastName">Last Name:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="lastName" class="form-control" name="lastName" value="" />
			</div>
			<span><?php echo($error2); ?> </span>
			</div>
			
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="nationalID">National ID Number:
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="nationalID" class="form-control" name="nationalID" value="" />
			</div>
			<span><?php echo($error3); ?> </span>
			</div>
			

			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="phoneNo">Phone No:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="phoneNo" class="form-control" name="phoneNo" value="" />
			</div>
			<span><?php echo($error4); ?> </span>
			</div>
			
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="email" class="form-control" name="email" value="" />
			</div>
			<span><?php echo($error5); ?> </span>
			</div>

			
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="address">Address:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" name="address" class="form-control" name="address" value="" />
			</div>
			<span><?php echo($error6); ?> </span>
			</div>
			
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="gender">Gender:<span class="required">*</span>
			</label>
			Male: <input type="radio" name="gender" value="Male" />
			Female: <input type="radio" name="gender" value="Female" />
			<span><?php echo($error7); ?> </span>
			<br />
			<br />			
			
			<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="DOB">Date of Birth:<span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
			<input type="text" class="form-control" name="DOB" value="<?php echo($DoBValue); ?>" />
			</div>
			<span><?php echo($error8); ?> </span>	
			</div>
			<br />
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
				<input type="submit" name="addVolunteerSubmit" value="Add Volunteer" class="btn btn-m btn-primary btn-block" />
				<button type="reset" name="editSiteReset" value="Reset" class="btn btn-success">Reset</button>
			</div>
			</br>
			
		</form>
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