<?php
require ('inc/auth_session.php');
//Jogosultság ellenőrzése
if ($userinfo['role'] != 2) {
	echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
	exit();
}
//-----------------------------EZ A PHP FÁJL KEZELI LEKÉRDEZÉSEKET-------------------------

//---------------------------------------------------------CÉG TAGOK BETÖLTÉSE--------------------------------------------------------------------------
@$firm_id = $_REQUEST['firm_id']; //list_firm_users
if (isset($firm_id)) {
//SQL kapcsolat létrehozása

//Normál felhasználók lekérdezése
$query = "SELECT *, companys.id as firm_id FROM companys 
JOIN c_members ON c_id = companys.id
JOIN users ON u_id = users.id
WHERE companys.id = '$firm_id'";
$result = mysqli_query($con, $query) or die(mysql_error());
$users_count = $result->num_rows;

//Cégfelelős felhasználók lekérdezése
$query2 = "SELECT *, companys.id as firm_id FROM companys 
JOIN users ON users.id = companys.owner_id
WHERE companys.id = '$firm_id'";
$result2 = mysqli_query($con, $query2) or die(mysql_error());

//Cégek lekérdezése
$query2 = "SELECT *, companys.id as firm_id FROM companys 
JOIN users ON users.id = companys.owner_id
WHERE companys.id = '$firm_id'";
$result2 = mysqli_query($con, $query2) or die(mysql_error());

$firmid = "ID";
$lastname = "Vezetéknév";
$firstname = "Keresztnév";
$position = "Pozíció";
$firm = "Cég";

echo '
<table id="table" class="table table-striped table-bordered table2 user_delete_size">
<thead class="table-dark">
  <tr>
	<th>'.$firmid.'</th>
	<th>'.$lastname.'</th>
	<th>'.$firstname.'</th>
	<th>'.$position.'</th>
	<th>'.$firm.'</th>
	<th></th>
  </tr>
</thead>
<tbody>';
//Cégfelelősök
while ($row = $result2->fetch_assoc()) {
	$user_id = $row["owner_id"];
	$person_firstname = $row["firstname"];
	$person_lastname = $row["lastname"];
	$person_status = $row["status"];
	$firm_form = $row["form_id"];
	switch ($firm_form) {
		case 1:
			$form_id_tostring = "Kft.";
			break;
		case 2:
			$form_id_tostring = "Bt.";
			break;	
		case 3:
			$form_id_tostring = "Nyrt.";
			break;
		case 4:
			$form_id_tostring = "Zrt.";
			break;	
		case 5:
			$form_id_tostring = "Kkt.";
			break;
		case 6:
			$form_id_tostring = "EV.";
			break;	
		}
	$person_firm = $row["name"]." ".$form_id_tostring;
	echo '
	<tr style="background-color: #ff9494;">
		<td data-label="'.$firmid.'">'.$user_id.'</td>
		<td data-label="'.$lastname.'">'.$person_lastname.'</td>
		<td data-label="'.$firstname.'">'.$person_firstname.'</td>
		<td data-label="'.$position.'">'.$person_status.'</td>
		<td data-label="'.$firm.'">'.$person_firm.'</td>
		<td>';
		if ($users_count == 0) {echo '<button onclick="user_delete_sa('.$user_id.')" class="button_table">Törlés</button>';} else {echo '<button style="color: grey;" disabled class="button_table">Törlés</button>';}
		echo'
		</td>
	</tr>';}
//Normál felhasználók
while ($row = $result->fetch_assoc()) {
$user_id = $row["u_id"];
$person_firstname = $row["firstname"];
$person_lastname = $row["lastname"];
$person_status = $row["status"];
$firm_form = $row["form_id"];
switch ($firm_form) {
	case 1:
		$form_id_tostring = "Kft.";
		break;
	case 2:
		$form_id_tostring = "Bt.";
		break;	
	case 3:
		$form_id_tostring = "Nyrt.";
		break;
	case 4:
		$form_id_tostring = "Zrt.";
		break;	
	case 5:
		$form_id_tostring = "Kkt.";
		break;
	case 6:
		$form_id_tostring = "EV.";
		break;	
	}
$person_firm = $row["name"]." ".$form_id_tostring;
echo '
<tr>
	<td data-label="'.$firmid.'">'.$user_id.'</td>
	<td data-label="'.$lastname.'">'.$person_lastname.'</td>
	<td data-label="'.$firstname.'">'.$person_firstname.'</td>
	<td data-label="'.$position.'">'.$person_status.'</td>
	<td data-label="'.$firm.'">'.$person_firm.'</td>
	<td>
	<button onclick="user_delete('.$user_id.",".$firm_id.')" class="button_table">Törlés</button>
	</td>
</tr>';}
	echo '
</tbody>
</table>';

}?>