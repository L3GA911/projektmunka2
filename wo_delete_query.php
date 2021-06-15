<?php	
	require ('inc/auth_session.php');

	//Jogosultság ellenőrzése
	if ($userinfo['role'] != 0) {
		echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
		exit();
	}
	
	//szabadság törlése
	$fd_id = $_REQUEST['fd_id'];

	if (isset($fd_id)) {
		//SQL kapcsolat létrehozása
		$query = "DELETE FROM freedays WHERE id='$fd_id'";
		$result = mysqli_query($con, $query) or die(mysql_error());
		$alert = '<div id="message" class="alert alert-danger alert-dismissible fade show" role="alert">';
		$alert .='<button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>';
		$alert .='Sikeres törlés.</div>';
		echo $alert;
	}

	$id = "ID";
	$datum = "Kérvényezett szabadság napja";
?>
<table id="table" class="table table-striped table-bordered table2 wo_delete_size">
    <thead class="table-dark">
      <tr>
        <th><?=$id;?></</th>
        <th><?=$datum;?></</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
	<?php
	$query = "SELECT id,date FROM freedays WHERE user_id = '$userid'";
	$result  = mysqli_query($con, $query);
	
	while ($row = $result->fetch_assoc()){ 
	?>
		<tr>
			<td data-label="<?=$id;?>"><?=$row['id'];?></td>
			<td data-label="<?=$datum;?>"><?=$row['date'];?></td>
			<td>
				<button class="button_table" onClick="freedays_delete(<?=$row['id'];?>)">Törlés</button>
			</td>
		</tr>
	<?php } ?>
    </tbody>
  </table>