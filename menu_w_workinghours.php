<span class="navname">Munkaidők kezelése</span>
<div class="content_container">
    <div class="form_content">
        <form action="" method="post" autocomplete="off">
			<div>
				<label for="worker">Válasszon dolgozót:</label><br>
				<select id="worker" name="worker">
					<option value="" selected disabled>Kérem válasszon...</option>
					<option value="1">Ihász Viktor</option>
					<option value="2">Lengyel Gábor</option>
				</select><br>
				<label for="date">Válasszon dátumot:</label><br>
				<input type="date" id="date" name="date" required placeholder="Dátum"><br>
				<label for="daytype">Típus:</label><br>
				<select id="daytype" name="daytype">
					<option value="" selected disabled>Kérem válasszon...</option>
					<option value="1">MSZN</option><!--Munkaszüneti nap-->
					<option value="2">SZAB</option><!--Szabadság-->
					<option value="3">FNSZ</option><!--Fizetetlen-->
					<option value="4">TÚL</option><!--Túlóra-->
				</select><br>
				<label for="firmname">Órák: (csak túlóra esetén)</label><br>
				<input type="text" id="firmname" name="firmname" required placeholder="Túlórák"><br>
			</div>
            <button id="button" value="newfirm" name="newfirm" class="button">Mentés</button>
        </form>
    </div>
</div>