<?php

// sukuriame užklausų klasės objektą
$tripsObj = new trips();

// suskaičiuojame bendrą įrašų kiekį
$elementCount = $tripsObj->getListCount();

// sukuriame puslapiavimo klasės objektą
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

// suformuojame sąrašo puslapius
$paging->process($elementCount, $pageId);

// išrenkame nurodyto puslapio darbuotojus
$data = $tripsObj->getList($paging->size, $paging->first);

// įtraukiame šabloną
include "templates/{$module}/{$module}_list.tpl.php";

?>