<span class="navname">Cég törlése</span>
<div class="content_container">
	<div class="table-responsive">
		<?php
			$id = "ID";
			$cegnev = "Cégnév";
			$vezeto = "Vezető";
		?>
	  <table id="table" class="table table-striped table-bordered table2 firm_delete_size">
		<thead class="table-dark">
		  <tr>
			<th><?=$id;?></th>
			<th><?=$cegnev;?></th>
			<th><?=$vezeto;?></th>
			<th></th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td data-label="<?=$id;?>">133</td>
			<td data-label="<?=$cegnev;?>">Fantázia Kft.</td>
			<td data-label="<?=$vezeto;?>">Valaki Vagyok</td>
			<td>
				<button class="button_table">Törlés</button>
			</td>
		  </tr>
		  <tr>
			<td data-label="<?=$id;?>">1</td>
			<td data-label="<?=$cegnev;?>">Fantázia Kft.</td>
			<td data-label="<?=$vezeto;?>">Valaki Vagyok</td>
			<td>
				<button class="button_table">Törlés</button>
			</td>
		  </tr>
		</tbody>
	  </table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#table').DataTable({
			"oLanguage": {
				"oPaginate": {
					"sFirst": "Első oldal",
					"sPrevious": "Előző",
					"sNext": "Következő",
					"sLast": "Utolsó oldal"
					},
				"sSearch": "",
				"sSearchPlaceholder": "Keresés...",
				"sInfoEmpty": "Nincs rekord a táblázatban!",
				"sInfo": "",
				"sZeroRecords": "Nincs találat",
				"sLengthMenu": "_MENU_",
				"sInfoFiltered": "",
				"sEmptyTable": "Nincs rekord a táblázatban!"
			}
		});
	});
</script>