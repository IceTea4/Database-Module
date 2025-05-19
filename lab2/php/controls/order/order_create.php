<?php
	
// sukuriame užklausų klasių objektus
$ordersObj = new orders();
$tripsObj = new trips();
$clientsObj = new clients();
$insurancesObj = new insurances();

$formErrors = null;
$data = array();
$data['draudimai'] = [[]];

// nustatome privalomus laukus
$required = [
    'order' => ['rezervacijos_id', 'rezervacijos_data', 'fk_Klientas', 'fk_Kelione'],
    'insurance' => ['fk_Draudimas', 'numeris']
];

// maksimalūs leidžiami laukų ilgiai
$maxLengths = [
	'order' => ['rezervacijos_id' => 50,],
    'insurance' => ['numeris' => 50]
];

// nustatome laukų validatorių tipus
$validations = [
    'order' => [
        'rezervacijos_id' => 'anything',
        'rezervacijos_data' => 'date',
        'fk_Klientas' => 'alfanum',
        'fk_Kelione' => 'alfanum'
    ],
    'insurance' => [
        'fk_Draudimas' => 'anything',
        'numeris' => 'alfanum'
    ]
];

// paspaustas išsaugojimo mygtukas
if(empty($_POST['submit'])) {
    include "templates/{$module}/{$module}_create.tpl.php";
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

    include "templates/{$module}/{$module}_create.tpl.php";
    return;
}

$id = $_POST['rezervacijos_id'];
$exists = $ordersObj->get($id);
if (isset($exists)) {
    $formErrors = 'Nurodytas id egzistuoja';
    $data = $_POST;

    array_unshift($draudimai, []);
    $data['draudimai'] = $draudimai;

    include "templates/{$module}/{$module}_create.tpl.php";
    return;
}

$validator = new validator($validations['insurance'], $required['insurance'], $maxLengths['insurance']);
foreach($draudimai as $key => $val) {
    if(!$validator->validate($val)) {
        $formErrors = $validator->getErrorHTML();
        $data = $_POST;

        array_unshift($draudimai, []);
        $data['draudimai'] = $draudimai;

        include "templates/{$module}/{$module}_create.tpl.php";
        return;
    }
}

$ordersObj->insert($_POST);

if (count($draudimai) > 0) {
    foreach ($draudimai as &$val) {
        $val['fk_Rezervacija'] = $id;
    }
    unset($val);
    $ordersObj->insertInsurances($draudimai);
}

common::redirect("index.php?module={$module}&action=list");
die();

?>