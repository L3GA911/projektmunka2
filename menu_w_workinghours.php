<?php
require ('inc/auth_session.php');
//Jogosultság ellenőrzése
if ($userinfo['role'] != 1) {
	echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
	exit();
} ?>

<?php
//Normál felhasználók lekérdezése
$firm_id = $extendeduserinfo['firm_id'];
$query = "SELECT *, companys.name as firm_name, companys.id as firm_id FROM companys 
JOIN c_members ON c_id = companys.id
JOIN users ON u_id = users.id
WHERE companys.id = '$firm_id'";
$result = mysqli_query($con, $query) or die(mysql_error());
?>

<span class="navname">Munkaidők kezelése</span>
<div class="content_container">
    <div class="form_content">
        <form action="" method="post" autocomplete="off">
			<div>
				<label for="worker">Válasszon dolgozót:</label><br>
				<select id="worker" required name="worker">
				<option value="" selected disabled>Kérem válasszon...</option>
				<?php
				
				while ($row = $result->fetch_assoc()) {

				$user_id = $row["u_id"];
				$person_firstname = $row["firstname"];
				$person_lastname = $row["lastname"];
					echo '
					<option value="'.$user_id.'">'.$person_lastname.' '.$person_firstname.' ('.$user_id.')</option>';
				}?>
				</select><br>
				<label for="date">Válasszon dátumot:</label><br>
				<input type="date" id="date" name="date" required placeholder="Dátum"><br>
				<label for="type">Típus:</label><br>
				<select required id="type" name="type">
					<option value="" selected disabled>Kérem válasszon...</option>
					<option value="1">Munkaszüneti nap</option><!--Munkaszüneti nap-->
					<option value="2">Fizetetlen szabadság</option><!--Fizetetlen-->
					<option value="3">Munkaóra változás</option><!--Túlóra-->
				</select><br>
				<label for="offset">Eltérés:</label><br>
				<input type="number" step="0.5" id="offset" value="0" name="offset" required placeholder="Túlórák"><br>
			</div>
            <button id="button" value="workingHours" name="workingHours" class="button">Mentés</button>
        </form>
    </div>
</div>