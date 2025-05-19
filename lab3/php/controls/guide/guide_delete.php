<?php

// sukuriame užklausų klasės objektą
$guidesObj = new guides();

if(!empty($id)) {
	// patikriname, ar neturi kelioniu
	$trips = $guidesObj->countTrips($id);

	$removeErrorParameter = '';

    if($trips == 0) {
		// šaliname
		$guidesObj->delete($id);
	} else {
		// nepašalinome, nes turi kelioniu
		$removeErrorParameter = '&remove_error=1';
	}

	common::redirect("index.php?module={$module}&action=list{$removeErrorParameter}");
	die();
}

?>