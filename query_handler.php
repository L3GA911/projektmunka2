<?php
require ('inc/auth_session.php');
//Jogosultság ellenőrzése
if ($userinfo['role'] < 1) {
	echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
	exit();
}
//-----------------------------EZ A PHP FÁJL KEZELI LEKÉRDEZÉSEKET-------------------------

//---------------------------------------------------------CÉG TAGOK BETÖLTÉSE--------------------------------------------------------------------------
@$firm_id = $_REQUEST['firm_id']; //list_firm_users
if (isset($firm_id)) {
//SQL kapcsolat létrehozása

//Normál felhasználók lekérdezése
$query = "SELECT *, companys.name as firm_name, positions.name as pname, companys.id as firm_id FROM companys 
LEFT JOIN c_members ON c_members.c_id = companys.id
INNER JOIN users ON c_members.u_id = users.id
RIGHT JOIN positions ON positions.id = users.status
WHERE companys.id = '$firm_id'";
$result = mysqli_query($con, $query) or die(mysql_error());
$users_count = $result->num_rows;

//Cégfelelős felhasználók lekérdezése
$query2 = "SELECT *, companys.name as firm_name, companys.id as firm_id FROM companys 
INNER JOIN users ON users.id = companys.owner_id
WHERE companys.id = '$firm_id'";
$result2 = mysqli_query($con, $query2) or die(mysql_error());

//Cégek lekérdezése
$query3 = "SELECT *, companys.id as firm_id FROM companys 
JOIN users ON users.id = companys.owner_id
WHERE companys.id = '$firm_id'";
$result3 = mysqli_query($con, $query3) or die(mysql_error());

$firmid = "ID";
$lastname = "Vezetéknév";
$firstname = "Keresztnév";
$position = "Pozíció";
$firm = "Cég";

echo '
<table id="table" class="table table-striped table-bordered table2 user_delete_size">
<thead class="table-dark">
  <tr>
  <th>'.$firmid.'</th>
  <th>'.$lastname.'</th>
  <th>'.$firstname.'</th>
  <th>'.$position.'</th>
  <th>'.$firm.'</th>
  <th></th>
  </tr>
</thead>
<tbody>';
//Cégfelelősök
while ($row = $result2->fetch_assoc()) {
	$user_id = $row["owner_id"];
	$person_firstname = $row["firstname"];
	$person_lastname = $row["lastname"];
	$person_status = "Cégfelelős";
	$firm_form = $row["form_id"];
	switch ($firm_form) {
		case 1:
			$form_id_tostring = "Kft.";
			break;
		case 2:
			$form_id_tostring = "Bt.";
			break;	
		case 3:
			$form_id_tostring = "Nyrt.";
			break;
		case 4:
			$form_id_tostring = "Zrt.";
			break;	
		case 5:
			$form_id_tostring = "Kkt.";
			break;
		case 6:
			$form_id_tostring = "EV.";
			break;	
		}
	$person_firm = $row["firm_name"]." ".$form_id_tostring;
	echo '
	<tr style="background-color: #ff9494;">
		<td data-label="'.$firmid.'">'.$user_id.'</td>
		<td data-label="'.$lastname.'">'.$person_lastname.'</td>
		<td data-label="'.$firstname.'">'.$person_firstname.'</td>
		<td data-label="'.$position.'">'.$person_status.'</td>
		<td data-label="'.$firm.'">'.$person_firm.'</td>
		<td>';
		if ($users_count == 0) {echo '<button onclick="sa_user_delete_modal('.$user_id.",".$firm_id.',1)" class="button_table"  data-bs-toggle="modal" data-bs-target="#Modal">Törlés</button>';} else {echo '<button style="color: grey;" disabled class="button_table">Törlés</button>';}
		echo'
		</td>
	</tr>';}

//Normál felhasználók
while ($row = $result->fetch_assoc()) {
$user_id = $row["u_id"];
$person_firstname = $row["firstname"];
$person_lastname = $row["lastname"];
$person_status = $row["pname"];
$firm_form = $row["form_id"];
switch ($firm_form) {
	case 1:
		$form_id_tostring = "Kft.";
		break;
	case 2:
		$form_id_tostring = "Bt.";
		break;	
	case 3:
		$form_id_tostring = "Nyrt.";
		break;
	case 4:
		$form_id_tostring = "Zrt.";
		break;	
	case 5:
		$form_id_tostring = "Kkt.";
		break;
	case 6:
		$form_id_tostring = "EV.";
		break;	
	}
$person_firm = $row["firm_name"]." ".$form_id_tostring;
echo '
<tr>
	<td data-label="'.$firmid.'">'.$user_id.'</td>
	<td data-label="'.$lastname.'">'.$person_lastname.'</td>
	<td data-label="'.$firstname.'">'.$person_firstname.'</td>
	<td data-label="'.$position.'">'.$person_status.'</td>
	<td data-label="'.$firm.'">'.$person_firm.'</td>
	<td>
	<button onclick="sa_user_delete_modal('.$user_id.",".$firm_id.',-1)" class="button_table" data-bs-toggle="modal" data-bs-target="#Modal">Törlés</button>
	</td>
</tr>';}
	echo '
</tbody>
</table>';
}

@$user_id_stats = $_REQUEST['user_id_stats']; 
if (isset($user_id_stats)) {

	function getWorkingDays($startDate, $endDate)
	{
		$begin = strtotime($startDate);
		$end   = strtotime($endDate);
		if ($begin > $end) {
	
			return 0;
		} else {
			$no_days  = 0;
			$weekends = 0;
			while ($begin <= $end) {
				$no_days++;
				$what_day = date("N", $begin);
				if ($what_day > 5) { 
					$weekends++;
				};
				$begin += 86400;
			};
			$working_days = $no_days - $weekends;
	
			return $working_days;
		}
	}
	
	$person_id = $user_id_stats;
	
	
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

	$honap = "Hónap";
	$munkaora = "Ledolgozott munkaóra";
    $tulora = "Túlóra";
	$munkasz_nap = "Munkaszüneti nap";  
    $szabadsag = "Szabadnap";
	$fizetetlen_sz = "Fizetetlen szabadnap";
	
echo'
	<table id="table" class="table table-striped table-bordered table2 profiles_delete">
    <thead class="table-dark">
      <tr>
        <th>'.$honap.'</th>
        <th>'.$munkaora.'</th>
        <th>'.$tulora.'</th>
        <th>'.$munkasz_nap.'</th>
        <th>'.$szabadsag.'</th>
        <th>'.$fizetetlen_sz.'</th>
      </tr>


    </thead>
    <tbody>';
 
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




        $person_workhour = $person_workhour * $worktime + $offset - ($freeday*$worktime) - ($nopayday*$worktime) - ($wfreeday*$worktime);
        echo'
        <tr>
            <td data-label="'.$honap.'">'.$i.'</td>
            <td data-label="'.$munkaora.'">'.$person_workhour.'</td>
            <td data-label="'.$tulora.'">'.$offset.'</td>
            <td data-label="'.$munkasz_nap.'">'.$wfreeday.'</td>
            <td data-label="'.$szabadsag.'">'.$freeday.'</th>
            <td data-label="'.$fizetetlen_sz.'">'.$nopayday.'</td>
        </tr>';} 
		echo' 
        </tbody>
      </table>
	  <div id="list"></div>';

}
?>
<script type="text/javascript" src="js/editDataTable.js"></script>	