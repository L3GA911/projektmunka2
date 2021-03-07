<?php
//Azonosítás
session_start();
	if ($_SESSION["logged_in"]){
		require('db.php');
		$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
		$result = mysqli_query($con, $query) or die(mysql_error());
		$userinfo = mysqli_fetch_assoc($result);
	} else {
		header("Location: login.php");
		exit(); 
	}
	?>
