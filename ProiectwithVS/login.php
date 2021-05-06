<?php
session_start();
$con = mysqli_connect('localhost','root','','logare');
if(!$con){
	die('Conectarea a esuat');
}
	$username=$_POST['username'];
	$password=$_POST['password'];



$sql= "SELECT * FROM login1 WHERE username ='$username' and password='$password'";  // selecteaza din baza de date login1
$rezultat= mysqli_query($con, $sql);  //conectare si interogare

while($rand=$rezultat->fetch_assoc()) //preia coloanele intr-un array
{
	if($rand['username'] == $username && $rand['password'] == $password) //verificare array
	{

		$_SESSION['loggedIn'] = true;
		header("Location: user.php"); //muta in pagina user.php
		exit;
	}
}
header("Location: index.php");