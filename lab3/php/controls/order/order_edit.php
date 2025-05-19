<?php
	
// sukuriame užklausų klasių objektus
$ordersObj = new orders();
$insurancesObj = new insurances();

$formErrors = null;
$data = array();
$data['draudimai'] = [[]];

// nustatome privalomus laukus
$required = [
    'order' => ['rezervacijos_data', 'busena'],
    'insurance' => ['fk_Draudimas', 'numeris']
];

// maksimalūs leidžiami laukų ilgiai
$maxLengths = [
    'order' => [],
    'insurance' => ['numeris' => 50]
];

// nustatome laukų validatorių tipus
$validations = [
    'order' => [
        'rezervacijos_data' => 'date',
        'busena' => 'alfanum',
    ],
    'insurance' => [
        'fk_Draudimas' => 'anything',
        'numeris' => 'alfanum'
    ]
];

// paspaustas išsaugojimo mygtukas
if(empty($_POST['submit'])) {
    $data = $ordersObj->get($id);

    $draudimai = $ordersObj->getInsurances($id);
    array_unshift($draudimai, []);
    $data['draudimai'] = $draudimai;

    include "templates/{$module}/{$module}_edit.tpl.php";
    return;
}

$draudimai = [];
if(isset($_POST['draudimas'])) {
    foreach($_POST['draudimas'] as $key => $val) {
        array_push($draudimai, array(
            'fk_Draudimas' => $_POST['draudimas'][$key],
            'numeris' => $_POST['draudimo_numeris'][$key],
        ));
    }
}
array_shift($draudimai);

$validator = new validator($validations['order'], $required['order'], $maxLengths['order']);
if(!$validator->validate($_POST)) {
    $formErrors = $validator->getErrorHTML();
    $data = $_POST;

    array_unshift($draudimai, []);
    $data['draudimai'] = $draudimai;

    include "templates/{$module}/{$module}_edit.tpl.php";
    return;
}

$validator = new validator($validations['insurance'], $required['insurance'], $maxLengths['insurance']);
foreach($draudimai as $key => $val) {
    if(!$validator->validate($val)) {
        $formErrors = $validator->getErrorHTML();
        $data = $_POST;

        array_unshift($draudimai, []);
        $data['draudimai'] = $draudimai;

        include "templates/{$module}/{$module}_edit.tpl.php";
        return;
    }
}

// atnaujiname duomenis
$ordersObj->update($_POST);
$ordersObj->deleteInsurances($id);

if (count($draudimai) > 0) {
    foreach ($draudimai as &$val) {
        $val['fk_Rezervacija'] = $id;
    }
    unset($val);
    $ordersObj->insertInsurances($draudimai);
}

// nukreipiame į list puslapį
common::redirect("index.php?module={$module}&action=list");
die();

?>