<?php

// sukuriame užklausų klasės objektą
$ordersObj = new orders();

if(!empty($id)) {
    // patikriname, ar neturi mokejimu
    $orders = $ordersObj->countPayments($id);

    $removeErrorParameter = '';

    if($orders == 0) {
        // šaliname
        $ordersObj->delete($id);
    } else {
        $removeErrorParameter = '&remove_error=1';
    }

    common::redirect("index.php?module={$module}&action=list{$removeErrorParameter}");
    die();
}

?>