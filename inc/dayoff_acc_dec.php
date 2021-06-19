<?php
$query_dates = "SELECT id, date FROM freedays WHERE user_id = ".$userid." AND accepted = 0" ;
$result2  = mysqli_query($con, $query_dates);
if (mysqli_num_rows($result2) != 0){
	while ($row2 = $result2->fetch_assoc()) { 
	?>
		<div class="panel_list">
			<span><?=$row2['date'];?></span>
			<button class="button_table" onClick="freedays_modal(<?=$row2['id'];?>, <?=$userid;?>, 1)" data-bs-toggle="modal" data-bs-target="#Modal">Elfogadás</button>
			<button class="button_table" onClick="freedays_modal(<?=$row2['id'];?>, <?=$userid;?>, 2)" data-bs-toggle="modal" data-bs-target="#Modal">Elutasítás</button>
		</div>
<?php 
	}
}	
else {echo 'Nincs szabadságkérvény.';}?>
