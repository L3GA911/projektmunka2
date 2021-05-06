<span class="navname">Munkaidők kezelése</span>
<div class="content_container">
    <div class="form_content">
        <form action="" method="post" autocomplete="off">
			<select id="" class="" name="">
				<option value="" disabled selected>Hónap</option>
				<option value="1">március</option>
				<option value="2">április</option>
				<option value="3">május</option>
			</select>
			<select id="" class="" name="">
				<option value="" disabled selected>Dolgozó</option>
				<option value="1">Valaki Vagyok</option>
				<option value="2">Tatai Zoli</option>
			</select>
        </form>
    </div>
<?php
	$nap = "Nap";
	$kezdes = "Kezdés";
	$befejezes = "Befejezés";
	$tipus = "Típus";
?>
  <table id="table" class="table table-striped working_hours_size">
    <thead class="table-dark">
      <tr>
        <th><?=$nap;?></th>
        <th><?=$kezdes;?></th>
        <th><?=$befejezes;?></th>
        <th><?=$tipus;?></th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
	<?php
		  
	for ($i=1; $i<=31; $i++){
		echo '
			  <tr>
				<td data-label="'.$nap.'">'.$i.'</td>
				<td data-label="'.$kezdes.'">            
					<input type="time" id="startwork" name="startwork" value="06:00"><br>
				</td>
				<td data-label="'.$befejezes.'">            
					<input type="time" id="endwork" name="endwork" value="14:00"><br>
				</td>
				<td data-label="'.$tipus.'">
					<select id="tform" class="tform" name="tform">
						<option value="1">MUN</option>
						<option value="2">SZA</option>
						<option value="3">BET</option>
						<option value="4">SZN</option>
						<option value="4">MSZN</option>
						<option value="4">FSZ</option>
					</select>
				</td>        
				<td>
					<button class="button_table">Mentés</button>
				</td>
			  </tr>';
	}
	?>
    </tbody>
  </table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#table').DataTable({
			"ordering": false,
			"searching": false,
			"paging": false,
			"oLanguage": {
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