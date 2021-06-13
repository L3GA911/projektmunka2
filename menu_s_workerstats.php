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
<span class="navname">Dolgozói statisztikák</span>
<div class="content_container">
	<div class="dropdown">
		<button onclick="open_list()" class="dropbtn">Dolgozó kiválasztása</button>
		<div id="dropdown_list" class="dropdown-content">
			<input type="text" placeholder="Keresés..." id="dropdown_search" onkeyup="filterFunction()">
			<a href="">Lengyel Gábor</a>
			<a href="">Ihász Viktor</a>
			<a href="">Valaki Vagyok</a>
		</div>
	</div><br>
	<span>Dolgozó: XY</span>
	<div id="chart_div"></div>
</div>
<script type="text/javascript" src="js/editDataTable.js"></script>