<?php
	
// sukuriame užklausų klasių objektus
$guidesObj = new guides();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('vardas', 'pavarde', 'telefono_nr', 'kalbos', 'kaina');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
    'vardas' => 100,
    'pavarde' => 100,
    'telefono_nr' => 50,
    'kalbos' => 200,
);

// nustatome laukų validatorių tipus
$validations = array (
    'vardas' => 'alfanum',
    'pavarde' => 'alfanum',
    'telefono_nr' => 'phone',
    'kalbos' => 'alfanum',
    'kaina' => 'price',
    'patirtis_metais' => 'positivenumber',
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// sukuriame validatoriaus objektą
	$validator = new validator($validations, $required, $maxLengths);
	
	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
		// įrašome naują pasaugą ir gauname jos id
		$id = $guidesObj->update($_POST);
		
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
    $data = $guidesObj->get($id);
}

// įtraukiame šabloną
include "templates/{$module}/{$module}_edit.tpl.php";

?>