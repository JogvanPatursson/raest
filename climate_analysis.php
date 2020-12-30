<?php
include_once ('header.php');
include_once ('connect.php');

$sql = "SELECT temperature, climate_time FROM climate ORDER BY climate_time DESC";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $temp_array = array(); // create PHP array
    $time_array = array(); // create PHP array
    $p = 0;
    while ($p < 24) {
        $temp_mean = 0;
        while ($q < 6) {
            $row = $result->fetch_assoc();
            $temp_mean = $temp_mean + $row["temperature"];
            $q = $q + 1;
        }
        $q = 0;
        $p = $p + 1;

        $temp_mean = $temp_mean / 6;
        $temp_array[] = $temp_mean;

        $time = DateTime::createFromFormat('Y-m-d H:i:s', $row['climate_time']);
        $time_array[] = $time->format('H:i');
    }


}

$dataPoints = array(
    array("y" => $temp_array[23], "label" => "$time_array[23]"),
    array("y" => $temp_array[22], "label" => "$time_array[22]"),
    array("y" => $temp_array[21], "label" => "$time_array[21]"),
    array("y" => $temp_array[20], "label" => "$time_array[20]"),
    array("y" => $temp_array[19], "label" => "$time_array[19]"),
    array("y" => $temp_array[18], "label" => "$time_array[18]"),
    array("y" => $temp_array[17], "label" => "$time_array[17]"),
    array("y" => $temp_array[16], "label" => "$time_array[16]"),
    array("y" => $temp_array[15], "label" => "$time_array[15]"),
    array("y" => $temp_array[14], "label" => "$time_array[14]"),
    array("y" => $temp_array[13], "label" => "$time_array[13]"),
    array("y" => $temp_array[12], "label" => "$time_array[12]"),
    array("y" => $temp_array[11], "label" => "$time_array[11]"),
    array("y" => $temp_array[10], "label" => "$time_array[10]"),
    array("y" => $temp_array[9], "label" => "$time_array[9]"),
    array("y" => $temp_array[8], "label" => "$time_array[8]"),
    array("y" => $temp_array[7], "label" => "$time_array[7]"),
    array("y" => $temp_array[6], "label" => "$time_array[6]"),
    array("y" => $temp_array[5], "label" => "$time_array[5]"),
    array("y" => $temp_array[4], "label" => "$time_array[4]"),
    array("y" => $temp_array[3], "label" => "$time_array[3]"),
    array("y" => $temp_array[2], "label" => "$time_array[2]"),
    array("y" => $temp_array[1], "label" => "$time_array[1]"),
    array("y" => $temp_array[0], "label" => "$time_array[0]")
);

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
		font-size: 18px;
	}

	</style>
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                axisY: {
                    title: "Temperature °C"
                },
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
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
			<table>
				<th>Temp Mean °C</th>
				<th>Temp Min °C</th>
				<th>Temp Max °C</th>
				<th>Time</th>

				<?php

				
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
</div>
<br>
<div id="chartContainer" class="container-fluid" style="width: 68%"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<br>


</body>
</html>
