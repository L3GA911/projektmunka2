<?php
	$query = "SELECT DISTINCT users.firstname as firstname,
					  users.lastname as lastname, 
					  users.username as username,
					  users.id as userid,
					  positions.name as posname
	  FROM freedays 
	  INNER JOIN c_members ON freedays.user_id = c_members.u_id
	  INNER JOIN users ON freedays.user_id = users.id
	  INNER JOIN positions ON c_members.c_id = positions.c_id
	  WHERE c_members.c_id = '$worker_firm'";
	$result  = mysqli_query($con, $query);	
	if (mysqli_num_rows($result) != 0){
		while ($row = $result->fetch_assoc()) { ?>
				<button class="accordion"><?=$row['lastname'];?>&nbsp;<?=$row['firstname'];?> - <?=$row['username'];?> - <?=$row['posname'];?></button>
				<div class="panel">
					<?php
					$query_dates = "SELECT id, date FROM freedays WHERE user_id = ".$row['userid']." AND accepted = 0" ;
					$result2  = mysqli_query($con, $query_dates);
					while ($row2 = $result2->fetch_assoc()) { 
					?>
						<div class="panel_list">
							<span><?=$row2['date'];?></span>
							<button class="button_table" onClick="freedays_accepted(<?=$row2['id'];?>, <?=$row['userid'];?>, <?=$worker_firm;?>)">Elfogadás</button>
							<button class="button_table" onClick="freedays_declined(<?=$row2['id'];?>, <?=$row['userid'];?>, <?=$worker_firm;?>)">Elutasítás</button>
						</div>
				<?php } ?>
				</div>
<?php 
		}
	}
	else {echo 'Nincsenek rekordok az adatbázisban.';}
?>
<script type="text/javascript" src="js/accordion.js"></script>