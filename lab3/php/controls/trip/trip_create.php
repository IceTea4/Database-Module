<?php
	
// sukuriame užklausų klasių objektus
$tripsObj = new trips();
$guidesObj = new guides();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array(
    'keliones_id',
    'pavadinimas',
    'aprasymas',
    'organizatorius',
    'pradzios_data',
    'pabaigos_data',
    'vietu_skaicius',
    'kaina',
    'fk_Gidas'
);

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
	'keliones_id' => 50,
    'pavadinimas' => 200,
    'aprasymas' => 1000,
    'organizatorius' => 200,
);

// nustatome laukų validatorių tipus
$validations = array (
    'keliones_id' => 'anything',
    'pavadinimas' => 'alfanum',
    'aprasymas' => 'anything',
    'organizatorius' => 'alfanum',
    'pradzios_data' => 'date',
    'pabaigos_data' => 'date',
    'vietu_skaicius' => 'positivenumber',
    'kaina' => 'price',
    'fk_Gidas' => 'alfanum',
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// sukuriame validatoriaus objektą
	$validator = new validator($validations, $required, $maxLengths);
	
	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
        $exists = $tripsObj->get($_POST['keliones_id']);

        if (isset($exists)) {
            $formErrors = 'Nurodytas id egzistuoja';
            $data = $_POST;
        } else {
            $tripsObj->insert($_POST);

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