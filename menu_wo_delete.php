<?php
require ('inc/auth_session.php');
//Jogosultság ellenőrzése
if ($userinfo['role'] != 0) {
	echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
	exit();
}
?>
<span class="navname">Szabadsági kérelem törlése</span>
<div class="content_container">
<?php
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
</div>
<script type="text/javascript" src="js/editDataTable.js"></script>	