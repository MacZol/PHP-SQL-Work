<a href="loginform.html">Back</a><br/>
<link rel="stylesheet" type="text/css" href="style.css">
<?php
	session_start();
	// Username and password details
	$loginUsername = "a3";
	$loginPassword = "testing";
	
	
	// If the user is not logged in, then it takes them to the login form
	if (($_POST['username'] == $loginUsername ) &&
		($_POST['password'] == $loginPassword)) 
	{
		// Sets session variable 'loggedin' to true - Logs the user in and directs to menu.php
		$_SESSION["loggedin"] = "true";
        header("Location: menu.php");
		
    }
	// Else displays error message and returns the user to the previous page
	else
	{
		echo "Wrong username or password";
		
	}
?>