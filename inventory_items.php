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
	
<h1 align="center">Inventory</h1>
<div class="container" align="center">
<a href="inventory_items.php" class="button">Items</a>
<a href="inventory_transactions.php" class="button">Transactions</a>
</div>


<div class="container">
	<br>
	<div class="row">
		<div class="col">
			<table>
				<h3 align="center">User1</h3>
				<th>Item</th>
				<th width="20%">Amount</th>
				
				<?php
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
				
				$sql = "SELECT clismate_id, temperature, humidity, climate_time FROM climate ORDER BY climate_time DESC";
				//$sql = "SELECT climate_id, temperature, humidity, climate_time FROM climate ORDER BY climate_time DESC WHERE timestamp BETWEEN DATEADD(HOUR, 0, DATEDIFF(d, 0, GETDATE())) AND DATEADD(HOUR, 24, DATEDIFF(d, 0, GETDATE()))";

				$result = $conn->query($sql);
		
				if ($result->num_rows > 0) {
					// output data of each row
					//while() {
						while ($i < 24) {
							$temp_mean = 0;
							$temp_min = 1000;
							$temp_max = -1000;
							while ($j < 6) {
								$row = $result->fetch_assoc();
								// https://stackoverflow.com/questions/53001090/select-data-from-specific-time-frame-in-mysql-and-return-in-php-form
								//$sql = "SELECT climate_id, temperature, humidity, climate_time FROM climate ORDER BY climate_time DESC WHERE climate_time BETWEEN DATEADD(HOUR, ", $i, ", DATEDIFF(d, 0, GETDATE())) AND DATEADD(HOUR, ", $i + 1, ", DATEDIFF(d, 0, GETDATE()))";
								//$result = $conn->query($sql);
								
								$temp_mean = $temp_mean + $row["temperature"];
								if ($temp_min > $row["temperature"]) {
									$temp_min = $row["temperature"];
								}
								if ($temp_max < $row["temperature"]) {
									$temp_max = $row["temperature"];
								}
								
								$j = $j + 1;
							}
							$temp_mean = $temp_mean / 6;
							$j = 0;

							echo "<tr>";
							echo "<td>", $temp_mean, "</td>";
							echo "<td>", $temp_min, "</td>";
							echo "<td>", $temp_max, "</td>";
							echo "<td>", $row["climate_time"], "</td>";
							echo "</tr>";
							
							$i = $i + 1;
						}
					//}
				}
				
				else {
					echo "<tr><td align='center' colspan='3'>0 results</td></tr>";
				}
		
				$conn->close();
				?>
			</table>
		</div>
		<div class="col">
				<table>
				<h3 align="center">User2</h3>
				<th>Item</th>
				<th width="20%">Amount</th>
				
				<?php
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
				
				$sql = "SELECT clismate_id, temperature, humidity, climate_time FROM climate ORDER BY climate_time DESC";
				//$sql = "SELECT climate_id, temperature, humidity, climate_time FROM climate ORDER BY climate_time DESC WHERE timestamp BETWEEN DATEADD(HOUR, 0, DATEDIFF(d, 0, GETDATE())) AND DATEADD(HOUR, 24, DATEDIFF(d, 0, GETDATE()))";

				$result = $conn->query($sql);
		
				if ($result->num_rows > 0) {
					// output data of each row
					while ($i < 24) {
						$temp_mean = 0;
						$temp_min = 1000;
						$temp_max = -1000;
						while ($j < 6) {
							$row = $result->fetch_assoc();
							// https://stackoverflow.com/questions/53001090/select-data-from-specific-time-frame-in-mysql-and-return-in-php-form
							//$sql = "SELECT climate_id, temperature, humidity, climate_time FROM climate ORDER BY climate_time DESC WHERE climate_time BETWEEN DATEADD(HOUR, ", $i, ", DATEDIFF(d, 0, GETDATE())) AND DATEADD(HOUR, ", $i + 1, ", DATEDIFF(d, 0, GETDATE()))";
							//$result = $conn->query($sql);
							
							$temp_mean = $temp_mean + $row["temperature"];
							if ($temp_min > $row["temperature"]) {
								$temp_min = $row["temperature"];
							}
							if ($temp_max < $row["temperature"]) {
								$temp_max = $row["temperature"];
							}
							
							$j = $j + 1;
						}
						$temp_mean = $temp_mean / 6;
						$j = 0;

						echo "<tr>";
						echo "<td>", $temp_mean, "</td>";
						echo "<td>", $temp_min, "</td>";
						echo "<td>", $temp_max, "</td>";
						echo "<td>", $row["climate_time"], "</td>";
						echo "</tr>";
						
						$i = $i + 1;
					}
				}
				
				else {
					echo "<tr><td align='center' colspan='3'>0 results</td></tr>";
				}
		
				$conn->close();
				?>
			</table>
		</div>		
	</div>
</div>



</body>
</html>
