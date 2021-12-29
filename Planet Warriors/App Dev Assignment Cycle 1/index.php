<?php
	session_start();
	$error1 ="";
	$error2 ="";
	
	// determine if submit button was pressed
	if(isset($_POST["loginSubmit"]))
	{
		//get values from the form
		$username =trim($_POST["username"]);
		$password =trim($_POST["password"]);
		
		//do validation
		$errorCount =0;
		
		//validate username
		if($username == "" || $username == null)
		{
			$errorCount++;
			$error1 = "Please enter a username";
			
		}
		
		//validate password
		if($password == "" || $password == null)
		{
			$errorCount++;
			$error2 = "Please enter a password";
			
		}
		else if(strlen($password)< 8)
		{
			$errorCount++;
			$error2 = "Password must be 8 characters or more";
		}
		
		//include the database collection
		include("services/databaseConnection.php");
		
		//sanitize data
		$username = filter_var($username, FILTER_SANITIZE_STRING);
		$password = filter_var($password, FILTER_SANITIZE_STRING);
		
		//checking the database to see if the credentials exist
		if($stmt = mysqli_prepare($mysqli,"SELECT surveyorID, firstName,lastName, position FROM Surveyor WHERE username = ? AND password = ?"))
			
		{
			//bind values to the markers
			mysqli_stmt_bind_param($stmt,"ss",$username,$password); 
			
			//execute the query
			mysqli_stmt_execute($stmt);
			
			//store result
			mysqli_stmt_store_result($stmt);
			
			//get the number of rows
			$numRows = mysqli_stmt_num_rows($stmt);
			
			//echo($numRows);
			//did not match
			
			if($numRows ==0)
			{
				$error1 = "Invalid Username or Password";
				$error2 = "Invalid Username or Password";
			}
			//has a match
			else if($numRows ==1)
			{
				//specify some markers to retrieve the data(give the columns some names)
				mysqli_stmt_bind_result($stmt, $sid, $fn, $ln, $pos);
				
				//set up variables to store the values from the database
				$surveyorID = "";
				$firstName = "";
				$lastName = "";
				$position = "";
				
				//retrieve the values from the result set and save them as the variables
				if(mysqli_stmt_fetch($stmt))
				{
					$surveyorID = $sid;
					$firstName = $fn;
					$lastName = $ln;
					$position = $pos;
				}
				
				
				//store the values in the session
				$_SESSION['surveyorID'] = $surveyorID;
				$_SESSION['firstName'] = $firstName;
				$_SESSION['lastName'] = $lastName;
				$_SESSION['position'] = $posiiton;
				
				//determine where to send the user
				if($position == "surveyor")
				{
					//send to the CSR home page(a homepage not made yet)
					Header("Location: surveyor/surveyorHome.php");
				}
				
				
				
				
			}
			
			
		}
		if($stmt = mysqli_prepare($mysqli,"SELECT coordinatorID, firstName,lastName, position FROM Coordinator WHERE username = ? AND password = ?"))
		{
			//bind values to the markers
			mysqli_stmt_bind_param($stmt,"ss",$username,$password); 
			
			//execute the query
			mysqli_stmt_execute($stmt);
			
			//store result
			mysqli_stmt_store_result($stmt);
			
			//get the number of rows
			$numRows = mysqli_stmt_num_rows($stmt);
			
			//echo($numRows);
			//did not match
			
			if($numRows ==0)
			{
				$error1 = "Invalid Username or Password";
				$error2 = "Invalid Username or Password";
			}
			//has a match
			else if($numRows ==1)
			{
				//specify some markers to retrieve the data(give the columns some names)
				mysqli_stmt_bind_result($stmt, $cid, $fn, $ln, $pos);
				
				//set up variables to store the values from the database
				$coordinatorID = "";
				$firstName = "";
				$lastName = "";
				$position = "";
				
				//retrieve the values from the result set and save them as the variables
				if(mysqli_stmt_fetch($stmt))
				{
					$coordinatorID = $cid;
					$firstName = $fn;
					$lastName = $ln;
					$position = $pos;
				}
				
				
				//store the values in the session
				$_SESSION['coordinatorID'] = $coordinatorID;
				$_SESSION['firstName'] = $firstName;
				$_SESSION['lastName'] = $lastName;
				$_SESSION['position'] = $posiiton;
				
				//determine where to send the user
				if($position == "coordinator")
				{
					//send to the CSR home page(a homepage not made yet)
					Header("Location: coordinator/coordinatorHome.php");
				}
				
				
				
				
			}
			
			
		}
			
		
		
	}
	
?>

<html>
	<head>
		<title>Login Page</title>
		
		<link rel='stylesheet' type='text/css' href='css/style.css' />
	</head>
	<body>
		<div class ="login">
		<h1> Planet Warriors</h1>
		<p> Please enter your login information </p>
		
		
		
	<form name="loginForm" action="index.php" method="post">
	
	
		
		<br />
		<label> Username: </label>
		<input type="text" name="username" value="" />
		<span><?php echo($error1); ?></span>
		
		<br />
		<br />
		<label> Password: </label>
		<input type="password" name="password" value="" />
		<span><?php echo($error2); ?></span>
		
		<br />
		<br />
		<div>
		
			<input type="submit" name="loginSubmit" value="Login" />
			<input type="reset" name="loginReset" value="Reset" />
			
		
		</div>
		
		
	</form>
		</div>
		
	</body>
</html>
	