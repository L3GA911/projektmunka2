<?php 

$query = "SELECT id,date,accepted FROM freedays WHERE user_id = '$userid'";
$result  = mysqli_query($con, $query);

$id = "ID";
$date = "Kérvényezett szabadság napja";

	while ($row = $result->fetch_assoc()){ ?>
		<tr>
			<td data-label="<?=$id;?>"><?=$row['id'];?></td>
			<td data-label="<?=$date;?>"><?=$row['date'];?></td>
			<td>
			<?php
				if($row['accepted'] == 0){ 
			?>
					<button class="button_table" onClick="wo_delete_modal(<?=$row['id'];?>)" data-bs-toggle="modal" data-bs-target="#Modal">Törlés</button>
			<?php
				}
				else if($row['accepted'] == 1){ 
			?>
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
					  <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
					</svg>
			<?php
				}

				else if($row['accepted'] == 2){ 
			?>
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
					  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
					</svg>
			<?php
				}
			?>
			</td>
		</tr>
	<?php } ?>