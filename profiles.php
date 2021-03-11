<?php
    include_once ('information.php');
    include_once ('menu.php');
?>
<div class="navigation2">
    <span class="navname">Lehetőségek</span>
        <ul>
            <li onClick="pageLoad('p_add')">Dolgozó felvétele</li>
            <li onClick="pageLoad('p_delete')">Dolgozó törlése</li>
            <li onClick="pageLoad('p_list')">Dolgozók listája</li>
            <li onClick="pageLoad('p_edit')">Dolgozói profilok szerkesztése</li>
        </ul>
</div>
<div id="content" class="content">
    <span class="navname">Dolgozói profilok szerkesztése</span><br>
    <span>A munkavállalók profiljának szerkesztése válasszon a baloldalon található menüpontok közül.</span>
</div>
<?php
    include_once ('bottom.php');
?>