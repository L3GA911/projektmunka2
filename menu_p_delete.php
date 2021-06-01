<?php
require ('inc/auth_session.php');
//Jogosultság ellenőrzése
if ($userinfo['role'] != 1) {
	echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
	exit();
}

//Normál felhasználók lekérdezése
$firm_id = $extendeduserinfo['firm_id'];
$query = "SELECT *, companys.id as firm_id, users.id as person_id FROM companys 
JOIN c_members ON c_id = companys.id
JOIN users ON u_id = users.id
JOIN positions ON positions.id = users.status
WHERE companys.id = '$firm_id'";
$result = mysqli_query($con, $query) or die(mysql_error());
$users_count = $result->num_rows;



?>
<span class="navname">Dolgozó törlése</span>
<div class="content_container">
<?php
	$id = "ID";
	$vez_nev = "Vezetéknév";
	$ker_nev = "Keresztnév";
  $pozicio = "Pozíció";
	$felh_nev = "Felhasználónév";
?>

  <table id="table" class="table table-striped table-bordered table2 profiles_delete">
    <thead class="table-dark">
      <tr>
        <th><?=$id;?></th>
        <th><?=$vez_nev;?></th>
        <th><?=$ker_nev;?></th>
        <th><?=$felh_nev;?></th>
        <th><?=$pozicio;?></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
<?php
      
  while ($row = $result->fetch_assoc()) {
	$user_id = $row["person_id"];
	$person_firstname = $row["firstname"];
	$person_lastname = $row["lastname"];
  $person_username = $row["username"];
  $person_status = $row["name"];

  echo'
  <tr>
        <td data-label="<?=$id;?>">'.$user_id.'</td>
        <td data-label="<?=$vez_nev;?>">'.$person_firstname.'</td>
        <td data-label="<?=$ker_nev;?>">'.$person_lastname.'</td>
        <td data-label="<?=$felh_nev;?>">'.$person_username.'</td>
        <td data-label="<?=$pozicio;?>">'.$person_status.'</td>
        <td>
			<button onclick="user_delete_p('.$user_id.')" class="button_table">Törlés</button>
		</td>
      </tr>';}   
?>
    </tbody>
  </table>
</div>

<script type="text/javascript" src="js/editDataTable.js"></script>