<span class="navname">Szabadság kérvényezése</span>

<div class="content_container">
    <div class="form_content">
        <form id="date_picker" id="date_picker" action="" method="get" autocomplete="off">
			<div id="datepicker"></div>
			<input hidden type="text" name="my_hidden_input" id="my_hidden_input">
			<button id="button" class="button" type="submit" form="date_picker">Mentés</button>
        </form>
    </div>
</div>

<script>
	$('#datepicker').datepicker({
		format: "yyyy/mm/dd",
		language: "hu",
		multidate: true,
		calendarWeeks: true,
		todayHighlight: true,
		clearBtn: true,
	});
	
	$('#datepicker').on('changeDate', function() {
    $('#my_hidden_input').val(
        $('#datepicker').datepicker('getFormattedDate')
    );
});
</script>

