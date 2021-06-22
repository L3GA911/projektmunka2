<?php
    require ('information.php');
    require ('menu.php');
?>

<?php
//--------------MINDEN ITT VAN LEKEZELVE, AMI A SUPERADMIN MENÜPONTON BELÜL TÖRTÉNIK!--------------
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
			$email = stripslashes($_REQUEST['email']);
			$email = mysqli_real_escape_string($con, $email);
			$query = "SELECT * FROM users WHERE username='".$username."' OR email='".$email."'";
			$result = mysqli_query($con, $query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			if ($rows != 0) {
				//Már létezik ilyen felhasználónév vagy e-mail
				$hiba = 2;
			} else {
				$firmname = stripslashes($_REQUEST['firmname']);
				$firmname = mysqli_real_escape_string($con, $firmname);
				$cform = stripslashes($_REQUEST['cform']);
				$cform = mysqli_real_escape_string($con, $cform);
				$query = "SELECT * FROM companys WHERE name='".$firmname."' AND form_id='".$cform."'";
				$result = mysqli_query($con, $query) or die(mysql_error());
				$rows = mysqli_num_rows($result);
				if ($rows != 0) {
				//Már létezik ilyen cégnév
				$hiba = 4;
				} else {
					$password = stripslashes($_REQUEST['password']);
					$password = mysqli_real_escape_string($con, $password);
					$passwordc = stripslashes($_REQUEST['passwordc']);
					$passwordc = mysqli_real_escape_string($con, $passwordc);
					if ($password != $passwordc) {
						//Nem egyezik a két jelszó
						$hiba = 3;
					} else {
						$address = stripslashes($_REQUEST['address']);
						$address = mysqli_real_escape_string($con, $address);
						$fadminfirstn = stripslashes($_REQUEST['fadminfirstn']);
						$fadminfirstn = mysqli_real_escape_string($con, $fadminfirstn);
						$fadminlastn = stripslashes($_REQUEST['fadminlastn']);
						$fadminlastn = mysqli_real_escape_string($con, $fadminlastn);
						//Mehetnek az értékek az adatbázisba
						$query = "INSERT INTO users (username, password, firstname, lastname, role, email, status) 
								VALUES ('$username', '".md5($password)."', '$fadminfirstn', '$fadminlastn', '1', '$email', '-1' )"; //új felhasználó
						$execute = mysqli_query($con, $query) or die(mysql_error());
						
						$query = "SELECT id FROM users WHERE username='$username'"; //user id lekérdezése a céghez kapcsoláshoz
						$result  = mysqli_query($con, $query);
						$getinfo = mysqli_fetch_assoc($result);
						$userid = $getinfo['id'];

						$query = "INSERT INTO companys (name, address, owner_id, form_id)
						VALUES ('$firmname', '$address', '$userid', '$cform')"; // új cég
						$execute = mysqli_query($con, $query) or die(mysql_error());

						$query = "SELECT *, companys.id as firm_id FROM companys
						JOIN users ON users.id = companys.owner_id
						WHERE users.id = '$userid'";// Cég ID lekérdezése
						$result  = mysqli_query($con, $query);
						$row = $result->fetch_assoc();
						$firm_id = $row['firm_id'];

						// $query = "INSERT INTO positions (name, c_id)
						// VALUES ('Cégfelelős', '$firm_id')"; // cégfelelős pozíció létrehozása
						// $execute = mysqli_query($con, $query) or die(mysql_error());

						// $query = "SELECT * FROM positions
						// WHERE c_id = '$firm_id' AND name = 'Cégfelelős'";// Pozíció ID lekérdezése
						// $result  = mysqli_query($con, $query);
						// $row = $result->fetch_assoc();
						// $pos_id = $row['id'];

						// $query = "UPDATE users
						// SET status = '$pos_id'
						// WHERE id = '$userid'"; // a létrehozott cégfelelősnél frissítjük a "status" attribútumot az újonnan létrehozott cégfelelős ID -re
						// $execute = mysqli_query($con, $query) or die(mysql_error());
					}
				}
			}
		} else {
			$hiba = 1; 
		} //nincs kitöltve

//hibák kezelése
switch ($hiba) {
	case 0:
		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>
				Sikeres regisztráció!
			  </div>';
		break;
	case 1:
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>
				Nincs kitöltve minden mező!
			  </div>';
		break;
	case 2:
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>
				Már létező felhasználónév vagy e-mail cím!
			  </div>';
		break;
	case 3:
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>
				A jelszavak nem egyeznek!
			  </div>';
		break;
	case 4:
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>
				Már regisztrált cégnév!
			  </div>';
		break;
	}
}

//Cég törlése
@$firm_id = $_REQUEST['firm_id']; //firm_delete
if (isset($firm_id)) {
	//SQL kapcsolat létrehozása
	$query = "CALL DeleteCompanyWithAllData ('$firm_id')"; //a cég és minden hozzátartozó adat törlése
	$result = mysqli_query($con, $query) or die(mysql_error());
}

//Felhasználó törlése
@$user_id = $_REQUEST['user_id']; //user_delete
@$firm = $_REQUEST['firm'];
@$owner = $_REQUEST['owner'];
if (isset($user_id)) {
	echo $firm; echo $owner;
	//SQL kapcsolat létrehozása
	if ($owner == '1') {	
		$query = "CALL DeleteCompanyWithAllData ('$firm')"; //a vezető törlésével minden törlésre kerül
		$result = mysqli_query($con, $query) or die(mysql_error());
	} else {
		$query = "CALL DeleteUser ('$user_id')";
		$result = mysqli_query($con, $query) or die(mysql_error());	
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