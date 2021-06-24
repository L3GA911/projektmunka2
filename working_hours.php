<?php
    include_once ('information.php');
    include_once ('menu.php');
?>

<?php
//Munkaidő változás rögzítése
if (isset($_POST['workingHours'])) {
	//Adatok ellenőrzése
	$hiba = 0;
	if (
	($userinfo['role']==1) && 
	(isset($_POST['worker'])) && 
	(isset($_POST['date'])) && 
	(isset($_POST['type'])) && 
	(isset($_POST['offset']))
	) {

			$worker = stripslashes($_REQUEST['worker']);
			$worker = mysqli_real_escape_string($con, $worker);
					$date = stripslashes($_REQUEST['date']);
                    $date = mysqli_real_escape_string($con, $date);
					$type = stripslashes($_REQUEST['type']);
                    $type = mysqli_real_escape_string($con, $type);
					$offset = stripslashes($_REQUEST['offset']);
                    $offset = mysqli_real_escape_string($con, $offset);

					$query = "INSERT INTO workingdays (date, type, offset, u_id) 
					VALUES ('$date', '$type', '$offset', '$worker')"; //új felhasználó
		 			$execute = mysqli_query($con, $query) or die(mysql_error());
					 
		} else {
			$hiba = 1; 
		} //nincs kitöltve

//hibák kezelése
switch ($hiba) {
	case 0:
		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>
				Sikeres módosítás!
			  </div>';
		break;
	case 1:
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>
				Nincs kitöltve minden mező! 
			  </div>';
		break;
	case 2:
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>
				Már létező felhasználónév vagy e-mail cím!
			  </div>';
		break;
	case 3:
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>
				A jelszavak nem egyeznek!
			  </div>';
		break;
	case 4:
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>
				Már regisztrált felhasználói profil!
			  </div>';
		break;
	}
}
?>

<div class="navigation2">
    <span class="navname">Lehetőségek</span>
    <ul>
        <li onClick="pageLoad('w_dayoff')">Szabadságok kezelése</li>
        <li onClick="pageLoad('w_workinghours')">Munkaidők kezelése</li>
    </ul>
</div>
<div id="content" class="content">
    <span class="navname">Munkaidők szerkesztése</span><br>
    <span>
        A dolgozók munkaidejének szerkesztéséhez válasszon a bal oldali menüpontok közül.<br><br>
        A munkaidők kezelését a rendszer automatikusan végzi. Módosítás alkalmazása csak <br>abban az esetben szükséges, amennyiben a dolgozó
        eltért a rá vonatkozó műszak rendjétől.
    </span>
</div>
<script>
	$(':root').css("--changeImage", "url('../svg/hourglass_top_black_24dp.svg')");


</script>
<?php
    include_once ('bottom.php');
?>