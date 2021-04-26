<?php
 
 $conn=mysqli_connect("localhost", "root", "") or die(mysqli_error());
 mysqli_select_db($conn, "sensors");
 
 $sql_read = "SELECT temperature as y, created_at as label FROM sensorData";
 
 $result = mysqli_query($conn, $sql_read);
 while($row = mysqli_fetch_array($result)) {
     $y = $row['y'];
     $label=$row['label'];
 }
$senzor=array();
foreach($result as $row){
    $senzor[]=$row;
}

$sql_read1 = "SELECT humidity as y, created_at as label FROM sensorData";
$result1 = mysqli_query($conn, $sql_read1);
 while($row = mysqli_fetch_array($result1)) {
     $y = $row['y'];
     $label=$row['label'];
 }
 $senzor1=array();
foreach($result1 as $row){
    $senzor1[]=$row;
}

?>

<!DOCTYPE HTML>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Sensor Data"
	},
	axisY: {
		title: "Temp[°C] & Humidity[%]"
	},
    tooltip:{
        shared:true
    },
    legend: {
        cursor: "pointer",
        verticalAlign: "top",
        horizontalAlign: "center"
    },
	data: [{
		type: "line",
        name: "Temperature",
        markerSize: 0,
        toolTipContent: "Temperature: {y} °C",
		dataPoints: <?php echo json_encode($senzor, JSON_NUMERIC_CHECK); ?>
	},{
        type: "line",
        name: "Humidity",
        showInLegened:true,
        markerSize: 0,
        toolTipContent: "Humidity: {y} %",
		dataPoints: <?php echo json_encode($senzor1, JSON_NUMERIC_CHECK); ?>
    }]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 30%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
                            