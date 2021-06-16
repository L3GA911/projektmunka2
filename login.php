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
		 <!--<script>
// Get the modal
var modal = document.getElementById("editWindow");

// Get the button that opens the modal
var btn = document.getElementById("openmodal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
 </script>-->
</head>
<body>
<?php

require('inc/db.php');
session_start();
$hiba = 0; //hiba alapvetően nincs

if (isset($_GET['changePassword'])) {
	
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
						<a href="login.php?changePassword=true" data-target="#exampleModal" data-toggle="modal">Megváltoztatom!</a>
					</div>
			<?php }
				if ($hiba == 2) {?>
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						Hibás felhasználónév vagy jelszó!
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
	    <button type="submit" id="modifyPerson" name="modifyPerson" form="form" class="button2">Módosítás</button>
      </div>
    </div>
  </div>
</div>
<!--<div id="editWindow" class="modal">
	<div class="modal-content">
		<span class="close">&times;</span>
		<span class="navname">bnbvn</span>
		<div class="content_container">
			<div class="form_content">
				<form id="form" name="form" action="" method="post" autocomplete="off">
					<label for="password">A dolgozó jelszava:</label>
					<input type="password" id="password" name="password" value="" placeholder="Jelszó">
					<label for="passwordc">Jelszó megerősítése:</label>
					<input type="password" id="passwordc" name="passwordc" value="" placeholder="Jelszó megerősítése"><br>
					<button type="submit" id="modifyPerson" name="modifyPerson" form="form" class="button">Módosítás</button>
				</form>
			</div>
		</div>
	</div>
</div>-->

</body>
</html>