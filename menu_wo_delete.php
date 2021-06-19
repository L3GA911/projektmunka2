<?php
require ('inc/auth_session.php');
//Jogosultság ellenőrzése
if ($userinfo['role'] != 0) {
	echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
	exit();
}
$query = "SELECT id,date,accepted FROM freedays WHERE user_id = '$userid'";
$result  = mysqli_query($con, $query);

?>
<span class="navname">Szabadsági kérelem törlése</span>
<div class="content_container">
<?php
	$id = "ID";
	$date = "Kérvényezett szabadság napja";
?>
<table id="table" class="table table-striped table-bordered table2 wo_delete_size">
    <thead class="table-dark">
      <tr>
        <th><?=$id;?></</th>
        <th><?=$date;?></</th>
        <th></th>
      </tr>
    </thead>
    <tbody class="fillin">
		<?php require('inc/wo_delete.php'); ?>
    </tbody>
  </table>
</div>
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog"></div>
</div>
<script type="text/javascript" src="js/editDataTable.js"></script>	