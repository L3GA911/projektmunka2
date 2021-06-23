<?php
require ('inc/auth_session.php');
//Jogosultság ellenőrzése
if ($userinfo['role'] != 1) {
	echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
	exit();
}

function getWorkingDays($startDate, $endDate)
{
    $begin = strtotime($startDate);
    $end   = strtotime($endDate);
    if ($begin > $end) {
        echo "startdate is in the future! <br />";

        return 0;
    } else {
        $no_days  = 0;
        $weekends = 0;
        while ($begin <= $end) {
            $no_days++; // no of days in the given interval
            $what_day = date("N", $begin);
            if ($what_day > 5) { // 6 and 7 are weekend days
                $weekends++;
            };
            $begin += 86400; // +1 day
        };
        $working_days = $no_days - $weekends;

        return $working_days;
    }
}

$person_id = 113;


//Felhasználó munkanap bejegyzések lekérdezése
$query = "SELECT * FROM workingdays
WHERE workingdays.u_id = '$person_id' AND YEAR(date) = YEAR(CURRENT_DATE())";
$workingdays = mysqli_query($con, $query) or die(mysql_error());
$workingdays_count = $workingdays->num_rows;

//Munkaviszony kezdetének és a dolgozó munkaidejének lekérdezése
$query = "SELECT * FROM users
WHERE users.id = '$person_id'";
$result = mysqli_query($con, $query) or die(mysql_error());
$row = mysqli_fetch_assoc($result);
$w_begindate = $row["w_begindate"];
$starthour = $row["starthour"];
$endhour = $row["endhour"];
$worktime = (strtotime($endhour)-strtotime($starthour))/3600;
//Ha a munkaviszony kezdete az idei évben volt:
if (date('Y', strtotime($w_begindate)) == date('Y')) {
    $startMonth=date('n', strtotime($w_begindate));
    $startDay=date('d', strtotime($w_begindate));
    $thisYear = true;

} else {//Ha pedig nem..
    $startMonth=1;
    $startDay=1;
    $thisYear = false;
}

?>
<span class="navname">Elérhető szabadságok</span>
<div class="content_container">

<?php
	$honap = "Hónap";
	$munkaora = "Összes munkaóra";
    $tulora = "Túlóra";
	$munkasz_nap = "Munkaszüneti nap";  
    $szabadsag = "Szabadság";
	$fizetetlen_sz = "Fizetetlen szabadság";
?>

<table id="table" class="table table-striped table-bordered table2 profiles_delete">
    <thead class="table-dark">
      <tr>
        <th><?=$honap;?></th>
        <th><?=$munkaora;?></th>
        <th><?=$tulora;?></th>
        <th><?=$munkasz_nap;?></th>
        <th><?=$szabadsag;?></th>
        <th><?=$fizetetlen_sz;?></th>
      </tr>


    </thead>
    <tbody>
    <?php

        //hónapok 1 -től az aktuálisig bezáróan
    $actualMonth = date('m');
    $actualYear = date('Y');

    for ($i = $startMonth; $i <= $actualMonth; $i++) {

        if ($i == $actualMonth) {
            $startDate = $actualYear."-".$i."-01";
            $endDate = $actualYear."-".$i."-".date('d');
            //számolások erre a hónapra
            $person_workhour = getWorkingDays($startDate, $endDate);
        }
        else {
            $startDate = $actualYear."-".$i."-01";
            $endDay = cal_days_in_month(CAL_GREGORIAN, 6, date('Y'));
            $endDate = $actualYear."-".$i."-".$endDay;
            //számolások a teljes hónapra
            $person_workhour = getWorkingDays($startDate, $endDate);
        }

        //Felhasználó munkanap bejegyzések lekérdezése
        $query = "SELECT * FROM workingdays
        WHERE workingdays.u_id = '$person_id' AND YEAR(date) = YEAR(CURRENT_DATE()) AND MONTH(DATE) = '$i' AND type=1";
        $workingdays = mysqli_query($con, $query) or die(mysql_error());
        $workingdays_count = $workingdays->num_rows;
        if ($workingdays_count == 0) {
            $wfreeday = 0;
        } else {
            $wfreeday = $workingdays_count;
        }

        $query = "SELECT * FROM workingdays
        WHERE workingdays.u_id = '$person_id' AND YEAR(date) = YEAR(CURRENT_DATE()) AND MONTH(DATE) = '$i' AND type=2";
        $workingdays = mysqli_query($con, $query) or die(mysql_error());
        $workingdays_count = $workingdays->num_rows;

        if ($workingdays_count == 0) {
            $nopayday = 0;
        } else {
            $nopayday= $workingdays_count;
        }

        $query = "SELECT sum(offset) as offset FROM workingdays
        WHERE workingdays.u_id = '$person_id' AND YEAR(date) = YEAR(CURRENT_DATE()) AND MONTH(DATE) = '$i' AND type=3";
        $workingdays = mysqli_query($con, $query) or die(mysql_error());
        $row = mysqli_fetch_assoc($workingdays);
        $workingdays_count = $workingdays->num_rows;
        $offset = $row["offset"];
        if ($offset == NULL) {
            $offset = 0;
        }

        $query = "SELECT * FROM freedays
        WHERE freedays.user_id = '$person_id' AND YEAR(date) = YEAR(CURRENT_DATE()) AND MONTH(DATE) = '$i' AND accepted=1";
        $freedays = mysqli_query($con, $query) or die(mysql_error());
        $freedays_count = $freedays->num_rows;
        $freeday = $freedays_count;




        $person_workhour = $person_workhour * $worktime + $offset;
        echo'
        <tr>
            <td data-label="<?=$honap;?>">'.$i.'</td>
            <td data-label="<?=$munkaora;?>">'.$person_workhour.'</td>
            <td data-label="<?=$tulora;?>">'.$offset.'</td>
            <td data-label="<?=$munkasz_nap;?>">'.$wfreeday.'</td>
            <td data-label="<?=$szabadsag;?>">'.$freeday.'</th>
            <td data-label="<?=$fizetetlen_sz;?>">'.$nopayday.'</td>
        </tr>';} 
      ?>  
        </tbody>
      </table>

</div>

