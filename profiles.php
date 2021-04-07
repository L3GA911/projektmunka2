<?php
    include_once ('information.php');
    include_once ('menu.php');
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
			$query = "SELECT * FROM users WHERE username='".$username."' AND email='".$email."'";
			$result = mysqli_query($con, $query) or die(mysql_error());
			$rows = mysqli_num_rows($result);
			if ($rows != 0) {
				//Már létezik ilyen felhasználónév vagy e-mail
				$hiba = 2;
			} else {
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
                    $password = stripslashes($_REQUEST['password']);
                    $password = mysqli_real_escape_string($con, $password);
                    $passwordc = stripslashes($_REQUEST['passwordc']);
                    $passwordc = mysqli_real_escape_string($con, $passwordc);
                    $email = stripslashes($_REQUEST['email']);
                    $email = mysqli_real_escape_string($con, $email);
                    $numbersOfChildren = stripslashes($_REQUEST['numbersOfChildren']);
                    $numbersOfChildren = mysqli_real_escape_string($con, $numbersOfChildren);
                    //Mehetnek az értékek az adatbázisba

                    $query = "INSERT INTO users (username, password, firstname, lastname, role, email) 
                              VALUES ('$username', '".md5($password)."', '$fadminfirstn', '$fadminlastn', '0', '$email' )"; //új felhasználó
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
            <li onClick="pageLoad('p_add')">Dolgozó felvétele</li>
            <li onClick="pageLoad('p_delete')">Dolgozó törlése</li>
            <li onClick="pageLoad('p_list')">Dolgozók listája</li>
            <li onClick="pageLoad('p_edit')">Dolgozói profilok szerkesztése</li>
        </ul>
</div>
<div id="content" class="content">
    <span class="navname">Dolgozói profilok szerkesztése</span><br>
    <span>A munkavállalók profiljának szerkesztése válasszon a baloldalon található menüpontok közül.</span>
</div>
<?php
    include_once ('bottom.php');
?>