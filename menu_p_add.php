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
<span class="navname">Dolgozó felvétele</span>
<div class="content_container">
    <div class="form_content">
        <form id="form" action="" method="post" autocomplete="off" class="child_selector">
			<div>
				<label for="lastname" style="vertical-align: left;">A dolgozó vezetékneve:</label><br>
				<input type="text" id="lastname" name="lastname" required placeholder="Vezetéknév"><br>
				<label for="firstname">A dolgozó keresztneve:</label><br>
				<input type="text" id="firstname" name="firstname" required placeholder="Keresztnév"><br>
                <label for="birthday">A dolgozó születési ideje:</label><br>
				<input type="date" id="birthday" name="birthday" required placeholder="Születési idő"><br>
				<label for="position">A dolgozó pozíciója:</label><br>
                <select id="position" name="position">

                    <option selected disabled value="">Kérem válasszon...</option>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    $pos_id = $row["id"];
                    $pos_name = $row["name"];
                    echo'
                    <option value="'.$pos_id.'">'.$pos_name.'</option>';
                    }?>
                </select>
                <br>
                <label for="w_begindate">Munkaviszonyának kezdete:</label><br>
				<input type="month" id="w_begindate" name="w_begindate" required placeholder="Munkakezdés ideje"><br>
                <label for="address">A dolgozó munkaideje</label><br>
				<input type="time" id="starthour" value="08:00" name="starthour" required> - <input type="time" id="endhour" value="16:00" name="endhour" required><br>
				<label for="address">A dolgozó  lakhelye:</label><br>
				<input type="text" id="address" name="address" required placeholder="Lakhely címe"><br>
				<label for="username">A dolgozó felhasználóneve:</label><br>
				<input type="text" id="username" name="username" required placeholder="Felhasználónév"><br>
			</div>
            <button class="button btnmod" type="button" onclick="getPW()">Véletlenszerű jelszó generálás</button>
			<div>
				<label for="password">A dolgozó jelszava:</label><br>
				<input type="password" id="password" name="password" required placeholder="Jelszó"><br>
				<label for="passwordc">Jelszó megerősítése:</label><br>
				<input type="password" id="passwordc" name="passwordc" required placeholder="Jelszó megerősítése"><br>
				<label for="email">A dolgozó e-mail címe:</label><br>
				<input type="email" id="email" name="email" required placeholder="E-mail"><br>
				<label for="numbersOfChildren">Gyermekek száma:</label><br>
				<select id="numbersOfChildren" required name="numbersOfChildren" onChange="addInput()">
					<option value="" selected disabled>Kérem válasszon...</option>
					<?php
						for($i=0; $i<=10; $i++){ echo '<option value="'.$i.'">'.$i.'</option>';} 
					?>
				</select><br>
			</div>
			<button type="submit" id="newperson" name="newperson" form="form" class="button button_width javasq_button">Rögzítés</button>
        </form>
    </div>
</div>

<script>
        var password = document.getElementById("password");
        var passwordc = document.getElementById("passwordc");

        function generateP() {
            var pass = '';
            var str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' + 
                    'abcdefghijklmnopqrstuvwxyz0123456789@#$';
            for (i = 1; i <= 8; i++) {
                var char = Math.floor(Math.random()
                            * str.length + 1);
                pass += str.charAt(char)
            }
              
            return pass;
        }
  
        function getPW() {
            password.value = generateP();
            passwordc.value = password.value;
            alert("A generált jelszó: "+password.value);
        }
    </script>