<?php
    include_once ('information.php');
    include_once ('menu.php');
?>
<div class="navigation2">
    <span class="navname">Lehetőségek</span>
        <ul>
            <li onClick="pageLoad('wo_add')">Szabadság kérvényezése</li>
            <li onClick="pageLoad('wo_delete')">Szabadság kérelem törlése</li>
        </ul>
</div>
<div id="content" class="content">
    <span class="navname">Szabadságok kezelése - Munkavállaló</span><br>
    <span>
        Ebben a menüpontban a munkavállalók végezhetnek szabadságukkal kapcsolatos műveleteket.<br><br>
        Ehhez kérem használja a bal oldali menüpontokat.
</span>
</div>

<script>
	$(':root').css("--changeImage", "url('../svg/work_off_black_24dp.svg')");
</script>

<?php
    include_once ('bottom.php');
?>