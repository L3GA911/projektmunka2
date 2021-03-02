<?php
    include_once ('information.php');
    include_once ('menu.php');
?>
<div class="navigation2">
    <span class="navname">Lehetőségek</span>
        <ul>
            <li onClick="pageLoad('s_dayoff')">Szabadságok</li>
            <li onClick="pageLoad('s_sickleave')">Betegszabadságok</li>
            <li onClick="pageLoad('s_unpaidleave')">Fizetés nélküli szabadság</li>
        </ul>
</div>
<div id="content" class="content">
    <span class="navname">Statisztikák</span>
    <p>
        A dolgozók munkaidejével kapcsolatos statisztikák lekérdezéséhez használja a bal oldali menüpontokat.
    </p>
</div>
<?php
    include_once ('bottom.php');
?>