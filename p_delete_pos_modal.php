<?php	
	require ('inc/auth_session.php');
		
	//Jogosultság ellenőrzése
	if ($userinfo['role'] != 1) {
		echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
		exit();
	}
	
	@$pos_id_modal = $_REQUEST['pos_id_modal'];
	
	if(isset($pos_id_modal)){ ?>
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Figyelmeztetés!</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <div class="modal-body">
			Biztosan törli a pozíciót?
		  </div>
		  <div class="modal-footer">
			<button class="button_table" data-bs-dismiss="modal" onClick="pos_delete_p(<?=$pos_id_modal;?>)">Igen</button>
			<button class="button_table" data-bs-dismiss="modal">Nem</button>
		  </div>
		</div>
	<?php } ?>
