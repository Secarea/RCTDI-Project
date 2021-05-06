<html>
    <head>
    <title>Charts</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
      html,body{
    background-color:#ebebf2;
    background-size: cover;
    background-repeat: no-repeat;
    height: 100%;
}
  </style>
 
    </head>

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
<body>

<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="Logo.png" alt="" width="50" height="35" class="d-inline-block align-text-top" onclick="location='user.php'">
      NodeMCU Data Aquisition
    </a>
  </div>
</nav>

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
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>