<span class="navname">Dolgozó törlése</span>
<div class="content_container">
<?php
	$id = "ID";
	$vez_nev = "Vezetéknév";
	$ker_nev = "Keresztnév";
	$felh_nev = "Felhasználónév";
?>

  <table id="table" class="table table-striped table-bordered table2 profiles_delete">
    <thead class="table-dark">
      <tr>
        <th><?=$id;?></th>
        <th><?=$vez_nev;?></th>
        <th><?=$ker_nev;?></th>
        <th><?=$felh_nev;?></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td data-label="<?=$id;?>">1</td>
        <td data-label="<?=$vez_nev;?>">Valaki</td>
        <td data-label="<?=$ker_nev;?>">Vagyok</td>
        <td data-label="<?=$felh_nev;?>">HyperBolha1234</td>
        <td>
			<button class="button_table">Törlés</button>
		</td>
      </tr>      
	  <tr>
        <td data-label="<?=$id;?>">1</td>
        <td data-label="<?=$vez_nev;?>">Valaki</td>
        <td data-label="<?=$ker_nev;?>">Vagyok</td>
        <td data-label="<?=$felh_nev;?>">HyperBolha1234</td>
        <td>
			<button class="button_table">Törlés</button>
		</td>
      </tr>
	  <tr>
        <td data-label="<?=$id;?>">1</td>
        <td data-label="<?=$vez_nev;?>">Valaki</td>
        <td data-label="<?=$ker_nev;?>">Vagyok</td>
        <td data-label="<?=$felh_nev;?>">HyperBolha1234</td>
        <td>
			<button class="button_table">Törlés</button>
		</td>
      </tr>
    </tbody>
  </table>
</div>

<script type="text/javascript" src="js/editDataTable.js"></script>