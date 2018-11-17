<?php
	// Starts session and checks if the user is logged in
session_start();
if (isset($_SESSION['loggedin'])){
echo <<<_END


<head>
	<!-- Title and link to style.css document -->
	
	<title>Task 1</title>
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
   // Order first by gender then by surname
   $sql = "SELECT * FROM member
   WHERE clubID = 'C02'
   ORDER BY gender, surname";
	
   $query = $dbhandle->prepare($sql);

   if ( $query->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results = $query->fetchAll();
	
   // Printing out the details of each club
?>
   <h2>Details of all clubs</h2>
   
   <table border='2'>
		<tr>
			<th>First Name</th><th> Surname</th><th>DOB</th>
		</tr>

<?php		
   foreach ($results as $row) {
      echo "<tr> <td>".$row['forename']."</td> <td> ".$row['surname']." </td> <td>(".$row['dob'].") </td></tr>";
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