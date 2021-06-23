<?php	
	require ('inc/auth_session.php');
		
	//Jogosultság ellenőrzése
	if ($userinfo['role'] != 2) {
		echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
		exit();
	}
	
	@$user_id = $_REQUEST['user_id'];
	@$firm_id = $_REQUEST['firm_id'];
	@$pos = $_REQUEST['pos'];
	
	if(isset($user_id, $firm_id, $pos)){ ?>
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Figyelmeztetés!</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			Biztosan törli a felhasználót?
		  </div>
		  <div class="modal-footer">
			<button class="button_table" data-bs-dismiss="modal" onClick="user_delete_sa(<?=$user_id;?>,<?=$firm_id;?>,<?=$pos;?>)">Igen</button>
			<button class="button_table" data-bs-dismiss="modal">Nem</button>
		  </div>
		</div>
	<?php } 
	else {echo 'hiba';}
	?>
