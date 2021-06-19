<?php	
	require ('inc/auth_session.php');

	//Jogosultság ellenőrzése
	if ($userinfo['role'] != 0) {
		echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
		exit();
	}
	
	//szabadság törlése
	@$fd_id = $_REQUEST['fd_id'];

	if (isset($fd_id)) {
		//SQL kapcsolat létrehozása
		$query = "DELETE FROM freedays WHERE id='$fd_id'";
		$result = mysqli_query($con, $query) or die(mysql_error());
		$alert = '<div id="message" class="alert alert-success alert-dismissible fade show" role="alert">';
		$alert .='<button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>';
		$alert .='Sikeres törlés.</div>';
		echo $alert;
	}
	$query = "SELECT id,date,accepted FROM freedays WHERE user_id = '$userid'";
	$result  = mysqli_query($con, $query);

?>
<?php require('inc/wo_delete.php'); ?>
