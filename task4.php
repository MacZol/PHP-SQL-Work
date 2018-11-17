<?php
	// Starts session and checks if the user is logged in
session_start();
if (isset($_SESSION['loggedin'])){
echo <<<_END

<head>
	<!-- Title and link to style.css document -->
	
	<title>Task 4</title>
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
   $sql = "SELECT * FROM fixture
   WHERE homeTeam = '$_GET[team]' 
   OR awayTeam = '$_GET[team]'";
	
   $query = $dbhandle->prepare($sql);

   if ( $query->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results = $query->fetchAll();
	
   // Printing out the details of each club
?>
   <h2>Details of the selected team</h2>
   
   <table border='2'>
		<tr>
			<th>Home Team</th><th>Away Team</th><th>Date</th><th>Home Team Score</th><th>Away Team Score</th>
		</tr>

<?php		
   foreach ($results as $row) {
      echo " <tr> <td>".$row['homeTeam']."</td> <td>".$row['awayTeam']."</td> <td>".$row['onDate']."</td> <td>".$row['homeTeamScore']."</td> <td>".$row['awayTeamScore']."</td></tr>";
   } 
echo <<<_END
</table>

</body>
_END;
}
else
	// If the user is not logged in, then it takes them to the login form
{
	header("Location: loginform.html");
} 
?>
