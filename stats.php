<?php
    include_once ('information.php');
    include_once ('menu.php');
?>
<div id="content" class="content">
    <span class="navname">Statisztikák</span><br>
	<div class="content_container_stats">
        <select id="cform" name="cform">
            <option value="" selected disabled>Dolgozók</option>
            <option value="1">Valaki Vagyok</option>
            <option value="2">Mekk Elek</option>
        </select><br>
		<div id="chart_div"></div>
	</div>
</div>

<script type="text/javascript">
	$(':root').css("--changeImage", "url('../svg/stacked_bar_chart_black_24dp.svg')");
</script>

<script type="text/javascript" src="js/googleCharts.js"></script>	
<?php
    include_once ('bottom.php');
?>