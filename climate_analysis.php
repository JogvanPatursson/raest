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
	<script>

	window.onload = function () {
	
	var chart = new CanvasJS.Chart("curve_chart", {
		animationEnabled: true,
		theme: "light1",
		title:{
			text: "Simple Line Chart"
		},
		data: [{        
			type: "line",
	      	indexLabelFontSize: 16,
	      	markerSize: 15,
			dataPoints: [
				for(i = 0; i < my_2d.length; i++){
					data.addRow([my_2d[i][0], parseInt(my_2d[i][1]),parseInt(my_2d[i][2]),parseInt(my_2d[i][3]),parseInt(my_2d[i][4]),parseInt(my_2d[i][5])]);
				}
			]
		}]
	});
	chart.render();
	
	}
	</script>
</head>



<body>
	
<h1 align="center">Climate</h1>
<div class="container" align="center">
<a href="climate_analysis.php" class="button">Analysis</a>
<a href="climate_raw.php" class="button">Raw</a>
</div>


<div class="container">
	<br>
	<div class="row">
		<div class="col">
			<table>
				<th>Temp Mean °C</th>
				<th>Temp Min °C</th>
				<th>Temp Max °C</th>
				<th>Time</th>
				
				<?php
				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
				
				$sql = "SELECT climate_id, temperature, humidity, climate_time FROM climate ORDER BY climate_time DESC";
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
					echo "0 results";
				}
		
				$conn->close();
				?>
			</table>
		</div>
		
		<?php
		// https://www.plus2net.com/php_tutorial/chart-line-database.php
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = "SELECT climate_id, temperature, humidity, climate_time FROM climate ORDER BY climate_time DESC";

		
		if ($result->num_rows > 0) {
			$php_data_array = Array(); // create PHP array
			while ($i < 24) {
				$temp_mean = 0;
				$temp_min = 1000;
				$temp_max = -1000;
				while ($j < 6) {
					$row = $result->fetch_assoc();
					
					$temp_mean = $temp_mean + $row["temperature"];
					}
					$j = $j + 1;
				}
				$temp_mean = $temp_mean / 6;
				$j = 0;						
				$i = $i + 1;
				
				$php_data_array[] = $row; // Adding to array
		}
		
		echo "<script> var my_2d = ".json_encode($php_data_array)."</script>";

		$conn->close();			
		?>
		
		<div id="curve_chart" class="col" width="100%" height="100%" style="border:1px solid #000;"></div>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	</div>
</div>



</body>
</html>
