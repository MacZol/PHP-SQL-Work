<?php
	// Destroys the user's session then takes them back to the login form
	session_start();
	session_destroy();
		 
	header("Location: loginform.html");
?>