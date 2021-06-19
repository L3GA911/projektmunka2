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
		$query_dates = "SELECT id, date FROM freedays WHERE user_id = ".$userid." AND accepted = 0" ;
		$result2  = mysqli_query($con, $query_dates);
		if (mysqli_num_rows($result2) != 0){
			while ($row2 = $result2->fetch_assoc()) { 
			?>
				<div class="panel_list">
					<span><?=$row2['date'];?></span>
					<button class="button_table" onClick="freedays_acc_dec(<?=$row2['id'];?>, <?=$userid;?>, 1)">Elfogadás</button>
					<button class="button_table" onClick="freedays_acc_dec(<?=$row2['id'];?>, <?=$userid;?>, 2)">Elutasítás</button>
				</div>
		<?php 
			}
		}
	else {echo 'Nincs szabadságkérvény.';}
	}
else {echo 'hiba';}
echo $alert;
?>