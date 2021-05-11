<script>
function firm_delete(firm_id) {
		   $.ajax({url:"superadmin.php", type:"POST", data: ({firm_id: firm_id}), async:true, cache:false, success:function(result)
		{
			// $("#content").html(result);
			pageLoad('sa_firm_delete');
		}});
}
</script>

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
<div id="content">
<?php echo '<script type="text/javascript">foglalasaim()</script>'; ?>
<?php
echo '
    <div class="table-responsive">
    <table id="table" class="table table-striped table-bordered table2 firm_delete_size">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Cégnév</th>
          <th>Cégfelelős</th>
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
              <td data-label="">'.$firm_id.'</td>
              <td data-label="">'.$firm_name.'</td>
              <td data-label="">'.$firm_owner.'</td>
              <td>
              <button onclick="firm_delete('.$firm_id.')" class="button_table">Törlés</button>
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