<span class="navname">Szabadságok kezelése</span>

<div class="content_container">
    <div class="form_content">
        <form id="date_picker" action="" method="" autocomplete="off">
			<div id="datepicker"></div>
			<input type="hidden" id="my_hidden_input">	
			<div class="button_center">
				<button id="button" class="button" type="submit" form="date_picker">Mentés</button>
			</div>
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