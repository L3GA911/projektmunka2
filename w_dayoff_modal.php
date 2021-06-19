<?php	
	require ('inc/auth_session.php');
		
	//Jogosultság ellenőrzése
	if ($userinfo['role'] != 1) {
		echo "Az oldal megtekintéséhez nincs kellő jogosultságod!";
		exit();
	}
	
	@$date = $_REQUEST['date'];
	@$userid = $_REQUEST['userid'];
	@$aord = $_REQUEST['aord'];
	
	if(isset($date, $userid, $aord)){
		if ($aord == 1){
			$alert = 'engedélyezi';
		}
		else if ($aord == 2){
			$alert = 'elutasítja';
		}
	}
	else {echo 'hiba';}
?>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Figyelmeztetés!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		Biztosan <?=$alert;?> a szabadságot?
      </div>
      <div class="modal-footer">
        <button class="button_table" data-bs-dismiss="modal" onClick="freedays_acc_dec(<?=$date;?>, <?=$userid;?>, <?=$aord;?>)">Igen</button>
		<button class="button_table" data-bs-dismiss="modal">Nem</button>
      </div>
    </div>
