<?php
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
   $sql = "SELECT * FROM club";
	
   $query = $dbhandle->prepare($sql);

   if ( $query->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results = $query->fetchAll();
	
   // Printing out the details of each club
?>
   <h2>Details of all clubs</h2>

<?php		
   foreach ($results as $row) {
      echo "<p>".$row['cid'].": ".$row['name']." (".$row['venue'].")</p>";
   }   
?>		