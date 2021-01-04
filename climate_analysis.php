<?php
include_once ('header.php');
include_once ('connect.php');

// SQL statemenmt + query
$sql = "SELECT temperature, humidity, climate_time FROM climate ORDER BY climate_time DESC";
$result = $conn->query($sql);

// Check if DB Table contains any rows
if ($result->num_rows > 0) {
    
    // Initialize PHP arrays
    $temp_array = array();
    $humid_array = array();
    $time_array = array();
    
    // Initialize 24 hour variables
    $temp_mean_24 = 0;
    $temp_min_24 = 1000;
    $temp_max_24 = -1000;
    $h_mean_24 = 0;
    $h_min_24 = 1000;
    $h_max_24 = -1000;
    
    // While loop for 24 hours
    while ($p < 24) {
	
        
	// Initialize and flush variables
	$temp_mean = 0;
	$humid_mean = 0;

	// While loop for 6 rows
        while ($q < 6) {
	    
	    // Fetch table row
            $row = $result->fetch_assoc();

	    // Sum temperature and humidity for 1 hour
            $temp_mean = $temp_mean + $row["temperature"];
	    $humid_mean = $humid_mean + $row["humidity"];
	    
	    // Sum temperature and humidity for 24 hour
	    $temp_mean_24 = $temp_mean_24 + $row["temperature"];
	    $h_mean_24 = $h_mean_24 + $row["humidity"];
	    
	    // Find min temp for 24 hours
	    if ($temp_min_24 > $row["temperature"]) {
		$temp_min_24 = $row["temperature"];
	    }
	    
	    // Find max temp for 24 hours
	    if ($temp_max_24 < $row["temperature"]) {
		$temp_max_24 = $row["temperature"];
	    }
	    	    
	    // Find min humidity 24 hour
	    if ($h_min_24 > $row["humidity"]) {
		$h_min_24 = $row["humidity"];
	    }
	    
	    // Find max humidity for 24 hours
	    if ($h_max_24 < $row["humidity"]) {
		$h_max_24 = $row["humidity"];
	    }

            $q = $q + 1;
        }
	
        $q = 0;
        $p = $p + 1;
	
	// Calculate mean of 1 hour temperature and push into array
        $temp_mean = $temp_mean / 6;
        $temp_array[] = $temp_mean;
	
	// Calculate mean of 1 hour humidty and push into array
	$humid_mean = $humid_mean / 6;
	$humid_array[] = $humid_mean;

	// Format time and push into array
        $time = DateTime::createFromFormat('Y-m-d H:i:s', $row['climate_time']);
        $time_array[] = $time->format('H:i');
    }
    
    // Calculate mean of 24 hour temperature
    $temp_mean_24 = $temp_mean_24 / 144;
    // Calculate mean of 24 hour humidity
    $h_mean_24 = $h_mean_24 / 144;
}

// Data points to load into CanvasJS charts
$dataPointsT = array(
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

$dataPointsH = array(
    array("y" => $humid_array[23], "label" => "$time_array[23]"),
    array("y" => $humid_array[22], "label" => "$time_array[22]"),
    array("y" => $humid_array[21], "label" => "$time_array[21]"),
    array("y" => $humid_array[20], "label" => "$time_array[20]"),
    array("y" => $humid_array[19], "label" => "$time_array[19]"),
    array("y" => $humid_array[18], "label" => "$time_array[18]"),
    array("y" => $humid_array[17], "label" => "$time_array[17]"),
    array("y" => $humid_array[16], "label" => "$time_array[16]"),
    array("y" => $humid_array[15], "label" => "$time_array[15]"),
    array("y" => $humid_array[14], "label" => "$time_array[14]"),
    array("y" => $humid_array[13], "label" => "$time_array[13]"),
    array("y" => $humid_array[12], "label" => "$time_array[12]"),
    array("y" => $humid_array[11], "label" => "$time_array[11]"),
    array("y" => $humid_array[10], "label" => "$time_array[10]"),
    array("y" => $humid_array[9], "label" => "$time_array[9]"),
    array("y" => $humid_array[8], "label" => "$time_array[8]"),
    array("y" => $humid_array[7], "label" => "$time_array[7]"),
    array("y" => $humid_array[6], "label" => "$time_array[6]"),
    array("y" => $humid_array[5], "label" => "$time_array[5]"),
    array("y" => $humid_array[4], "label" => "$time_array[4]"),
    array("y" => $humid_array[3], "label" => "$time_array[3]"),
    array("y" => $humid_array[2], "label" => "$time_array[2]"),
    array("y" => $humid_array[1], "label" => "$time_array[1]"),
    array("y" => $humid_array[0], "label" => "$time_array[0]")
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
	
	.canvasjs-chart-canvas {
	    border: 1px solid black;
	}
	
	.red-text {
	    color: #8c1703;
	}
	
	.blue-text {
	    color: #005fa8;
	}

    </style>
    
    <!-- canvasjs chart script -->
    <script>
        window.onload = function () {

	    <!-- Temperature chart -->
            var chartT = new CanvasJS.Chart("chartContainerT", {
		title: {
		    text: "Temperature"
		},
                axisX: {
                    title: "Last 24 hours"
                },
                axisY: {
                    title: "Temperature °C"
                },
                data: [{
                    type: "line",
		    color: "#8c1703",
                    dataPoints: <?php echo json_encode($dataPointsT, JSON_NUMERIC_CHECK); ?>
                }]
            });
	    
	    <!-- Humidity chart -->
	    var chartH = new CanvasJS.Chart("chartContainerH", {
                title: {
		    text: "Humidity"
		},
                axisX: {
                    title: "Last 24 hours"
                },
		axisY: {
                    title: "Humidity %"
                },
                data: [{
                    type: "line",
		    color: "#005fa8",
                    dataPoints: <?php echo json_encode($dataPointsH, JSON_NUMERIC_CHECK); ?>
                }]
		
            });
	    
            chartT.render();
            chartH.render();

        }
    </script>
</head>



<body>

<!-- page title and navigation buttons -->
<h1 align="center">Climate</h1>
<div class="container" align="center">
<a href="climate_analysis.php" class="button">Analysis</a>
<a href="climate_raw.php" class="button">Raw</a>
</div>

<!-- div for canvas charts -->
<div class="chart-container" align="center" style="height:26.3em;">
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <div id="chartContainerT" style="width: 34em; display: inline-block;"></div>
    <div id="chartContainerH" style="width: 34em; display: inline-block;"></div>
</div>

<!-- Container for table of 24 rows of 1 hour data -->
<div class="container">
    
    <!-- Create a container for meanm, min and max 24hour values -->
    <div class="row" align="center" style="font-size: 24px">
	
	<!-- Temperatures -->
	<div class="col">
	    <span>Mean: </span><span class="red-text"><?php echo round($temp_mean_24, 1) ?></span>
	</div>
	<div class="col">
	    <span>Min: </span><span class="red-text"><?php echo round($temp_min_24, 1) ?></span>
	</div>
	<div class="col">
	    <span>Max: </span><span class="red-text"><?php echo round($temp_max_24, 1) ?></span>
	</div>
	
	<!-- Humidity -->
	<div class="col">
	    <span>Mean: </span><span class="blue-text"><?php echo round($h_mean_24, 1) ?></span>
	</div>
	<div class="col">
	    <span>Min: </span><span class="blue-text"><?php echo round($h_min_24, 1) ?></span>
	</div>
	<div class="col">
	    <span>Max: </span><span class="blue-text"><?php echo round($h_max_24, 1) ?></span>
	</div>
    </div>
    
    <br>
    <br>
    <br>
    
    <!-- Create a container for table -->
    <div class="row">
	<div class="col">
	    <table>
		<!-- Print headers for table -->
		<th>Temp Mean °C</th>
		<th>Temp Min °C</th>
		<th>Temp Max °C</th>
		<th>Humidity Mean %</th>
		<th>Humidity Min %</th>
		<th>Humidity Max %</th>
		<th>Time</th>
		<?php
		
		// SQL statemenmt + query
		$sql = "SELECT temperature, humidity, climate_time FROM climate ORDER BY climate_time DESC";
		$result = $conn->query($sql);
		
		// Check if DB Table contains any rows
		if ($result->num_rows > 0) {
		    
		    // While loop for 24 hours
		    while ($i < 24) {
			
			// Initialize and flush variables
			$temp_mean = 0;
			$temp_min = 1000;
			$temp_max = -1000;
						    
			$h_mean = 0;
			$h_min = 1000;
			$h_max = -1000;
			
			// While loop for 6 rows
			while ($j < 6) {
			    
			    // Fetch table row
			    $row = $result->fetch_assoc();

			    // Sum temperatures for 1 hour
			    $temp_mean = $temp_mean + $row["temperature"];
			    
			    // Find min temp for 1 hour
			    if ($temp_min > $row["temperature"]) {
				$temp_min = $row["temperature"];
			    }
			    
			    // Find max temp for 1 hour
			    if ($temp_max < $row["temperature"]) {
				$temp_max = $row["temperature"];
			    }						
							    
			    // Sum humidity for 1 hour
			    $h_mean = $h_mean + $row["humidity"];
			    
			    // Find min humidity for 1 hour
			    if ($h_min > $row["humidity"]) {
				$h_min = $row["humidity"];
			    }
			    
			    // Find max humidity for 1 hour
			    if ($h_max < $row["humidity"]) {
				$h_max = $row["humidity"];
			    }
			    
			    $j = $j + 1;
			}
			
			// Calculate sum of 1 hour temperature and humidity
			$temp_mean = $temp_mean / 6;
			$h_mean = $h_mean / 6;
			
			$j = 0;

			// Print 1 row of 1 hour temperature/humidity data
			echo "<tr>";
			echo "<td>", round($temp_mean, 1), "</td>";
			echo "<td>", round($temp_min, 1), "</td>";
			echo "<td>", round($temp_max, 1), "</td>";
			echo "<td>", round($h_mean, 1), "</td>";
			echo "<td>", round($h_min, 1), "</td>";
			echo "<td>", round($h_max, 1), "</td>";
			echo "<td>", $row["climate_time"], "</td>";
			echo "</tr>";
			
			$i = $i + 1;
		    }
		}
		
		// If no rows found in table
		else {
		    echo "0 results";
		}
		
		$conn->close();
		?>
		
	    </table>
	</div>
    </div>
    <br>
</body>
</html>
