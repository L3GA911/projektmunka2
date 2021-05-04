<?php
    include_once ('information.php');
    include_once ('menu.php');
?>
<div id="content" class="content">
    <span class="navname">Statisztikák</span><br>
	<div class="content_container_stats">
        <div class="dropdown">
		  <button onclick="open_list()" class="dropbtn">Dolgozó kiválasztása</button>
		  <div id="dropdown_list" class="dropdown-content">
			<input type="text" placeholder="Keresés..." id="dropdown_search" onkeyup="filterFunction()">
			<a href="">Lengyel Gábor</a>
			<a href="">Ihász Viktor</a>
			<a href="">Valaki Vagyok</a>
		  </div>
		</div><br>
		<span>Dolgozó: XY</span>
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