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
			  INNER JOIN c_members ON freedays.user_id = c_members.u_id
			  INNER JOIN users ON freedays.user_id = users.id
			  INNER JOIN positions ON c_members.c_id = positions.c_id
			  WHERE c_members.c_id = '$worker_firm'";
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
					<?php
					$query_dates = "SELECT id, date FROM freedays WHERE user_id = ".$row['userid']." AND accepted = 0" ;
					$result2  = mysqli_query($con, $query_dates);
					if (mysqli_num_rows($result2) != 0){
						while ($row2 = $result2->fetch_assoc()) { 
						?>
							<div class="panel_list">
								<span><?=$row2['date'];?></span>
								<button class="button_table" onClick="freedays_modal(<?=$row2['id'];?>, <?=$userid;?>, 1)" data-bs-toggle="modal" data-bs-target="#Modal">Elfogadás</button>
								<button class="button_table" onClick="freedays_modal(<?=$row2['id'];?>, <?=$userid;?>, 2)" data-bs-toggle="modal" data-bs-target="#Modal">Elutasítás</button>
							</div>
				<?php   }
					}	
					else {echo 'Nincs szabadságkérvény.';}?>
				</div>
		<?php 
				}
			}
	else {echo 'Nincsenek rekordok az adatbázisban.';}
?>
		</div>
	</div>
</div>
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  </div>
</div>
<script type="text/javascript" src="js/accordion.js"></script>