<?php

// sukuriame užklausų klasės objektą
$clientsObj = new clients();

if(!empty($id)) {
	// patikriname, ar neturi rezervaciju
	$orders = $clientsObj->countOrders($id);

	$removeErrorParameter = '';

    if($orders == 0) {
		// šaliname
		$clientsObj->delete($id);
	} else {
		// nepašalinome, nes turi rezervaciju
		$removeErrorParameter = '&remove_error=1';
	}

	common::redirect("index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}

?>