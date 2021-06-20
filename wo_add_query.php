<?php	
	require ('inc/auth_session.php');
	
	$position = $extendeduserinfo['pos_id'];
	$worker_firm = $extendeduserinfo['firm_id'];
	
	//Jogosultság ellenőrzése
	if ($userinfo['role'] != 0) {
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
			$reserved_date = 0;
			$freedays_fault  = 0; //alapérték
			
			while ($date != false){
				if (mysqli_num_rows($result) != 0){
					while ($row = $result->fetch_assoc()){
						if ($row['date'] != $date){
							$reserved_date = 0;
						}
						else if ($row['date'] == $date) {
							$reserved_date = 1;
							break 2;
						}
					}
					$date_array[] = $date;
					$date = strtok(",");
				}
				else {echo 'Nincs az adatbázisban rekord.'; break;}
			}					
			if ($reserved_date == 0){
				$sub_query = "SELECT COUNT(date) as date_nums,
									 date, 
									 positions.maxfreedays as maxdays
							  FROM freedays
							  INNER JOIN c_members ON freedays.user_id = c_members.u_id
							  INNER JOIN companys ON c_members.c_id = companys.id
							  INNER JOIN positions ON companys.id = positions.c_id
							  WHERE companys.id = $worker_firm AND positions.id = $position
							  GROUP BY date";
							  							  
				$sub_result = mysqli_query($con, $sub_query);
				foreach ($date_array as $value) {
					while ($sub_row = $sub_result->fetch_assoc()){
						if($sub_row['date'] != $value){
							$freedays_fault = 0;		
						}
						else if ($sub_row['date'] == $value && $sub_row['date_nums'] < $sub_row['maxdays']){
							$freedays_fault = 0;		
						}
						else {
							$freedays_fault = 1;		
							break 2;
						}
					}
				}
				if ($freedays_fault == 0){
					foreach ($date_array as $value){
						$query_insert = "INSERT INTO freedays (date, user_id) 
										 VALUES ('$value', '$userid')";
						$execute = mysqli_query($con, $query_insert) or die(mysql_error());
					}
					$alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
					$alert .='<button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>';
					$alert .='A kérelem beküldése sikeres volt.</div>';
					echo $alert;
				}
				else if ($freedays_fault == 1){
					$alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
					$alert .='<button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>';
					$alert .= 'Egy vagy több dátum esetében elérte a szabadság limitet.</div>';
					echo $alert;
				}
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
<script>
	console.log(<?=$position;?>);
	console.log(<?=$worker_firm;?>);
</script>