<script>
function list_firm_users(firm_id) {
		   $.ajax({url:"query_handler.php", type:"POST", data: ({firm_id: firm_id}), async:true, cache:false, success:function(result)
		{
			$("#list").html(result);
		}});
}
function user_delete(user_id, firm_id) {
		   $.ajax({url:"superadmin.php", type:"POST", data: ({user_id: user_id}), async:true, cache:false, success:function(result)
		{
			list_firm_users(firm_id); //a törlés után meghívjuk a függvényt
		}});
}
</script>
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
<ui>
    <li>A cégfelelős törlésével a cég is törlésre kerül minden hozzátartozó adattal együtt.</li>
	<li>A cégfelelős nem törölhető, amíg vannak egyéb dolgozók a cégnél.</li>
</ui>

<div class="content_container">
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

<script type="text/javascript" src="js/editDataTable.js"></script>	