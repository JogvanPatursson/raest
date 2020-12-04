<?php
	include_once ('header.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>RAEST Web App</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>

	</style>
</head>

<body>

<div align="center">
	<h1>Camera Feed</h1>
	<img src="stream.mjpg" width="640" height="480">
	<br>
	<?php echo date('d-m-Y H:i:s'); ?>
</div>

</body>

</html>
