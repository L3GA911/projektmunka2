<?php
    include_once ('information.php');
    include_once ('menu.php');
?>
<div class="navigation2">
    <span class="navname">Lehetőségek</span>
        <ul>
            <li onClick="pageLoad('sa_add_new_firm')">Új cég regisztrálása</li>
            <li onClick="pageLoad('sa_access_management')">Jogosultságok kezelése</li>
            <li onClick="pageLoad('sa_dayoff_management')">Szabadságok kezelése</li>
        </ul>
</div>
<div id="content" class="content">
    <span class="navname">SuperAdmin</span><br>
    <span>A SuperAdmin korlátlan jogosultsággal rendelkezik a teljes rendszer felett.</span>
</div>
<?php
    include_once ('bottom.php');
?>