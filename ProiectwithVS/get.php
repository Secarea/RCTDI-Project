<html>
<body>
<?php

$conn=mysqli_connect("localhost", "root", "") or die(mysqli_error());
mysqli_select_db($conn, "sensors");
if(!$conn){
	echo "Error: " . mysqli_connect_error();
	exit();
}
echo "Connection Success!<br><br>";

$temperature = $_GET["temperature"];
$humidity = $_GET["humidity"];
$door=$_GET["door"];


$query = "INSERT INTO sensorData (temperature, humidity,door) VALUES ('$temperature', '$humidity','$door')";
$result = mysqli_query($conn,$query);

echo "Insertion Success!";
?>
</body>
</html>