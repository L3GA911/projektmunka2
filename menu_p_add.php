<span class="navname">Dolgozó felvétele</span>
<div class="content_container">
    <div class="form_content">
        <form id="form" action="" method="" autocomplete="off">
            <label for="lastname">Vezetéknév:</label><br>
            <input type="text" id="lastname" name="lastname" required placeholder="Adja meg a vezetéknevet..."><br>
            <label for="firstname">Keresztnév:</label><br>
            <input type="text" id="firstname" name="firstname" required placeholder="Adja meg a keresztnevet..."><br>
            <label for="birthday">Születésnap:</label><br>
            <input type="date" id="birthday" name="birthday"> <br>
            <label for="cform">Kiskorú gyermekek száma:</label><br>
            <select id="numbersOfChildren" name="cform" onChange="addInput()">
                <option value="" selected disabled>Kérem válasszon...</option>
                <?php
                    for($i=1; $i<=10; $i++){ echo '<option value="'.$i.'">'.$i.'</option>';} 
                ?>
            </select><br>
        </form>
        <div class="button_center">
                <button type="submit" form="form" class="button">Regisztrálása</button>
        </div>
    </div>
</div>