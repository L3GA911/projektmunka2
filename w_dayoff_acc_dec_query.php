<?php	
	require ('inc/auth_session.php');
		
	//Jogosultság ellenőrzése
	if ($userinfo['role'] != 1) {
		echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
		exit();
	}
	
	@$date = $_REQUEST['date'];
	@$userid = $_REQUEST['userid'];
	@$aord = $_REQUEST['aord'];
	
	if(isset($date, $userid, $aord)){
		if ($aord == 1){
			$query = "UPDATE freedays SET accepted = $aord WHERE id = $date AND user_id = $userid";
			$alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
			$alert .='<button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>';
			$alert .='Sikeres elfogadás!';
		}
		else if ($aord == 2){
			$query = "UPDATE freedays SET accepted = $aord WHERE id = $date AND user_id = $userid";
			$alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
			$alert .='<button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>';
			$alert .='Sikeres visszautasítás!';

		}
		else {
			$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
			$alert .='<button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>';
			$alert .='Sikertelen művelet!';
		}
		$execute = mysqli_query($con, $query) or die(mysql_error());
		require('inc/dayoff_acc_dec.php');
	}
	else {echo 'Nincs szabadságkérvény.';}
echo $alert;
?>