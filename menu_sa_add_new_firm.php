
<span class="navname">Új cég regisztrálása - SuperAdmin</span>
<div class="content_container">
    <div class="form_content">
        <form action="" method="post" autocomplete="off">
            <label for="firmname">Cégnév:</label><br>
            <input type="text" id="firmname" name="firmname" required placeholder="Adja meg az új cég nevét..."><br>
            <label for="cform">Cégforma:</label><br>
            <select id="cform" name="cform">
                <option value="" selected disabled>Kérem válasszon...</option>
                <option value="1">Kft.</option>
                <option value="2">Bt.</option>
                <option value="3">Nyrt.</option>
                <option value="4">Zrt.</option>
                <option value="5">Kkt.</option>
                <option value="6">EV</option>
            </select><br>
            <label for="headquarters">Székhely</label><br>
            <input type="text" id="headquarters" name="headquarters" required placeholder="Adja meg az új cég székhelyét..."><br>
            <label for="fadminlastn">A cég felelős vezetékneve:</label><br>
            <input type="text" id="fadminlastn" name="fadminlastn" required placeholder="Adja meg a cég felelős személyét..."><br>
			<label for="fadminfirstn">A cég felelős keresztneve:</label><br>
            <input type="text" id="fadminfirstn" name="fadminfirstn" required placeholder="Adja meg a cég felelős személyét..."><br>
            <label for="username">Felhasználónév:</label><br>
            <input type="text" id="username" name="username" required placeholder="Felelős személy felhasználóneve..."><br>
            <label for="password">Jelszó:</label><br>
            <input type="password" id="password" name="password" required placeholder="Felelős személy jelszava..."><br>
		    <label for="password">Jelszó megerősítése:</label><br>
            <input type="password" id="passwordc" name="passwordc" required placeholder="Jelsző megerősítése.."><br>
            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" required placeholder="Felelős személy e-mail címe..."><br>
            <div class="button_center">
                <button id="button" value="newfirm" name="newfirm" class="button">Regisztrálása</button>
            </div>
        </form>
    </div>
</div>