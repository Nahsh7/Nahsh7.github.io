//reset button functionality
 function resetForm(formData)
{
	document.getElementById("error1").innerHTML = "";
	document.getElementById("error2").innerHTML = "";
	document.getElementById("error3").innerHTML = "";
	document.getElementById("error4").innerHTML = "";
}

//function to check if the email is valid.
function testEmailAddress(yourEmail)
{
	if (yourEmail == "")
	{
		return false;
	}

	var atSign = yourEmail.indexOf("@",1);// make sure that email contains an "@" symbol
	if (atSign == -1)
	{
		return false;
	}

	if (yourEmail.indexOf("@",atSign+1) != -1)
	{	// make sure that the email contains only one "@" symbol
		return false;
	}

	var periodDot = yourEmail.indexOf(".",atSign);
	if (periodDot == -1)
	{					// and at least one "." after the "@"
		return false;
	}
	if (periodDot+3 > yourEmail.length)
	{		// must be at least 2 characters after the "."
		return false;
	}

	return true;
}


//validation function
function validateForm(formData)
{
	//get the values from the form
	var firstName = formData.firstName.value;
	var lastName = formData.lastName.value;
	var yourEmail = formData.yourEmail.value;
	var yourMessage = formData.yourMessage.value;

	//firstName
	var errorCount = 0;
	if(firstName=="" || firstName==null)
	{
		document.getElementById('error1').innerHTML="You must enter a first name";
		errorCount++;
	}
	else
	{
		document.getElementById('error1').innerHTML="";
	}

//lastName
	if(lastName=="" || lastName==null)
	{
		document.getElementById('error2').innerHTML="You must enter a last name ";
		errorCount++;
	}
	else
	{
		document.getElementById('error2').innerHTML="";
	}

	//email
	if(yourEmail=="" || yourEmail==null)
	{
		document.getElementById('error3').innerHTML="Please enter an email address";
		errorCount++;
	}
	else if(testEmailAddress(yourEmail)==false)
	{
		document.getElementById('error3').innerHTML="Please enter a valid email address";
		errorCount++;
	}
	else
	{
		document.getElementById('error3').innerHTML="";
	}

//textArea
	if(yourMessage=="" || yourMessage==null)
	{
		document.getElementById('error4').innerHTML="You must enter a message";
		errorCount++;
	}
	else
	{
		document.getElementById('error4').innerHTML="";
	}

	//do not type after this
	if(errorCount==0)
	{
		return true;
	}
	else
	{
		return false;
	}

}
