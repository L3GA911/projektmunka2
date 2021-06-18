<?php
    include_once ('information.php');
    include_once ('menu.php');
?>


<div id="content" class="content">
    <span class="navname">Kezdőlap</span><br>
    <span>
        Üdvözöli Önt a kisvállalatok számára létrehozott online munkaidő nyilvántartó rendszer.<br><br>
        
        Az ön szabadságra vonatkozó adatai a következők:
    </span>
    </br></br>
    <?php echo '<span>Életkor: <strong>'.$person_age.'</strong> év</span>' ?></br>
    <?php echo '<span>Kiskorú gyermekek száma (16 évnél fiatalabb): <strong>'.$person_young_kids_count.'</strong> fő</span>' ?></br>
    <span>Önnek összesen <strong><?= $person_basefreeday; ?></strong> nap alapszabadsága van.</span></br>
    <span>Korából adódóan ezen felül <strong><?= $person_plusfreeday; ?></strong> nap pótszabadságra jogosult.</span></br>
    <span>Kiskorú gyermekei után további <strong><?= $person_kidsfreeday; ?></strong> nap pótszabadságra jogosult.</span></br></br>

    <span>Felhasználható éves szabadsága: <strong><?= $person_freedays_sum; ?></strong> nap</span></br>
    <span>Eddig felhasznált szabadsága: <strong><?= $person_used_freedays_count; ?></strong> nap</span></br>
    <span>Felhasználható szabadsága: <strong><?= $person_freedays; ?></strong> nap</span>
</div>
<script>
	$(':root').css("--changeImage", "url('../svg/maps_home_work_black_24dp.svg')");
</script>
<?php
    include_once ('bottom.php');
?>
 
  