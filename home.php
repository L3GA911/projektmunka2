<?php
    include_once ('information.php');
    include_once ('menu.php');
?>

<?php

//Személy korának lekérdezése
$query = "SELECT TRUNCATE(DATEDIFF(CURRENT_DATE, birthday)/365,0) as Age FROM users WHERE id='$userid'";
$result = mysqli_query($con, $query) or die(mysql_error());
$row = mysqli_fetch_assoc($result);
//Személy kiskorú gyermekeinek lekérdezése


?>

<div id="content" class="content">
    <span class="navname">Kezdőlap</span><br>
    <span>
        Üdvözöli Önt a kisvállalatok számára létrehozott online munkaidő nyilvántartó rendszer.<br><br>
        A program használatához kérem válasszon a bal oldali menüpontok közül.
    </span>

</div>
<script>
	$(':root').css("--changeImage", "url('../svg/maps_home_work_black_24dp.svg')");
</script>
<?php
    include_once ('bottom.php');
?>

