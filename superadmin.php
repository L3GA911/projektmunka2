<?php
    include_once ('information.php');
    include_once ('menu.php');
?>

<?php
//Új cég létrehozása
if (isset($_POST['newfirm'])) {
	//Adatok ellenőrzése
	$hiba = 0;
	if (($userinfo['role']==2) && 
	(isset($_POST['firmname'])) && 
	(isset($_POST['cform'])) && 
	(isset($_POST['fadminfirstn'])) && 
	(isset($_POST['fadminlastn'])) && 
	(isset($_POST['username'])) && 
	(isset($_POST['password'])) && 
	(isset($_POST['passwordc'])) && 
	(isset($_POST['email']))) {
			//Ha minden ki van töltve
			$username = stripslashes($_REQUEST['username']);
			$username = mysqli_real_escape_string($con, $username);
			$query = "SELECT * FROM users WHERE username='".$username."' AND email='".$email."'";
			$result = mysqli_query($con, $query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			if ($rows != 0) {
				//Már létezik ilyen felhasználónév vagy e-mail
				$hiba = 2;
			} else {
				$firmname = stripslashes($_REQUEST['firmname']);
				$firmname = mysqli_real_escape_string($con, $firmname);
				$query = "SELECT * FROM companys WHERE name='".$firmname."' AND form_id='".$cform."'";
				$result = mysqli_query($con, $query) or die(mysql_error());
				$rows = mysqli_num_rows($result);
				if ($rows != 0) {
				//Már létezik ilyen cégnév
				$hiba = 4;
				} else {
					if ($password != $passwordc) {
						//Nem egyezik a két jelszó
						$hiba = 3;
					} else {
						$cform = stripslashes($_REQUEST['cform']);
						$cform = mysqli_real_escape_string($con, $cform);
						$headquarters = stripslashes($_REQUEST['headquarters']);
						$headquarters = mysqli_real_escape_string($con, $headquarters);
						$fadminfirstn = stripslashes($_REQUEST['fadminfirstn']);
						$fadminfirstn = mysqli_real_escape_string($con, $fadminfirstn);
						$fadminlastn = stripslashes($_REQUEST['fadminlastn']);
						$fadminlastn = mysqli_real_escape_string($con, $fadminlastn);
						$password = stripslashes($_REQUEST['password']);
						$password = mysqli_real_escape_string($con, $password);
						$passwordc = stripslashes($_REQUEST['passwordc']);
						$passwordc = mysqli_real_escape_string($con, $passwordc);
						$email = stripslashes($_REQUEST['email']);
						$email = mysqli_real_escape_string($con, $email);
						//Mehetnek az értékek az adatbázisba
						$query = "INSERT INTO users (username, password, firstname, lastname, role, email) 
								VALUES ('$username', '".md5($password)."', '$fadminfirstn', '$fadminlastn', '1', '$email' )"; //új felhasználó
						$execute = mysqli_query($con, $query) or die(mysql_error());
						
						$query = "SELECT id FROM users WHERE username='$username'"; //user id lekérdezése a céghez kapcsoláshoz
						$result  = mysqli_query($con, $query);
						$getinfo = mysqli_fetch_assoc($result);
						$userid = $getinfo['id'];

						$query = "INSERT INTO companys (name, address, owner_id, form_id)
						VALUES ('$firmname', '$headquarters', '$userid', '$cform')"; // új cég
						$execute = mysqli_query($con, $query) or die(mysql_error());
					}
				}
			}
		} else {
			$hiba = 1; 
		} //nincs kitöltve

//hibák kezelése
switch ($hiba) {
	case 0:
		echo '<script>alert("Minden rendben!")</script>';
		break;
	case 1:
		echo '<script>alert("Nincs kitöltve minden mező!")</script>';
		break;
	case 2:
		echo '<script>alert("Már létezik ilyen felhasználónév vagy e-mail cím!")</script>';
		break;
	case 3:
		echo '<script>alert("A két jelszó nem egyezik meg!")</script>';
		break;
	case 4:
		echo '<script>alert("Már létezik ilyen cégnév!")</script>';
		break;
	}
}
?>

<div class="navigation2">
    <span class="navname">Lehetőségek</span>
        <ul>
            <li onClick="pageLoad('sa_add_new_firm')">Új cég regisztrálása</li>
            <li onClick="pageLoad('sa_firm_delete')">Cég törlése</li>
            <li onClick="pageLoad('sa_user_delete')">Felhasználó törlése</li>
        </ul>
</div>
<div id="content" class="content">
    <span class="navname">SuperAdmin</span><br>
    <span>A SuperAdmin cégek létrehozására, felhasználók és cégek törlésére jogosult.</span>
</div>

<script>
	$(':root').css("--changeImage", "url('../svg/construction_black_24dp.svg')");
</script>

<?php
    include_once ('bottom.php');
?>