<span class="navname">Felhasználó törlése</span>
<div class="content_container">
<?php
	$id = "ID";
	$vez_nev = "Vezetéknév";
	$ker_nev = "Keresztnév";
	$ceg_azon = "Céges azonosító";
	$ceg = "Cég";
?>
	  <table id="table" class="table table-striped table-bordered table2">
		<thead class="table-dark">
		  <tr>
			<th><?=$id;?></th>
			<th><?=$vez_nev;?></th>
			<th><?=$ker_nev;?></th>
			<th><?=$ceg_azon;?></th>
			<th><?=$ceg;?></th>
			<th></th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td data-label="<?=$id;?>">1</td>
			<td data-label="<?=$vez_nev;?>">Valaki</td>
			<td data-label="<?=$ker_nev;?>">Vagyok</td>
			<td data-label="<?=$ceg_azon;?>">123456</td>
			<td data-label="<?=$ceg;?>">Fantázia Kft.</td>
			<td data-label="">
				<button class="button_table">Törlés</button>
			</td>
		  </tr>
		  <tr>
			<td data-label="<?=$id;?>">1</td>
			<td data-label="<?=$vez_nev;?>">Valaki2</td>
			<td data-label="<?=$ker_nev;?>">Vagyok2</td>
			<td data-label="<?=$ceg_azon;?>">123456</td>
			<td data-label="<?=$ceg;?>">Fantázia Kft.</td>
			<td data-label="">
				<button class="button_table">Törlés</button>
			</td>
		  </tr>
		</tbody>
	  </table>
</div>

<script type="text/javascript" src="js/editDataTable.js"></script>	