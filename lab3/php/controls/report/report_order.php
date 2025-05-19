<?php

// sukuriame užklausų klasės objektą
$orderObj = new orders();

$formErrors = null;
$fields = array();
$data = array();

// nustatome laukų validatorių tipus
$validations = array(
    'kainaMax' => 'positivenumber'
);

if(empty($_POST['submit'])) {
    // rodome ataskaitos parametrų įvedimo formą
    include "templates/{$module}/{$module}_order_form.tpl.php";
} else {
    // sukuriame validatoriaus objektą
    $validator = new validator($validations);

    if($validator->validate($_POST)) {
        // išrenkame ataskaitos duomenis
        $ordersData = $orderObj->getCustomerOrder($_POST['dataNuo'], $_POST['dataIki'], $_POST['busena'], $_POST['kainaMax']);
        $totalPrice = $orderObj->getSumPriceOfOrders($_POST['dataNuo'], $_POST['dataIki'], $_POST['busena'], $_POST['kainaMax']);

        // perduodame datos filtro reikšmes į šabloną
        $data['dataNuo'] = $_POST['dataNuo'];
        $data['dataIki'] = $_POST['dataIki'];
        $data['busena'] = $_POST['busena'];
        $data['kainaMax'] = $_POST['kainaMax'];

        // rodome ataskaitą
        include "templates/{$module}/{$module}_order_show.tpl.php";
    } else {
        // gauname klaidų pranešimą
        $formErrors = $validator->getErrorHTML();

        // gauname įvestus laukus
        $fields = $_POST;

        // rodome ataskaitos parametrų įvedimo formą su klaidomis
        include "templates/{$module}/{$module}_order_form.tpl.php";
    }
}