<?php
	include_once ('header.php');
	$servername = "localhost";
	$username = "root";
	$password = "raest";
	$dbname = "raest_db";
?>
<!DOCTYPE html>
<html>
<head>
	<title>RAEST Web App</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>

	table, th, td, tr {
		border: 1px solid black;
		text-align: center;
	}
	table {
		width: 100%;
	}
	h2 {
		text-align: center;
	}
	th {
		valign: center;
		height: 30;
		font-size: 18px;
	}
	img {
		width: 100%;
		border: 1px solid #111;
		align: center;
	}
	</style>
</head>
<body>
<h1 align="center">Motion</h1>
<?php
	// Create Connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check Connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	// SQL statement
	$sql = "SELECT motion_time FROM motion ORDER BY motion_time ASC";
	$result = $conn->query($sql);
	
	// Conatiner Begin
	echo "<div class='container-fluid'>";
	
	// Check if table has data
	if ($result->num_rows > 0) {
		
		// output data of each row
		$i = 0;
		while($row = $result->fetch_assoc()) {

			// Row Begin
			if($i % 2 == 0) {
				echo "<div class='row'>";
			}
			// Col Begin
			echo "<div class='col'>";
			
			// Content
			echo "<img src='", $row["motion_time"], ".png'>";
			echo "<p align='center'>", $row["motion_time"], "</p>";
			
			// Col End
			echo "</div>";
			
			// Row End
			if($i % 2 == 1) {
				echo "</div>";
			}
			$i++;
		}
		if($result->num_rows % 2 == 1) {
			echo "<div class='col'></div>";
		}
	}
	else {
		echo "0 results";
	}
	// Container End
	echo "</div>";
	
	// Close Connection
	$conn->close();
?>
</body>
</html>
