<?php
	// Starts session and checks if the user is logged in
session_start();
if (isset($_SESSION['loggedin'])){
echo <<<_END

<head>
	<!-- Title and link to style.css document -->
	
	<title>Task 3</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<!-- Logout -->
	
	<div id="logoutlink">
	You are logged in | <a href="logout.php">Logout</a>
	</div>
_END;

   // Connect to database, and complain if it fails
   try {
      $dbhandle = new PDO('mysql:host=dragon.kent.ac.uk; dbname=co323',
                          'co323', 'pa33word');
   } 
   catch (PDOException $e) {
      // The PDO constructor throws an exception if it fails
      die('Error Connecting to Database: ' . $e->getMessage());
   }

   // Run the SQL query, and print error message if it fails.
   // Selects where to collect the information from
   // Orders by team ID as well for better layout
   $sql = "SELECT * FROM team
   JOIN club
   ON team.clubID = club.cid
   ORDER BY tid";
	
   $query = $dbhandle->prepare($sql);

   if ( $query->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results = $query->fetchAll();
	
   // Printing out the details of each club
?>
   <h2>Team Details</h2>
   
   <!-- Display team details in dropdown menu-->
   <form id='team' name='team' method='get' action='task4.php'>
		<select name='team' id='team'>

<?php		
   foreach ($results as $row) {
      echo " <option value='$row[tid]' > Team ID: $row[tid] | Category : $row[category] | Division: $row[division] | ClubID: $row[clubID] | Venue: $row[venue] </option>";
   }  
echo <<<_END
</select>
	<input id="loginbutton" type="submit" value="submit">
</form>
</body>
_END;
}
else
	// If the user is not logged in, then it takes them to the login form
{
	header("Location: loginform.html");
}
?>

