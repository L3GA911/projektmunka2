<!DOCTYPE html>
<html lang="hu">
    <head>
        <title>Online munkaidő nyilvántartó rendszer - Bejelentkezés</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300&display=swap" rel="stylesheet"> 
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="styles/login_styles.css">
</head>
<body>
<?php
require('inc/db.php');
session_start();

//Form elküldés után
if (isset($_POST['username'])) {
$username = stripslashes($_REQUEST['username']);
$username = mysqli_real_escape_string($con, $username);
$password = stripslashes($_REQUEST['password']);
$password = mysqli_real_escape_string($con, $password);
// Létezik -e a user
$query    = "SELECT * FROM `users` WHERE username='$username'
			 AND password='" . md5($password) . "'";
$result = mysqli_query($con, $query) or die(mysql_error());
$rows = mysqli_num_rows($result);
if ($rows != 0) {
	$_SESSION['username'] = $username;
	$_SESSION['logged_in'] = true;
	header("Location: home.php");
} else {
	//Hibaüzenet
	$hiba = true;
		}
}
?>

<div class="grid-container-login">
		<main>
				<form name="login" id="" method="post" autocomplete="off">
				<span class="text">BEJELENTKEZÉS</span><br>
					<input type="text" id="username" name="username" placeholder="Felhasználónév">
					<br>
					<input type="password" id="password" name="password" placeholder="Jelszó"><br>
					<button class="button">Bejelentkezés</button>
					<?php 
						if ($hiba) {
							echo '<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								Hibás felhasználónév vagy jelszó!
							</div>';
						} 
					?>
				</form>
		</main>
	</div>
</body>
</html>