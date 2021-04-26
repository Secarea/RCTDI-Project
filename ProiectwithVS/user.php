<?php
session_start();
?>
<!DOCTYPE html>
<?php
 if($_SESSION['loggedIn']){
 	?>
<html>
    <head>
    <title>User Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="styles2.css">
    </head>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="Logo.png" alt="" width="50" height="35" class="d-inline-block align-text-top">
      NodeMCU Data Aquisition
    </a>
  </div>
</nav>

<script type="text/javascript">
		$(document).ready(function() {
			setInterval(function () {
				$('#hum').load('data.php')
			}, 5);
		});
	</script>

<script type="text/javascript">
		$(document).ready(function() {
			setInterval(function () {
				$('#chart').load('chart.php')
			}, 5);
		});
	</script>

<div class="container">
 <div class="row t-10">
    <div class="col-lg-6">
      <div class="d-flex justify-content-center h-100">
        <div class="card">
          <div class="card-body">
           <div class="box">
            <div id="hum">

           </div>
          </div>
        </div>
     </div>
    </div>
    </div>
  </div>
 </div>
</div>

<div class="container">
    <div class="row t-10">
      <div class="col-lg-6 d-flex justify-content-center h-100">
        <div class="chart">
        
        </div>
      </div>
    </div>
</div>


<div class="btn btn-primary" onclick="location='chart.php'">Charts</div>
</body>
  <?php
}
 else
      header('Location: index.php'); 
  ?>

</html>