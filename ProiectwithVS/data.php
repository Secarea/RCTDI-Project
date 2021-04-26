<?php
$conn=mysqli_connect("localhost", "root", "") or die(mysqli_error());
mysqli_select_db($conn, "sensors");

$sql_read = "SELECT * FROM sensorData";

$result = mysqli_query($conn, $sql_read);
while($row = mysqli_fetch_array($result)) {
	$id = $row['id'];
	$temperature = $row['temperature'];
	$humidity = $row['humidity'];
	$door= $row['door'];
	$created_at=$row['created_at'];
}

echo '<p>';
echo '<i class="fas fa-thermometer-half"></i>';
echo '<span class="dht-labels">Temperature:</span>';
echo '<span id="humidity">'. $temperature .'</span>';
echo '<sup class="units">°C</sup>';
echo '</p>';

echo '<p>';
echo '<i class="fas fa-tint"></i>';
echo '<span class="dht-labels">Humidity:</span>';
echo '<span id="humidity">'. $humidity . '</span>';
echo '<sup class="units">%</sup>';
echo '</p>';

if($door == 1){
    echo '<p>';
    echo '<i class="fas fa-door-open"></i>';
    echo '<span class="dht-labels">Door open</span>';
    echo '</p>';
    }else if($door == 0){
    echo '<p>';
    echo '<i class="fas fa-door-closed"></i>';
    echo '<span class="dht-labels">Door Closed</span>';
    echo '</p>';	
    }
    echo '<p>Last update at:'. $created_at . '</p>';