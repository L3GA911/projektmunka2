<?php
    include_once ('information.php');
    include_once ('menu.php');
?>

<?php

if (isset($_POST['modifyDatas'])) {
	//Adatok ellenőrzése
	$hiba = 0;
	if (
	($userinfo['role'] >= 0 ) && 
	(isset($_POST['lastname'])) && 
	(isset($_POST['firstname'])) && 
	(isset($_POST['address'])) && 
	(isset($_POST['password'])) && 
	(isset($_POST['passwordc'])) && 
	(isset($_POST['email']))
	) {
			//aktuális adatok lekérdezése az egyeztetés miatt (jelszó, felhasználónév)
			$query = "SELECT * FROM users WHERE id='".$userid."'";
			$result2 = mysqli_query($con, $query) or die(mysql_error());
			$row = mysqli_fetch_assoc($result2);
			$current_username = $row['username'];
			$current_password = $row['password']; //ez md5 -ben van

            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);
            $passwordc = stripslashes($_REQUEST['passwordc']);
            $passwordc = mysqli_real_escape_string($con, $passwordc);
            if ($password != $passwordc) {
                //Nem egyezik a két jelszó
                $hiba = 2;
            } else {
                $lastname = stripslashes($_REQUEST['lastname']);
                $lastname = mysqli_real_escape_string($con, $lastname);
                $firstname = stripslashes($_REQUEST['firstname']);
                $firstname = mysqli_real_escape_string($con, $firstname);
                $address = stripslashes($_REQUEST['address']);
                $address = mysqli_real_escape_string($con, $address);
                $email = stripslashes($_REQUEST['email']);
                $email = mysqli_real_escape_string($con, $email);
                //Mehetnek az értékek az adatbázisba

                //ha a jelszó nincs kitöltve, akkor a régi kerül vissza
                if ($password == "") {
                    $password = $current_password;
                } else {
                    $password = md5($password);
                }
                $query = "UPDATE users SET password='$password', lastname='$lastname', firstname='$firstname', address='$address', email='$email' WHERE id = '$userid'";
                $execute = mysqli_query($con, $query) or die(mysql_error());
                }
		} else {
			$hiba = 1; 
		} //nincs kitöltve

//hibák kezelése
switch ($hiba) {
	case 0:
		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>
				Adataid sikeresen módosultak!
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
              A jelszavak nem egyeznek!
			  </div>';
		break;
	}
}
?>

<div id="content" class="content">
    <span class="navname">Kezdőlap</span><br>
    <span>
        Tisztelt <strong><?= $userinfo['lastname'];?> <?= $userinfo['firstname'];?></strong>!</br>
        (Azonosító: <strong><?= $userinfo['id'];?></strong>)</br></br>

        Üdvözöli Önt a kisvállalatok számára létrehozott online munkaidő nyilvántartó rendszer.</br>
       
    </span>

    <?php
switch ($userinfo['role']) {
	case 0:
        echo '
        <hr>
        Az Ön szabadságadatai a következők:</br></br>
        <span>Életkor: <strong>'.$person_age.'</strong> év</span></br>
        <span>Kiskorú gyermekek száma (16 évnél fiatalabb): <strong>'.$person_young_kids_count.'</strong> fő</span></br>
        <span>Önnek összesen <strong>'.$person_basefreeday.'</strong> nap alapszabadsága van.</span></br>
        <span>Korából adódóan ezen felül <strong>'.$person_plusfreeday.'</strong> nap pótszabadságra jogosult.</span></br>
        <span>Kiskorú gyermekei után további <strong>'.$person_kidsfreeday.'</strong> nap pótszabadság áll rendelkezésére.</span></br></br>
    
        <span>Felhasználható éves szabadsága: <strong>'.$person_freedays_sum.'</strong> nap</span></br>
        <span>Eddig felhasznált szabadsága: <strong>'.$person_used_freedays_count.'</strong> nap</span></br>
        <span>Felhasználható szabadsága: <strong>'.$person_freedays.'</strong> nap</span>';
		break;
	case 1:
        echo 'Ön cégfelelős státusszal rendelkezik a rendszerben, így a baloldali menüpontok segítségével lehetősége van:
        <ul style="margin-left: 20px; margin-top: 10px;">
        <li>Munkavállaló felvételéhez/törléséhez</li>
        <li>Munkavállaló adatainak módosításához</li>
        <li>Munkavállalói pozíció felvételéhez/törléséhez</li>
        <li>Kérvényezett szabadság elfogadásához/elutasításához</li>
        <ul>
        </br></br>
        ';
		break;
	case 2:
        echo 'Ön Superadmin státusszal rendelkezik a rendszerben, így a baloldali menüpontok segítségével lehetősége van:
        <ul style="margin-left: 20px; margin-top: 10px;">
        <li>Új cég regisztrálásához/törléséhez</li>
        <li>Felhasználó törléséhez bármely cégből</li>
        <ul>
        </br></br>
        ';
		break;
	}
?>
</div>

<script>
	$(':root').css("--changeImage", "url('../svg/maps_home_work_black_24dp.svg')");
</script>
<?php
    include_once ('bottom.php');
    ?>