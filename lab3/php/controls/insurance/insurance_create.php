<?php
	
// sukuriame užklausų klasių objektus
$insurancesObj = new insurances();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('draudimo_id', 'pavadinimas', 'kaina');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
    'draudimo_id' => 20,
    'pavadinimas' => 100,
    'aprasymas' => 1000,
);

// nustatome laukų validatorių tipus
$validations = array (
    'draudimo_id' => 'alfanum',
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
        $exists = $insurancesObj->get($_POST['draudimo_id']);

        if (isset($exists)) {
            $formErrors = 'Nurodytas id egzistuoja';
            $data = $_POST;
        } else {
            $insurancesObj->insert($_POST);

            // nukreipiame į list puslapį
            common::redirect("index.php?module={$module}&action=list");
            die();
        }
	} else {
		// gauname klaidų pranešimą
		$formErrors = $validator->getErrorHTML();
		// gauname įvestus laukus
		$data = $_POST;
		
	}
}

// įtraukiame šabloną
include "templates/{$module}/{$module}_create.tpl.php";

?>