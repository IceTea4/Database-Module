<?php

// sukuriame užklausų klasės objektą
$clientsObj = new clients();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $clientsObj->getListCount();

// sukuriame puslapiavimo klasės objektą
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio darbuotojus
$data = $clientsObj->getList($paging->size, $paging->first);

// įtraukiame šabloną
include "templates/{$module}/{$module}_list.tpl.php";

?>