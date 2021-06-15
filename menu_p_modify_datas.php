<?php
require ('inc/auth_session.php');
//Jogosultság ellenőrzése
if ($userinfo['role'] != 1) {
	echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
	exit();
}

?>
<span class="navname">Adatmódosítás</span>
<div class="content_container">
    <div class="form_content">
        <form action="" method="post" autocomplete="off">
			<div>
				<label for="lastname">Vezetéknév:</label><br>
				<input type="text" id="lastname" name="lastname" required placeholder="Vezetéknév"><br>
				<label for="firstname">Keresztnév:</label><br>
				<input type="text" id="firstname" name="firstname" required placeholder="Keresztnév"><br>
				<label for="birthday">Születési idő:</label><br>
				<input type="date" id="birthday" name="birthday" required placeholder="Születési idő"><br>
				<label for="place">Lakhely:</label><br>
				<input type="text" id="place" name="place" required placeholder="Lakhely"><br>
				<label for="username">Felhasználónév:</label><br>
				<input type="text" id="username" name="username" required placeholder="Felhasználónév"><br>
				<label for="password">Jelszó:</label><br>
				<input type="password" id="password" name="password" required placeholder="Jelszó"><br>
				<label for="passwordc">Jelszó megerősítése:</label><br>
				<input type="password" id="passwordc" name="passwordc" required placeholder="Jelsző megerősítése"><br>
				<label for="email">E-mail:</label><br>
				<input type="email" id="email" name="email" required placeholder="E-mail">
			</div>
            <button id="button" value="" name="" class="button">Módosítás</button>
        </form>
    </div>
</div>
<script type="text/javascript" src="js/editDataTable.js"></script>
<script type="text/javascript" src="js/Modal.js"></script>