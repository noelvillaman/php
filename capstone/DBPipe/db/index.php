<?php 
session_start();
?>

<?php
		$dbhost = 'oniddb.cws.oregonstate.edu';
		$dbname = 'villaman-db';
		$dbuser = 'villaman-db';
		$dbpass = 'TC5rjvNkcA4r1DXt';
		
		$dsn = "mysql:host=".$dbhost.";dbname=".$dbname;
	
	try {
		$conn = new PDO($dsn, $dbuser, $dbpass);
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		//echo '<h3>Successfully connected to '.$dbuser.'</h3>';
		} catch ( PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}
         $result = $conn->query("SHOW TABLES");
            while ($row = $result->fetch(PDO::FETCH_NUM)) {
            	echo $row[0]."<br>";
				echoTableFromResults($conn->query('select * from '.$row[0]));
            }
			
	//$conn = null;
	
	//Funtion produced by Charles Catino
		
		function echoTableFromResults($result) {
		$cols = $result->columnCount();
		for ($i = 0; $i < $cols; $i++) {
		  $meta_arr = $result->getColumnMeta($i);
			echo "<input type='checkbox' name='results' class='right_tables'> " . $meta_arr["name"] . "<br />";
		}

	}
 ?>
