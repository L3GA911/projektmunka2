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
                    $address = stripslashes($_REQUEST['address']);
                    $address = mysqli_real_escape_string($con, $address);
                    $username = stripslashes($_REQUEST['username']);
                    $username = mysqli_real_escape_string($con, $username);
                    $numbersOfChildren = stripslashes($_REQUEST['numbersOfChildren']);
                    $numbersOfChildren = mysqli_real_escape_string($con, $numbersOfChildren);
                    //Mehetnek az értékek az adatbázisba

                    $query = "INSERT INTO users (username, password, firstname, lastname, role, email) 
                              VALUES ('$username', '".md5($password)."', '$firstname', '$lastname', '0', '$email' )"; //új felhasználó
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
                    for($i=1; $i<=$numbersOfChildren; $i++){ 
                        $birthday = stripslashes($_REQUEST['child'.$i]);
                        $birthday = mysqli_real_escape_string($con, $birthday);
                        $query = "INSERT INTO p_child (p_id, birthday)
                        VALUES ('$userid', '$birthday')"; // gyerekek születésének dátuma hozzáadása (p_child)
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
@$user_id = $_REQUEST['user_id']; //user_delete
if (isset($user_id)) {
	//SQL kapcsolat létrehozása
	$query = "DELETE FROM users WHERE id='$user_id'";
	$result = mysqli_query($con, $query) or die(mysql_error());
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