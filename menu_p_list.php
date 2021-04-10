<span class="navname">Dolgozó listája</span>
<div class="content_container">
  <table id="table" class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Vezetéknév</th>
        <th>Keresztnév</th>
        <th>Felhasználónév</th>
        <th>Cím</th>
        <th>Jelszó</th>
        <th>E-mail</th>
        <th>Gyerekek száma</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Valaki</td>
        <td>Vagyok</td>
        <td>HyperBolha1234</td>
        <td>1234 Hely, Valami utca 46.</td>
        <td>**********</td>
        <td>HyperBolha1234@gmail.com</td>
        <td>5</td>
        <td>
			<button id="edit" class="button_table">Szerkesztés</button>
		</td>
      </tr>
    </tbody>
  </table>
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