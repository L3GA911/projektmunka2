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
$hiba = 0; //hiba alapvetően nincs

if (isset($_POST['changePassword'])) {
	$username = $_SESSION['username'];
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con, $password);
	$passwordc = stripslashes($_REQUEST['passwordc']);
	$passwordc = mysqli_real_escape_string($con, $passwordc);

	if ($password == $passwordc && $password != "") {
		$password = md5($password);
		$query    = "UPDATE users SET password='$password', firstlogin='0' WHERE username='$username'";
		$execute = mysqli_query($con, $query) or die(mysql_error());
		$hiba = 4; //Ez valójában success
	} else {
		$hiba = 3; //A jelszó üres vagy nem egyezik meg a két bemenet
	}

}

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
$row = mysqli_fetch_assoc($result);
$rows = mysqli_num_rows($result);

if ($rows != 0) {

	if ($row["firstlogin"] == 1) {
		$hiba = 1;
		$_SESSION['username'] = $username;
		//első bejelentkezés, jelszó változtatás szükséges
	} else {
			$_SESSION['username'] = $username;
			$_SESSION['logged_in'] = true;
			header("Location: home.php");
		}

} else {
	$hiba = 2; //rossz felhasználónév/jelszó
	}
}
?>

<div class="grid-container-login">
	<main>
		<form name="login" id="" method="post" autocomplete="off">
			<span class="text">BEJELENTKEZÉS</span><br>
			<input type="text" id="username" name="username" placeholder="Felhasználónév"><br>
			<input type="password" id="password" name="password" placeholder="Jelszó"><br>
			<button class="button">Bejelentkezés</button>
			<?php 
				if ($hiba == 1) {?>
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						Jelszó módosítás szükséges!
						<a href="" data-target="#exampleModal" data-toggle="modal">Megváltoztatom!</a>
					</div>
			<?php }
				if ($hiba == 2) {?>
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						Hibás felhasználónév vagy jelszó!
					</div>
			<?php } ?>
			<?php
			if ($hiba == 3) {?>
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						A két jelszó nem egyezik meg, vagy valamelyik mező üresen maradt!
						<a href="" data-target="#exampleModal" data-toggle="modal">Újra!</a>
					</div>
			<?php } ?>
			<?php
			if ($hiba == 4) {?>
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						A jelszó módosítás sikeres volt!
					</div>
			<?php } ?>
		</form>
	</main>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Jelszó módosítás</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="content_container">
			<div class="form_content">
				<form id="form" name="form" action="" method="post" autocomplete="off">
					<label for="password">Jelszó:</label>
					<input type="password" id="password" name="password" value="" placeholder="Jelszó">
					<label for="passwordc">Jelszó megerősítése:</label>
					<input type="password" id="passwordc" name="passwordc" value="" placeholder="Jelszó megerősítése">
				</form>
			</div>
	  </div>
      <div class="modal-footer">
	    <button type="submit" id="changePassword" name="changePassword" form="form" class="button2">Módosítás</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>