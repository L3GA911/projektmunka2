<?php	
	require ('inc/auth_session.php');
		
	//Jogosultság ellenőrzése
	if ($userinfo['role'] != 2) {
		echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
		exit();
	}
	
	@$fd_id = $_REQUEST['fd_id'];
	
	if(isset($fd_id)){ ?>
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Figyelmeztetés!</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			Biztosan törli a céget?
		  </div>
		  <div class="modal-footer">
			<button class="button_table" data-bs-dismiss="modal" onClick="firm_delete(<?=$fd_id;?>)">Igen</button>
			<button class="button_table" data-bs-dismiss="modal">Nem</button>
		  </div>
		</div>
	<?php } 
	else {echo 'hiba';}
	?>
