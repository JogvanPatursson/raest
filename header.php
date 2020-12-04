<link rel="stylesheet" href="css/bootstrap.min.css"/>
<!DOCTYPE html>
<html>
<head>
	<title>RAEST Web App</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
	body {
		margin: 0;
	  font-family: Arial, Helvetica, sans-serif;
	}
	
	ul.topnav {
	  list-style-type: none;
	  margin: 0;
	  padding: 0;
	  overflow: hidden;
	  background-color: #333;
	}
	
	ul.topnav li {float: left;}
	
	ul.topnav li a {
	  display: block;
	  font-family: Arial, Helvetica, sans-serif;
	  color: white;
	  text-align: center;
	  padding: 14px 16px;
	  text-decoration: none;
	}
	
	ul.topnav li a:hover:not(.active) {background-color: #111;}
	
	@media screen and (max-width: 600px) {
	  ul.topnav li.right, 
	  ul.topnav li {float: none;}
	}
	</style>
</head>
<body>
	
<ul class="topnav">
	<li><a href="index.php">Dashboard</a></li>
	<li><a href="camera.php">Camera Feed</a></li>
	<li><a href="climate.php">Climate</a></li>
</ul>

</body>
</html>
