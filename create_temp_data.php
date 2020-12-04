<?php
$servername = "localhost";
$username = "root";
$password = "raest";
$dbname = "raest_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection Failed: " . $conn->connect_error);
}
$sql = "INSERT INTO climate (temperature, humidity, climate_time)
VALUES (34, 77, '2020-11-27 11:00:00')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO climate (temperature, humidity, climate_time)
VALUES (34, 77, '2020-11-27 11:10:00')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO climate (temperature, humidity, climate_time)
VALUES (34, 77, '2020-11-27 11:20:00')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO climate (temperature, humidity, climate_time)
VALUES (35, 76, '2020-11-27 11:30:00')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO climate (temperature, humidity, climate_time)
VALUES (35, 76, '2020-11-27 11:40:00')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "INSERT INTO climate (temperature, humidity, climate_time)
VALUES (35, 76, '2020-11-27 11:50:00')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
