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