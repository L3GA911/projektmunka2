<span class="navname">Dolgozó felvétele</span>
<div class="content_container">
    <div class="form_content">
        <form id="form" action="" method="post" autocomplete="off">
            <label for="lastname">Vezetékneve:</label><br>
            <input type="text" id="lastname" name="lastname" required placeholder="Adja meg a vezetéknevét..."><br>
			<label for="firstname">Keresztneve:</label><br>
            <input type="text" id="firstname" name="firstname" required placeholder="Adja meg a keresztnevét..."><br>
            <label for="address">Személy címe</label><br>
            <input type="text" id="address" name="address" required placeholder="Adja meg a személy címét..."><br>
            <label for="username">Felhasználónév:</label><br>
            <input type="text" id="username" name="username" required placeholder="A személy felhasználóneve..."><br>
            <label for="password">Jelszó:</label><br>
            <input type="password" id="password" name="password" required placeholder="A személy jelszava..."><br>
		    <label for="passwordc">Jelszó megerősítése:</label><br>
            <input type="password" id="passwordc" name="passwordc" required placeholder="Jelsző megerősítése.."><br>
            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" required placeholder="A személy e-mail címe..."><br>
            <label for="numbersOfChildren">Kiskorú gyermekek száma:</label><br>
            <select id="numbersOfChildren" name="numbersOfChildren" onChange="addInput()">
                <option value="" selected disabled>Kérem válasszon...</option>
                <?php
                    for($i=1; $i<=10; $i++){ echo '<option value="'.$i.'">'.$i.'</option>';} 
                ?>
            </select><br>
        </form>
        <div class="button_center">
                <button type="submit" id="newperson" name="newperson" form="form" class="button">Regisztrálása</button>
        </div>
    </div>
</div>