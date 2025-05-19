<?php

// sukuriame užklausų klasės objektą
$tripsObj = new trips();

if(!empty($id)) {
	// patikriname, ar neturi rezervaciju
	$orders = $tripsObj->countOrders($id);

	$removeErrorParameter = '';

    if($orders == 0) {
		// šaliname
		$tripsObj->delete($id);
	} else {
		$removeErrorParameter = '&remove_error=1';
	}

	common::redirect("index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}

?>