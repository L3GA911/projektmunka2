<?php
//Azonososítás
session_start();
	if ($_SESSION["logged_in"]){
		require('db.php');
		//a users táblából lekérünk minden adatot
		$query = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
		$result = mysqli_query($con, $query) or die(mysql_error());
		$userinfo = mysqli_fetch_assoc($result);
		//létrehozunk egy kiterjesztett felhasználói infót a sima munkavállalóknak 3 táblából
		if ($userinfo['role'] == 0) {
			$query = "SELECT *, companys.id as firm_id FROM users INNER JOIN c_members ON users.id = c_members.u_id INNER JOIN companys ON c_members.c_id = companys.id WHERE users.id=".$userinfo[id]."";
			$result = mysqli_query($con, $query) or die(mysql_error());
			$extendeduserinfo = mysqli_fetch_assoc($result);
			}
		//a cégfelelősöknek elegendő 2 táblából, mert ők a c_members-ben külön nincsenek is feltüntetve
		if ($userinfo['role'] == 1) {
			$query = "SELECT *, companys.id as firm_id FROM users INNER JOIN companys ON users.id = companys.owner_id WHERE users.id=".$userinfo[id]."";
			$result = mysqli_query($con, $query) or die(mysql_error());
			$extendeduserinfo = mysqli_fetch_assoc($result);
			}
	} else {
		header("Location: login.php");
		exit(); 
	}
	?>
