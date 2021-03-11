<span class="navname">Új cég regisztrálása - SuperAdmin</span>
<div class="content_container">
    <div class="form_content">
        <form action="" method="" autocomplete="off">
            <label for="firmname">Cégnév:</label><br>
            <input type="text" id="firmname" name="firmname" required placeholder="Adja meg az új cég nevét..."><br>
            <label for="cform">Cégforma:</label><br>
            <select id="cform" name="cform">
                <option value="" selected disabled>Kérem válasszon...</option>
                <option value="kft">Kft.</option>
                <option value="bt">Bt.</option>
                <option value="nyrt">Nyrt.</option>
                <option value="zrt">Zrt.</option>
                <option value="kkt">Kkt.</option>
                <option value="ev">EV</option>
            </select><br>
            <label for="headquarters">Székhely</label><br>
            <input type="text" id="headquarters" name="headquarters" required placeholder="Adja meg az új cég székhelyét..."><br>
            <label for="firmadmin">A cég felelős személye:</label><br>
            <input type="text" id="firmadmin" name="firmadmin" required placeholder="Adja meg a cég felelős személyét..."><br>
            <label for="username">Felhasználónév:</label><br>
            <input type="text" id="username" name="username" required placeholder="Felelős személy felhasználóneve..."><br>
            <label for="password">Jelszó:</label><br>
            <input type="password" id="password" name="password" required placeholder="Felelős személy jelszava..."><br>
            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" required placeholder="Felelős személy e-mail címe..."><br>
            <div class="button_center">
                <button class="button">Regisztrálása</button>
            </div>
        </form>
    </div>
</div>