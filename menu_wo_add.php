<?php
	require ('inc/auth_session.php');

	//Jogosultság ellenőrzése
	if ($userinfo['role'] != 0) {
		echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
		exit();
	}
?>
<span class="navname">Szabadság kérvényezése</span>

<div class="content_container">
    <div class="form_content">
        <form id="date_picker" id="date_picker" action="wo_add_query.php" method="post" autocomplete="off">
			<div id="datepicker"></div>
			<input hidden type="text" name="freedays_dates" id="my_hidden_input">
			<input hidden type="text" name="user_id" id="my_hidden_input" value="<?=$userid;?>">
			<button id="button" class="button" type="submit" form="date_picker">Mentés</button>
        </form>
    </div>
</div>
<div id="modal"></div>
<script>

	form_ajax('#date_picker');
	
	$('#datepicker').datepicker({
		format: "yyyy-mm-dd",
		language: "hu",
		multidate: true,
		calendarWeeks: true,
		todayHighlight: true,
		clearBtn: true,
		startDate: '+1d'
	});
	
	$('#datepicker').on('changeDate', function() {
    $('#my_hidden_input').val(
        $('#datepicker').datepicker('getFormattedDate')
    );
});
</script>

