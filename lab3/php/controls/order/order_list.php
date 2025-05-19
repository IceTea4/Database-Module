<?php

// sukuriame užklausų klasės objektą
$ordersObj = new orders();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $ordersObj->getListCount();

// sukuriame puslapiavimo klasės objektą
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio darbuotojus
$data = $ordersObj->getList($paging->size, $paging->first);

// įtraukiame šabloną
include "templates/{$module}/{$module}_list.tpl.php";

?>