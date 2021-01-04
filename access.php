<?php
include_once ('header.php');
include_once ('connect.php');
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
	
<h1 align="center">Access</h1>
<div class="container">
	<br>
	<!-- Print table -->
	<table>
	<th>User</th>
	<th>Access Time</th>
	
	<?php
	
	// SQL query
	$sql = "SELECT user_name, access_time FROM access JOIN user ON access.user_id = user.user_id ORDER BY access_time DESC";
	$result = $conn->query($sql);

	// Check if database table is empty
	if ($result->num_rows > 0) {
		
		// Output data of each row in table
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>", $row["user_name"], "</td>";
			echo "<td>", $row["access_time"], "</td>";
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
<br>

</body>
</html>
