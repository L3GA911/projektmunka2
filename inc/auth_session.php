<?php
//Azonososítás
session_start();
	if ($_SESSION["logged_in"]){
		require('db.php');
		//a users táblából lekérünk minden adatot
		$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
		$result = mysqli_query($con, $query) or die(mysql_error());
		$userinfo = mysqli_fetch_assoc($result);
		$userid = $userinfo['id'];

		//létrehozunk egy kiterjesztett felhasználói infót a sima munkavállalóknak 3 táblából
		if ($userinfo['role'] == 0) {
			$query = "SELECT *, companys.id as firm_id FROM users INNER JOIN c_members ON users.id = c_members.u_id INNER JOIN companys ON c_members.c_id = companys.id WHERE users.id = '$userid'";
			$result = mysqli_query($con, $query) or die(mysql_error());
			$extendeduserinfo = mysqli_fetch_assoc($result);
			}
		//a cégfelelősöknek elegendő 2 táblából, mert ők a c_members-ben külön nincsenek is feltüntetve
		if ($userinfo['role'] == 1) {
			$query = "SELECT *, companys.id as firm_id FROM users INNER JOIN companys ON users.id = companys.owner_id WHERE users.id = '$userid'";
			$result = mysqli_query($con, $query) or die(mysql_error());
			$extendeduserinfo = mysqli_fetch_assoc($result);
			}

		//Személy korának lekérdezése
		$query = "SELECT TRUNCATE(DATEDIFF(CURRENT_DATE, birthday)/365,0) as Age FROM users WHERE id='$userid'";
		$result = mysqli_query($con, $query) or die(mysql_error());
		$row = mysqli_fetch_assoc($result);
		$person_age = $row['Age'];


		//Személy kiskorú gyermekeinek lekérdezése
		$query = "SELECT * FROM users
		JOIN p_child ON p_child.p_id = users.id
		WHERE users.id = '$userid' AND TRUNCATE(DATEDIFF(CURRENT_DATE, p_child.birthday)/365,0) < 16";
		$row = mysqli_fetch_assoc($result);
		$person_young_kids_count = mysqli_num_rows($result);

		//Szabadság kiszámítása
		$person_basefreeday = 20;
		$person_plusfreeday = 0;
		if ($person_age >= 25) {$person_plusfreeday++;}
		if ($person_age >= 28) {$person_plusfreeday++;}
		if ($person_age >= 31) {$person_plusfreeday++;}
		if ($person_age >= 33) {$person_plusfreeday++;}
		if ($person_age >= 35) {$person_plusfreeday++;}
		if ($person_age >= 37) {$person_plusfreeday++;}
		if ($person_age >= 39) {$person_plusfreeday++;}
		if ($person_age >= 41) {$person_plusfreeday++;}
		if ($person_age >= 43) {$person_plusfreeday++;}
		if ($person_age >= 45) {$person_plusfreeday++;}

		$person_kidsfreeday = 0;

		if ($person_young_kids_count = 1) {$person_kidsfreeday = 2;}
		if ($person_young_kids_count = 2) {$person_kidsfreeday = 4;}
		if ($person_young_kids_count >= 3) {$person_kidsfreeday = 7;}


		$person_freedays_sum = $person_basefreeday+$person_plusfreeday+$person_kidsfreeday;

		//Felhasznált szabadságok
		$query = "SELECT * FROM freedays
		WHERE user_id = '$userid'";
		$person_used_freedays_count = mysqli_num_rows($result);

		//Maradék
		$person_freedays = $person_freedays_sum - $person_used_freedays_count;

	} else {
		header("Location: login.php");
		exit(); 
	}
	?>
