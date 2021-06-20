<?php
    require ('information.php');
    require ('menu.php');
?>

<?php
//Dolgozó felvétele
if (isset($_POST['newperson'])) {
	//Adatok ellenőrzése
	$hiba = 0;
	if (($userinfo['role']==1) && 
	(isset($_POST['lastname'])) && 
	(isset($_POST['firstname'])) && 
	(isset($_POST['birthday'])) && 
	(isset($_POST['position'])) && 
	(isset($_POST['address'])) && 
	(isset($_POST['username'])) && 
	(isset($_POST['password'])) && 
	(isset($_POST['passwordc'])) && 
    (isset($_POST['numbersOfChildren'])) && 
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
				$password = stripslashes($_REQUEST['password']);
				$password = mysqli_real_escape_string($con, $password);
				$passwordc = stripslashes($_REQUEST['passwordc']);
				$passwordc = mysqli_real_escape_string($con, $passwordc);
                if ($password != $passwordc) {
                    //Nem egyezik a két jelszó
                    $hiba = 3;
                } else {
                    $lastname = stripslashes($_REQUEST['lastname']);
                    $lastname = mysqli_real_escape_string($con, $lastname);
                    $firstname = stripslashes($_REQUEST['firstname']);
                    $firstname = mysqli_real_escape_string($con, $firstname);
					$birthday = stripslashes($_REQUEST['birthday']);
                    $birthday = mysqli_real_escape_string($con, $birthday);
					$position = stripslashes($_REQUEST['position']);
                    $position = mysqli_real_escape_string($con, $position);
                    $address = stripslashes($_REQUEST['address']);
                    $address = mysqli_real_escape_string($con, $address);
                    $username = stripslashes($_REQUEST['username']);
                    $username = mysqli_real_escape_string($con, $username);
                    $numbersOfChildren = stripslashes($_REQUEST['numbersOfChildren']);
                    $numbersOfChildren = mysqli_real_escape_string($con, $numbersOfChildren);
                    //Mehetnek az értékek az adatbázisba

                    $query = "INSERT INTO users (username, password, firstname, lastname, birthday, address, role, email, status) 
                              VALUES ('$username', '".md5($password)."', '$firstname', '$lastname', '$birthday', '$address', '0', '$email', $position)"; //új felhasználó
                    $execute = mysqli_query($con, $query) or die(mysql_error());
                    
                    $query = "SELECT id FROM users WHERE username='$username'"; //user id lekérdezése a céghez kapcsoláshoz
                    $result  = mysqli_query($con, $query);
                    $getinfo = mysqli_fetch_assoc($result);
                    $userid = $getinfo['id'];
                    $companyid = $extendeduserinfo['id']; // cég id (a létrehozó felhasználó adatai alapján)

                    $query = "INSERT INTO c_members (c_id, u_id)
                    VALUES ('$companyid', '$userid')"; // új felhasználó kapcsolása a céghez (c_members)
                    $execute = mysqli_query($con, $query) or die(mysql_error());

					

                    //annyiszor fut le a kód, ahány gyermek van
					if ($numbersOfChildren <> 0) { //ha egyáltalán van gyermek
						for($i=1; $i<=$numbersOfChildren; $i++){ 
							$birthday_kid = stripslashes($_REQUEST['child'.$i]);
							$birthday_kid = mysqli_real_escape_string($con, $birthday_kid);
							$query = "INSERT INTO p_child (p_id, birthday)
							VALUES ('$userid', '$birthday_kid')"; // gyerekek születésének dátuma hozzáadása (p_child)
							$execute = mysqli_query($con, $query) or die(mysql_error());
						} 
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
				A jelszók nem egyeznek!
			  </div>';
		break;
	case 4:
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>
				Már regisztrált felhasználói profil!
			  </div>';
		break;
	}
}
//Felhasználó törlése
@$user_id = $_REQUEST['user_id'];
if (isset($user_id)) {
	$user_id = stripslashes($user_id); 
	//SQL kapcsolat létrehozása
	$user_id = mysqli_real_escape_string($con, $user_id);
	$query = "DELETE FROM users WHERE id='$user_id'";
	$result = mysqli_query($con, $query) or die(mysql_error());
}

//Pozíció létrehozása
@$pos_name = $_REQUEST['pos_name'];
@$posmaxfreedays = $_REQUEST['posmaxfreedays'];
echo $posmaxfreedays;
if ((isset($pos_name)) && (isset($posmaxfreedays))) {
	echo 'asd';
	$pos_name = stripslashes($pos_name); 
	$posmaxfreedays = stripslashes($posmaxfreedays); 
	//SQL kapcsolat létrehozása
	$firm_id = $extendeduserinfo['firm_id'];
	$pos_name = mysqli_real_escape_string($con, $pos_name);
	$posmaxfreedays = mysqli_real_escape_string($con, $posmaxfreedays);
	//Pozíció létezésének ellenőrzése
	$query = "SELECT * FROM positions WHERE c_id = '$firm_id' AND name = '$pos_name'";
	$result  = mysqli_query($con, $query);
	$rows = mysqli_num_rows($result);
	if ($rows == 0 && $pos_name != "") {
		//Pozíció beírása az adatbázisba
		$query = "INSERT INTO positions (name, c_id, maxfreedays)
		VALUES ('$pos_name',  '$firm_id', '$posmaxfreedays')";
		$execute = mysqli_query($con, $query) or die(mysql_error());
	} 
}

//Pozíció törlése
@$pos_id = $_REQUEST['pos_id']; 
if (isset($pos_id)) {
	$pos_id = stripslashes($pos_id); 
	//SQL kapcsolat létrehozása
	$pos_id = mysqli_real_escape_string($con, $pos_id);
	$query = "DELETE FROM positions WHERE id='$pos_id'";
	$execute = mysqli_query($con, $query) or die(mysql_error());
}

//Felhasználó szerkesztése -----EZ MÉG BEFEJEZETLEN----------
if (isset($_POST['modifyPerson'])) {
	//Adatok ellenőrzése
	$hiba = 0;
	if (
	($userinfo['role']==1) && 
	(isset($_POST['personid'])) && 
	(isset($_POST['lastname'])) && 
	(isset($_POST['firstname'])) && 
	(isset($_POST['position'])) && 
	(isset($_POST['address'])) && 
	(isset($_POST['username'])) && 
	(isset($_POST['password'])) && 
	(isset($_POST['passwordc'])) && 
    (isset($_POST['numbersOfChildren'])) && 
	(isset($_POST['email']))
	) {

			$personid = stripslashes($_REQUEST['personid']);
			$personid = mysqli_real_escape_string($con, $personid);
			//aktuális adatok lekérdezése az egyeztetés miatt (jelszó, felhasználónév)
			$query = "SELECT * FROM users WHERE id='".$personid."'";
			$result2 = mysqli_query($con, $query) or die(mysql_error());
			$row = mysqli_fetch_assoc($result2);
			$current_username = $row['username'];
			$current_password = $row['password']; //ez md5 -ben van


			//Ha minden ki van töltve
			$username = stripslashes($_REQUEST['username']);
			$username = mysqli_real_escape_string($con, $username);
			$email = stripslashes($_REQUEST['email']);
			$email = mysqli_real_escape_string($con, $email);


			$query = "SELECT * FROM users WHERE username='".$username."'";
			$result = mysqli_query($con, $query) or die(mysql_error());
			
			$rows = mysqli_num_rows($result);

			if ($rows != 0 AND $current_username <> $username) {
				//Már létezik ilyen felhasználónév vagy e-mail
				$hiba = 2;
			} else {
				$password = stripslashes($_REQUEST['password']);
				$password = mysqli_real_escape_string($con, $password);
				$passwordc = stripslashes($_REQUEST['passwordc']);
				$passwordc = mysqli_real_escape_string($con, $passwordc);
                if ($password != $passwordc) {
                    //Nem egyezik a két jelszó
                    $hiba = 3;
                } else {
                    $lastname = stripslashes($_REQUEST['lastname']);
                    $lastname = mysqli_real_escape_string($con, $lastname);
                    $firstname = stripslashes($_REQUEST['firstname']);
                    $firstname = mysqli_real_escape_string($con, $firstname);
					$position = stripslashes($_REQUEST['position']);
                    $position = mysqli_real_escape_string($con, $position);
                    $address = stripslashes($_REQUEST['address']);
                    $address = mysqli_real_escape_string($con, $address);
                    $username = stripslashes($_REQUEST['username']);
                    $username = mysqli_real_escape_string($con, $username);
                    $numbersOfChildren = stripslashes($_REQUEST['numbersOfChildren']);
                    $numbersOfChildren = mysqli_real_escape_string($con, $numbersOfChildren);
                    //Mehetnek az értékek az adatbázisba

                    // $query = "INSERT INTO users (username, password, firstname, lastname, address, role, email, status) 
                    //           VALUES ('$username', '".md5($password)."', '$firstname', '$lastname', '$address', '0', '$email', $position)"; //új felhasználó
					echo "$password";
					//ha a jelszó nincs kitöltve, akkor a régi kerül vissza
					if ($password == "") {
						$password = $current_password;
					} else {
						$password = md5($password);
					}
					echo "$password";
					$query = "UPDATE users SET password='$password', lastname='$lastname', firstname='$firstname', address='$address', email='$email', username='$username', status='$position'
							  WHERE id = '$personid'";

							   

                    $execute = mysqli_query($con, $query) or die(mysql_error());
                    
                    // $query = "SELECT id FROM users WHERE username='$username'"; //user id lekérdezése a céghez kapcsoláshoz
                    // $result  = mysqli_query($con, $query);
                    // $getinfo = mysqli_fetch_assoc($result);
                    // $userid = $getinfo['id'];
                    // $companyid = $extendeduserinfo['id']; // cég id (a létrehozó felhasználó adatai alapján)

                    // $query = "INSERT INTO c_members (c_id, u_id)
                    // VALUES ('$companyid', '$userid')"; // új felhasználó kapcsolása a céghez (c_members)
                    // $execute = mysqli_query($con, $query) or die(mysql_error());

					

                    // //annyiszor fut le a kód, ahány gyermek van
					// if ($numbersOfChildren <> 0) { //ha egyáltalán van gyermek
					// 	for($i=1; $i<=$numbersOfChildren; $i++){ 
					// 		$birthday = stripslashes($_REQUEST['child'.$i]);
					// 		$birthday = mysqli_real_escape_string($con, $birthday);
					// 		$query = "INSERT INTO p_child (p_id, birthday)
					// 		VALUES ('$userid', '$birthday')"; // gyerekek születésének dátuma hozzáadása (p_child)
					// 		$execute = mysqli_query($con, $query) or die(mysql_error());
					// 	} 
					// }

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
				Sikeres módosítás!
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
				Már regisztrált felhasználói profil!
			  </div>';
		break;
	}
}



?>

<div class="navigation2">
    <span class="navname">Lehetőségek</span>
        <ul>
            <li onClick="pageLoad('p_add')">Dolgozó felvétele</li>
            <li onClick="pageLoad('p_delete')">Dolgozó törlése</li>
            <li onClick="pageLoad('p_list')">Dolgozók listája</li>
            <li onClick="pageLoad('p_positions')">Beosztások kezelése</li>
        </ul>
</div>
<div id="content" class="content">
	<span class="navname">Dolgozói profilok szerkesztése</span><br>
	<span>A munkavállalók profiljának szerkesztése válasszon a baloldalon található menüpontok közül.</span>
</div>

<script>
	$(':root').css("--changeImage", "url('../svg/group_black_24dp.svg')");
</script>

<?php
    include_once ('bottom.php');
?>