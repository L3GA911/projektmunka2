<?php
require ('inc/auth_session.php');
//Jogosultság ellenőrzése
if ($userinfo['role'] != 1) {
	echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
	exit();
}

//Céghez tartozó pozíciók lekérdezése
$firm_id = $extendeduserinfo['firm_id'];
$query = "SELECT * FROM companys 
JOIN positions ON c_id = companys.id
WHERE companys.id = '$firm_id'";
$result = mysqli_query($con, $query) or die(mysql_error());
$users_count = $result->num_rows;


?>
<span class="navname">Beosztások kezelése</span>
<div class="content_container">
    <div id="makepos" class="form_content">
	<form>
			<div>
				<label for="position">Beosztás:</label><br>
				<input type="text" id="position" name="position" required placeholder="Beosztás"><br>
				<label for="posmaxfreedays">Megengedett egyidejű távollétek száma:</label><br>
				<input style="width:50px; padding: 2px;" min="1" type="number" value="1" id="posmaxfreedays" name="posmaxfreedays" required placeholder="">
			</div>
			<br>
			<button type="button" onclick="new_pos()" id="button" value="newpos" name="newpos" class="button">Létrehozás</button>
	</form>
    </div>
	<div class="table-responsive line">
		<?php
			$id = "ID";
			$position = "Beosztás";
			$maxfreedays = "Megengedett egyidejű távollét";
		?>
		<br>
	    <table id="table" class="table table-striped table-bordered table2 p_positions">
		  <thead class="table-dark">
		    <tr>
			  <th><?=$id;?></th>
			  <th><?=$position;?></th>
			  <th><?=$maxfreedays;?></th>
			  <th></th>
		    </tr>
		  </thead>
		  <tbody>
<?php
		while ($row = $result->fetch_assoc()) {
		$pos_id = $row["id"];
		$pos_name = $row["name"];
		$pos_maxfreedays = $row["maxfreedays"];

		echo'
		<tr>
			<td data-label="'.$id.'">'.$pos_id.'</td>
			<td data-label="'.$position.'">'.$pos_name.'</td>
			<td data-label="'.$maxfreedays.'">'.$pos_maxfreedays.'</td>
			<td><button onclick="pos_delete_p('.$pos_id.')" class="button_table">Törlés</button></td>
		</tr>';}  
?> 
		  </tbody>
	    </table>
	</div>  
</div>


<script type="text/javascript" src="js/editDataTable.js"></script>
<script type="text/javascript" src="js/Modal.js"></script>