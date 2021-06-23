<?php
require ('inc/auth_session.php');
//Jogosultság ellenőrzése
if ($userinfo['role'] != 2) {
	echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
	exit();
}
//SQL kapcsolat létrehozása

//Cégek lekérdezése
$query = "SELECT * FROM companys";
$result = mysqli_query($con, $query) or die(mysql_error());
echo '
<span class="navname">Felhasználó törlése</span>
<div class="content_container">
<div class="information_text">
    <span>Fontos információk</span><br><br>
    <span>A cégfelelős törlésével a cég is törlésre kerül minden hozzátartozó adattal együtt.</span><br><br>
	<span>A cégfelelős nem törölhető, amíg vannak egyéb dolgozók a cégnél.</span>
</div>
<div class="dropdown">
		  <button onclick="open_list()" class="dropbtn">Cég kiválasztása</button>
		  <div id="dropdown_list" class="dropdown-content">
			<input type="text" placeholder="Keresés..." id="dropdown_search" onkeyup="filterFunction()">';
			while ($row = $result->fetch_assoc()) { //Cégnevek betöltése
				$firm_id = $row["id"];
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
				$firm_name = $row["name"]." ".$form_id_tostring;
				echo'
				<a href="#" onclick="list_firm_users('.$firm_id.');open_list()">'.$firm_name.'</a>
				';
			}
			echo '
		  </div>
		</div><br>
		<div id="list"></div>
</div>';
?>
<div class="alert_box"></div>
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog"></div>
</div>
<script type="text/javascript" src="js/editDataTable.js"></script>	