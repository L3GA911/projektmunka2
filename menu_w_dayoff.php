<?php			
	require ('inc/auth_session.php');

	//Jogosultság ellenőrzése
	if ($userinfo['role'] != 1) {
		echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
		exit();
	}
	$worker_firm = $extendeduserinfo['firm_id'];
	$query = "SELECT DISTINCT 
				  users.firstname as firstname,
				  users.lastname as lastname, 
				  users.username as username,
				  users.id as userid,
				  positions.name as posname
			  FROM freedays 
			  INNER JOIN users ON freedays.user_id = users.id
			  INNER JOIN positions ON users.status = positions.id
			  INNER JOIN c_members ON users.id = c_members.u_id
			  WHERE c_members.c_id = $worker_firm";
?>
<span class="navname">Függőben lévő szabadságok</span>
	<div class="content_container">
		<div class="cc">
		<?php
		$result  = mysqli_query($con, $query);	
		if (mysqli_num_rows($result) != 0){
			while ($row = $result->fetch_assoc()) { 
				$userid = $row['userid'];
			?>
			<button class="accordion"><?=$row['lastname'];?>&nbsp;<?=$row['firstname'];?> - <?=$row['username'];?> - <?=$row['posname'];?></button>
			<div id="<?=$userid;?>" class="panel">
				<?php require('inc/dayoff_acc_dec.php');?>
			</div>
	<?php 
			}
		}
	else {echo 'Nincsenek rekordok az adatbázisban.';}
?>		</div>
	</div>
</div>
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  </div>
</div>
<script type="text/javascript" src="js/accordion.js"></script>