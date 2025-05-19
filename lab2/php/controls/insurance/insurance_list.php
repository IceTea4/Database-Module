<?php

// sukuriame užklausų klasės objektą
$insurancesObj = new insurances();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $insurancesObj->getListCount();

// sukuriame puslapiavimo klasės objektą
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio darbuotojus
$data = $insurancesObj->getList($paging->size, $paging->first);

// įtraukiame šabloną
include "templates/{$module}/{$module}_list.tpl.php";

?>