<?php
require ('inc/auth_session.php');
//Jogosultság ellenőrzése
if ($userinfo['role'] != 2) {
	echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
	exit();
}
?>
<span class="navname">Új cég rögzítése</span>
<ui>
    <li>A cégfelelős az a személy, aki a dolgozók felvételéhez, törléséhez, valamint szabadságuk elfogadásához, elutasításához szükséges jogosultságokkal rendelkezik.</li>
    <li>A cégfelelős a dolgozók felvétele során képes másik személy számára is "cégfelelős" státuszt adni.</li>
</ui>
<div class="content_container">
    <div class="form_content">
        <form action="" method="post" autocomplete="off">
            <label for="firmname">Cégnév:</label><br>
            <input type="text" id="firmname" name="firmname" required placeholder="Cégnév"><br>
            <label for="cform">Cégforma:</label><br>
            <select id="cform" name="cform">
                <option value="" selected disabled>Kérem válasszon...</option>
                <option value="1">Kft.</option>
                <option value="2">Bt.</option>
                <option value="3">Nyrt.</option>
                <option value="4">Zrt.</option>
                <option value="5">Kkt.</option>
                <option value="6">EV.</option>
            </select><br>
            <label for="headquarters">Székhely</label><br>
            <input type="text" id="headquarters" name="headquarters" required placeholder="Székhely"><br>
            <label for="fadminlastn">Cégfelelős vezetékneve:</label><br>
            <input type="text" id="fadminlastn" name="fadminlastn" required placeholder="Vezetéknév"><br>
			<label for="fadminfirstn">Cégfelelős keresztneve:</label><br>
            <input type="text" id="fadminfirstn" name="fadminfirstn" required placeholder="Keresztnév"><br>
            <label for="username">Felhasználónév:</label><br>
            <input type="text" id="username" name="username" required placeholder="Felhasználónév"><br>
            <button class="button" type="button" onclick="getPW()">Véletlenszerű jelszó generálás</button></br>
            <label for="password">Jelszó:</label><br>
            <input type="password" id="password" name="password" required placeholder="Jelszó"><br>
		    <label for="passwordc">Jelszó megerősítése:</label><br>
            <input type="password" id="passwordc" name="passwordc" required placeholder="Jelsző megerősítése"><br>
            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" required placeholder="E-mail"><br>
            <div class="button_center">
                <button id="button" value="newfirm" name="newfirm" class="button">Rögzítés</button>
            </div>
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