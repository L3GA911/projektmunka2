<span class="navname">Dolgozó felvétele</span>
<div class="content_container">
    <div class="form_content">
        <form id="form" action="" method="post" autocomplete="off">
            <label for="lastname">A dolgozó vezetékneve:</label><br>
            <input type="text" id="lastname" name="lastname" required placeholder="Vezetéknév"><br>
			<label for="firstname">A dolgozó keresztneve:</label><br>
            <input type="text" id="firstname" name="firstname" required placeholder="Keresztnév"><br>
            <label for="address">A dolgozó  lakhely</label><br>
            <input type="text" id="address" name="address" required placeholder="Lakhely címe"><br>
            <label for="username">A dolgozó felhasználóneve:</label><br>
            <input type="text" id="username" name="username" required placeholder="Felhasználónév"><br>
<<<<<<< HEAD
            <button class="button" type="button" onclick="getPW()">Véletlenszerű jelszó generálás</button></br>
=======
>>>>>>> 69c4f844fff9b10ae66bef404b04f568cea1202e
            <label for="password">A dolgozó jelszava:</label><br>
            <input type="password" id="password" name="password" required placeholder="Jelszó"><br>
		    <label for="passwordc">Jelszó megerősítése:</label><br>
            <input type="password" id="passwordc" name="passwordc" required placeholder="Jelszó megerősítése"><br>
            <label for="email">A dolgozó e-mail címe:</label><br>
            <input type="email" id="email" name="email" required placeholder="E-mail"><br>
            <label for="numbersOfChildren">Kiskorú gyermekek száma:</label><br>
            <select id="numbersOfChildren" name="numbersOfChildren" onChange="addInput()">
                <option value="" selected disabled>Kérem válasszon...</option>
                <?php
                    for($i=1; $i<=10; $i++){ echo '<option value="'.$i.'">'.$i.'</option>';} 
                ?>
            </select><br>
        </form>
        <div class="button_center">
                <button type="submit" id="newperson" name="newperson" form="form" class="button">Rögzítés</button>
        </div>
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