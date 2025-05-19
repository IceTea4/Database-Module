<?php

// sukuriame užklausų klasės objektą
$insurancesObj = new insurances();

if(!empty($id)) {
	// patikriname, ar neturi polisu
	$policies = $insurancesObj->countPolicies($id);

	$removeErrorParameter = '';

    if($policies == 0) {
		// šaliname
		$insurancesObj->delete($id);
	} else {
		$removeErrorParameter = '&remove_error=1';
	}

	common::redirect("index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}

?>