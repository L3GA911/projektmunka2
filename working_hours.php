<?php
    include_once ('information.php');
    include_once ('menu.php');
?>
<div class="navigation2">
    <span class="navname">Lehetőségek</span>
    <ul>
        <li onClick="pageLoad('w_dayoff')">Szabadságok kezelése</li>
        <li onClick="pageLoad('w_workinghours')">Munkaidők kezelése</li>
    </ul>
</div>
<div id="content" class="content">
    <span class="navname">Munkaidők szerkesztése</span><br>
    <span>
        A dolgozók munkaidejének szerkesztéséhez válasszon a bal oldali menüpontok közül.<br><br>
        A munkaidők kezelését a rendszer automatikusan végzi. Módosítás alkalmazása csak <br>abban az esetben szükséges, amennyiben a dolgozó
        eltért a rá vonatkozó műszak rendjétől.
    </span>
</div>
<script>
	$(':root').css("--changeImage", "url('../svg/hourglass_top_black_24dp.svg')");
</script>
<?php
    include_once ('bottom.php');
?>