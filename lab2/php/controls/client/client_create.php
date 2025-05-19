<?php
	
// sukuriame užklausų klasių objektus
$clientsObj = new clients();

$formErrors = null;
$data = array();

// nustatome privalomus laukus
$required = array('vardas', 'pavarde', 'telefono_nr', 'el_pastas');

// maksimalūs leidžiami laukų ilgiai
$maxLengths = array (
    'vardas' => 100,
    'pavarde' => 100,
    'telefono_nr' => 50,
    'el_pastas' => 100,
    'adresas' => 500,
);

// nustatome laukų validatorių tipus
$validations = array (
    'vardas' => 'alfanum',
    'pavarde' => 'alfanum',
    'telefono_nr' => 'phone',
    'el_pastas' => 'email',
    'adresas' => 'anything',
);

// paspaustas išsaugojimo mygtukas
if(!empty($_POST['submit'])) {
	// sukuriame validatoriaus objektą
	$validator = new validator($validations, $required, $maxLengths);
	
	// laukai įvesti be klaidų
	if($validator->validate($_POST)) {
        $exists = $clientsObj->get($_POST['el_pastas']);

        if (isset($exists)) {
            $formErrors = 'Nurodytas el.paštas egzistuoja';
            $data = $_POST;
        } else {
            $clientsObj->insert($_POST);

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