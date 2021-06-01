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



//Céghez tartozó pozíciók lekérdezése
$query = "SELECT * FROM companys 
JOIN positions ON c_id = companys.id
WHERE companys.id = '$firm_id' AND positions.id <> -1";
$result2 = mysqli_query($con, $query) or die(mysql_error());
$pos_count = $result2->num_rows;
?>

<span class="navname">Dolgozó listája</span>
<div class="content_container">
<?php
	$id = "ID";
	$vez_nev = "Vezetéknév";
	$ker_nev = "Keresztnév";
	$felh_nev = "Felhasználónév";
	$cim = "Cím";
	$jelszo = "Jelszó";
	$email = "E-mail";
	$gyerekek = "Gyerekek száma";
?>
  <table id="table" class="table table-striped table-bordered table2 profiles_list_size">
    <thead class="table-dark">
      <tr>
        <th><?=$id;?></th>
        <th><?=$vez_nev;?></th>
        <th><?=$ker_nev;?></th>
        <th><?=$felh_nev;?></th>
        <th><?=$cim;?></th>
        <th><?=$email;?></th>
        <th><?=$gyerekek;?></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
<?php
  while ($row = $result->fetch_assoc()) {

	$person_id = $row["person_id"];
	$person_firstname = $row["firstname"];
	$person_lastname = $row["lastname"];
  $person_username = $row["username"];
  $person_status = $row["name"];
  $person_email = $row["email"];
  $person_address = $row["address"];

echo '
      <tr>
        <td data-label="'.$id.'">'.$person_id.'</td>
        <td data-label="'.$vez_nev.'">'.$person_lastname.'</td>
        <td data-label="'.$ker_nev.'">'.$person_firstname.'</td>
        <td data-label="'.$felh_nev.'">'.$person_username.'</td>
        <td data-label="'.$cim.'">'.$person_address.'</td>
        <td data-label="'.$email.'">'.$person_email.'</td>
        <td data-label="'.$gyerekek.'">5</td>
        <td>
			<button id="edit" class="button_table">Szerkesztés</button>
		</td>
      </tr> 


      <div id="editWindow" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <span class="navname">'.$person_lastname." ".$person_firstname.'</span>
        <div class="content_container">
          <div class="form_content">
            <form id="form" action="" method="post" autocomplete="off">
              <div>

                <label for="lastname">A dolgozó vezetékneve:</label><br>
                <input type="text" id="lastname" name="lastname" value="'.$person_lastname.'" required placeholder="Vezetéknév"><br>
                <label for="firstname">A dolgozó keresztneve:</label><br>
                <input type="text" id="firstname" name="firstname" value="'.$person_firstname.'" required placeholder="Keresztnév"><br>
                <label for="address">A dolgozó  lakhely</label><br>
                <input type="text" id="address" name="address" value="'.$person_address.'" required placeholder="Lakhely címe"><br>
                <label for="username">A dolgozó felhasználóneve:</label><br>
                <input type="text" id="username" name="username" value="'.$person_username.'" required placeholder="Felhasználónév"><br>
                <label for="username">A dolgozó beosztása:</label><br>
                <select value="'.$person_status.'" id="position" name="position">
                  ';

                  while ($row = $result2->fetch_assoc()) {
                  $pos_id = $row["id"];
                  $pos_name = $row["name"];
                  echo'
                  <option value="'.$pos_id.'">'.$pos_name.'</option>';
                  }

                echo'
                </select><br>
                <label for="password">A dolgozó jelszava:</label><br>
                <input type="password" id="password" name="password" required placeholder="Jelszó"><br>
                <label for="passwordc">Jelszó megerősítése:</label><br>
                <input type="password" id="passwordc" name="passwordc" required placeholder="Jelszó megerősítése"><br>
                <label for="email">A dolgozó e-mail címe:</label><br>
                <input type="email" id="email" name="email" value="'.$person_email.'" required placeholder="E-mail"><br>
                <label for="numbersOfChildren">Új gyermek felvitele:</label><br>
                <select id="numbersOfChildren" name="numbersOfChildren" onChange="addInput()">
                  <option value="" selected disabled>Kérem válasszon...</option>';
                    for($i=0; $i<=10; $i++){ echo '<option value="'.$i.'">'.$i.'</option>';} 
                echo'
                </select><br>
              </div>
              <button type="submit" id="modifyPerson" name="modifyPerson" form="form" class="button">Módosítás</button>
            </form>
          </div>
        </div>
      </div>
    </div>
';
    } 
?>     
    </tbody>
  </table>
</div>



<script type="text/javascript" src="js/editDataTable.js"></script>
<script type="text/javascript" src="js/Modal.js"></script>