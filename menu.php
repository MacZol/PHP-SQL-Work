<?php
	// Starts session and checks if the user is logged in
session_start();
if (isset($_SESSION['loggedin'])){
echo <<<_END

<head>
	<!-- Title and link to style.css document -->
	
	<title>Menu</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<!-- Logout -->
	
	<div id="logoutlink">
	You are logged in | <a href="logout.php">Logout</a>
	</div>

	<!-- Headings -->
<h2>Assesment 4</h2>
<h3>PHP & MySQL</h3>

	<!-- Buttons -->
<a href="task1.php"><button type="button">Task 1</button></a>

<a href="task2.php"><button type="button">Task 2</button></a>

<a href="task3.php"><button type="button">Task 3</button></a>
     
</body>

_END;
} 

else
	// If user is not logged in then it will return them to loginform.html
{
	header("Location: loginform.html");
}
?>	