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
	var password= formData.password.value;
	var emailaddress= formData.emailaddress.value;
	
	var errorCount = 0;
	if(password == "" || password == null)
	{
		errorCount++;
		document.getElementById("errorPassword").innerHTML="Please enter your password";
	}
	else
	{
		document.getElementById("errorPassword").innerHTML="";
	}
	
	
	if(testEmailAddress(emailaddress) == false)
	{
		errorCount++;
		document.getElementById("errorEmail").innerHTML="Please enter your email address";
	}
	else{
		document.getElementById("errorEmail").innerHTML="";
	}
	
	
	if(errorCount != 0)
	{
	return false;
	}
	else{
		return true;
	}
}





