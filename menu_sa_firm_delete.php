<span class="navname">Cég törlése</span>
<div class="content_container">
  <table id="table" class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Cégnév</th>
        <th>Vezető</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Fantázia Kft.</td>
        <td>Valaki Vagyok</td>
        <td>
			<button class="button_table">Törlés</button>
		</td>
      </tr>
    </tbody>
  </table>
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