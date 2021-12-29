function testEmailAddress(email) 
{
	if (email == "") 
	{
		return false;
	}
	
	var atPos = email.indexOf("@",1);// make sure that email contains an "@" symbol
	if (atPos == -1) 
	{
		return false;
	}
	
	if (email.indexOf("@",atPos+1) != -1) 
	{	// make sure that the email contains only one "@" symbol
		return false;
	}
	
	var periodPos = email.indexOf(".",atPos);
	if (periodPos == -1) 
	{					// and at least one "." after the "@"
		return false;
	}
	if (periodPos+3 > email.length)	
	{		// must be at least 2 characters after the "."
		return false;
	}
			
	return true;
}

function validateForm(formData)
{
	var Fname=formData.firstName.value;
	var Lname=formData.lastName.value;
	var username=formData.Username.value;
	var emailaddress= formData.emailaddress.value;
	var password=formData.password.value;
	var month=formData.month.value;
	var date=formData.date.value;
	var year=formData.year.value;
	var gender = "";
	gender = formData.gender.value;
	
	var errorCount = 0;

	if(Fname == "" || Fname == null)
	{
		errorCount++;
		document.getElementById("errorFN").innerHTML="Please enter your first name";
	}
	else
	{
		document.getElementById("errorFN").innerHTML="";
	}
	
	if(Lname == "" || Lname == null)
	{
		errorCount++;
		document.getElementById("errorLN").innerHTML="Please enter your last name";
	}
	else
	{
		document.getElementById("errorLN").innerHTML="";
	}

	if(username == "" || username == null)
	{
		errorCount++;
		document.getElementById("errorUsername").innerHTML="Please enter your username";
	}
	else
	{
		document.getElementById("errorUsername").innerHTML="";
	}

	if(testEmailAddress(emailaddress) == false)
	{
		errorCount++;
		document.getElementById("errorEmail").innerHTML="Please enter your email address";
	}
	else
	{
		document.getElementById("errorEmail").innerHTML="";
	}

	if(password == "" || password == null)
	{
		errorCount++;
		document.getElementById("errorPassword").innerHTML="Please enter your Password";
	}
	else
	{
		document.getElementById("errorPassword").innerHTML="";
	}
	
	if(gender == "" || gender == null)
	{
		errorCount++;
		document.getElementById("errorGender").innerHTML="Please select your gender";
	}
	else
	{
		document.getElementById("errorGender").innerHTML="";
	}

	if(month == "" || month == null)
	{
		errorCount++;
		document.getElementById("errorMonth").innerHTML="Please select the month you were born";
	}
	else
	{
		document.getElementById("errorMonth").innerHTML="";
	}
	
	
	if(date == "" || date == null)
	{
		errorCount++;
		document.getElementById("errorDate").innerHTML="Please select the day you were born";
	}
	else
	{
		document.getElementById("errorDate").innerHTML="";
	}

	if(year == "" || year == null)
	{
		errorCount++;
		document.getElementById("errorYear").innerHTML="Please select the year you were born";
	}
	else
	{
		document.getElementById("errorYear").innerHTML="";
	}

	if(errorCount != 0)
	{
	return false;
	}
	else
{
		return true;
	}
}





