<?php	
	require ('inc/auth_session.php');

	//Jogosultság ellenőrzése
	if ($userinfo['role'] == 2) {
		echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
		exit();
	}
	//Szabadság kérvényezéses
	if (isset($_POST['freedays_dates'], $_POST['user_id'])) {
		if ($_POST['freedays_dates'] != null and $_POST['user_id'] != null){
			$dates_input = $_POST['freedays_dates'];
			$date = strtok($dates_input, ",");  
		
			$query = "SELECT date FROM freedays WHERE user_id = '$userid'";
			$result  = mysqli_query($con, $query);
		
			while ($date != false){
				while ($row = $result->fetch_assoc()){
					if($row['date'] != $date){
						$reserved_date = 0;
					}
					else {
						$reserved_date = 1;
						break 2;
					}
				}	
				$date_array[] = $date;
				$date = strtok(",");
			}
		
			if ($reserved_date === 0){
				for($i=0;$i<count($date_array);$i++){
					$query_insert = "INSERT INTO freedays (date, user_id) VALUES ('$date_array[$i]', '$userid')";
					$execute = mysqli_query($con, $query_insert) or die(mysql_error());
				}
				$alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
				$alert .='<button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>';
				$alert .='A kérelem beküldése sikeres volt.</div>';
				echo $alert;
			}	
			else if($reserved_date == 1){
				$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
				$alert .='<button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>';
				$alert .= 'Egy vagy több dátum már kérvényezve van.</div>';
				echo $alert;
			}
		}
		else {
			$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
			$alert .='<button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>';
			$alert .= 'Nem adott meg dátumot!</div>';
			echo $alert;
		}

	}
	else {
		$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
		$alert .='<button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>';
		$alert .= 'Rendszerhiba! A kérelem beküldése sikertelen.</div>';
		echo $alert;
	}
?>