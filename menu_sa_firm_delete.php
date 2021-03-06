<!-- Cégek lekérdezése -->
<?php
require ('inc/auth_session.php');
//Jogosultság ellenőrzése
if ($userinfo['role'] != 2) {
	echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
	exit();
}
//SQL kapcsolat létrehozása
	$query = "SELECT *, companys.id as firm_id FROM companys INNER JOIN users ON companys.owner_id = users.id";
	$result = mysqli_query($con, $query) or die(mysql_error());
?>
<span class="navname">Cég törlése</span>
<div class="content_container">
<div class="information_text">
    <span>Fontos információk</span><br><br>
    <span>A cég törlése minden hozzátartozó adat törlését is maga után vonja!</span>
</div>
<div id="content">
<?php echo '<script type="text/javascript">foglalasaim()</script>'; ?>
<?php
	$firmid = "ID";
	$firmname = "Cégnév";
	$firmowner = "Cégfelelős";
echo '
    <div class="table-responsive">
    <table id="table" class="table table-striped table-bordered table2 firm_delete_size">
      <thead class="table-dark">
        <tr>
          <th>'.$firmid.'</th>
          <th>'.$firmname.'</th>
          <th>'.$firmowner.'</th>
          <th></th>
        </tr>
      </thead>
      <tbody>';
      while ($row = $result->fetch_assoc()) {
		$firm_id = $row["firm_id"];
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
		$firm_name = $row["name"]." ".$form_id_tostring;
		$firm_owner = $row["lastname"]." ".$row["firstname"];
      echo '
          <tr>
              <td data-label="'.$firmid.'">'.$firm_id.'</td>
              <td data-label="'.$firmname.'">'.$firm_name.'</td>
              <td data-label="'.$firmowner.'">'.$firm_owner.'</td>
              <td>
              <button onclick="firm_delete_modal('.$firm_id.')" class="button_table" data-bs-toggle="modal" data-bs-target="#Modal">Törlés</button>
              </td>
          </tr>
      ';
      }
    echo '
      </tbody>
    </table>
  </div>';
?>
</div>
</div>
<div class="alert_box"></div>
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog"></div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#table').DataTable({
			"oLanguage": {
				"oPaginate": {
					"sFirst": "Első oldal",
					"sPrevious": "Előző",
					"sNext": "Következő",
					"sLast": "Utolsó oldal"
					},
				"sSearch": "",
				"sSearchPlaceholder": "Keresés...",
				"sInfoEmpty": "Nincs rekord a táblázatban!",
				"sInfo": "",
				"sZeroRecords": "Nincs találat",
				"sLengthMenu": "_MENU_",
				"sInfoFiltered": "",
				"sEmptyTable": "Nincs rekord a táblázatban!"
			}
		});
	});

</script>