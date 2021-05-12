<span class="navname">Beosztások kezelése</span>
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
    <div id="makepos" class="form_content">
        <form action="" method="post" autocomplete="off">
			<div>
				<label for="position">Beosztás:</label><br>
				<input type="text" id="position" name="position" required placeholder="Beosztás">
			</div>
			<br>
			<button id="button" value="newpos" name="newpos" class="button">Létrehozás</button>
        </form>
    </div>
	<div class="table-responsive line">
		<?php
			$id = "ID";
			$position = "Beosztás";
		?>
		<br>
	    <table id="table" class="table table-striped table-bordered table2 p_positions">
		  <thead class="table-dark">
		    <tr>
			  <th><?=$id;?></th>
			  <th><?=$position;?></th>
			  <th></th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr>
			  <td data-label="<?=$id;?>">1</td>
			  <td data-label="<?=$position;?>">Üzemvezető</td>
			  <td>
				  <button class="button_table">Törlés</button>
			  </td>
		    </tr>
		  </tbody>
	    </table>
	</div>  
</div>

<div id="editWindow" class="modal">
	<div class="modal-content">
		<span class="close">&times;</span>
		<span class="navname">Valaki Vagyok profilja</span>
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
					</select>
				</form>
			</div>
		</div>
		<div class="pre_button_center">
			<button type="submit" id="newperson" name="newperson" form="form" class="button">Rögzítés</button>
		</div>
	</div>
</div>


<script type="text/javascript" src="js/editDataTable.js"></script>
<script type="text/javascript" src="js/Modal.js"></script>