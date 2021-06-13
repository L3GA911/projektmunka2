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
WHERE companys.id = '$firm_id' AND positions.id <> -1";
$result = mysqli_query($con, $query) or die(mysql_error());
$pos_count = $result->num_rows;

if ($pos_count == 0) {
    echo"<script type='text/javascript'>alert('A továbblépéshez először vegyél fel pozíciókat a rendszerbe!')</script>";
    echo"<script type='text/javascript'>pageLoad('p_positions')</script>";
    exit();
}
?>
<span class="navname">Elérhető szabadságok</span>
<div class="content_container">
fdsfsd
</div>