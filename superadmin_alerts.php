<?php
@$value = $_REQUEST['alert_value'];
	switch ($value) {
		case 0:
			$value_text = 'A cég törlése sikeres volt.';
			break;
		case 1:
			$value_text = 'A vezető és a cég törlése sikeres volt.';
			break;
		case 2:
			$value_text ='A felhasználó törlése sikeres volt.';
			break;
	}
	
	$alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">';
	$alert .='<button type="button" class="btn-close" data-dismiss="alert" data-bs-dismiss="alert">&times;</button>';
	$alert .= $value_text;
	$alert .='</div>';
	echo $alert;
?>