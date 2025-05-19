<?php
	
// sukuriame užklausų klasių objektus
$insurancesObj = new insurances();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('pavadinimas', 'kaina');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
    'pavadinimas' => 100,
    'aprasymas' => 1000,
);

// nustatome laukų validatorių tipus
$validations = array (
    'pavadinimas' => 'alfanum',
    'kaina' => 'price',
    'aprasymas' => 'anything',
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// sukuriame validatoriaus objektą
	$validator = new validator($validations, $required, $maxLengths);
	
	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		// įrašome naują pasaugą ir gauname jos id
		$id = $insurancesObj->update($_POST);
		
		// nukreipiame į list puslapį
		common::redirect("index.php?module={$module}&action=list");
		die();
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
		
	}
} else {
    $data = $insurancesObj->get($id);
}

// įtraukiame šabloną
include "templates/{$module}/{$module}_edit.tpl.php";

?>