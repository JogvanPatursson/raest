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

	</style>
</head>
<body>
	
<h1 align="center">Climate</h1>
<div class="container" align="center">
<a href="climate_analysis.php" class="button">Analysis</a>
<a href="climate_raw.php" class="button">Raw</a>
<!--<button class="button" type="button" style="width: 40%">Analysis</button>-->
<!--<button class="button" type="button" style="width: 40%">Raw</button>-->
</div>
<div class="container">
	<br>
	<table>
	<th>Temperature</th>
	<th>Humidity</th>
	<th>Time</th>
	<?php
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT climate_id, temperature, humidity, climate_time FROM climate ORDER BY climate_time DESC";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>", $row["temperature"], "°", "</td>";
			echo "<td>", $row["humidity"], "%", "</td>";
			echo "<td>", $row["climate_time"], "</td>";
			echo "</tr>";
			}
		} 
	else {
		echo "0 results";
	}

	$conn->close();
	?>
</table>
</div>

</body>
</html>
