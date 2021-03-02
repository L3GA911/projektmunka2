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
    <span class="navname">Munkaidők szerkesztése</span>
    <p>
        A dolgozók munkaidejének szerkesztéséhez válasszon a bal oldali menüpontok közül.<br><br>
        A munkaidők kezelését a rendszer automatikusan végzi. Módosítás alkalmazása csak <br>abban az esetben szükséges, amennyiben a dolgozó
        eltért a rá vonatkozó műszak rendjétől.
    </p>
</div>
<?php
    include_once ('bottom.php');
?>