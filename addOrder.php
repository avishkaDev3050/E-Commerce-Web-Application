<?php

    session_start();
    include "connection.php";

    $q = $_POST['q'];
    $c = $_POST['c'];
    $pId = $_POST['pId'];
    $pri = $_POST['pri'];
    $dis = $_POST['dis'];
    $dis_id = $_POST['dis_id'];
    $avb = $_POST['avb'];

    $invoice_id = uniqid();

    $d = new DateTime();
    $date = $d->format("Y-m-d");

    $orderId = uniqid();

    if (empty($dis_id)) {
        
        Database::iud("INSERT INTO `order`(`id`, `price`, `qty`, `user_email`, `order_status_id`, `product_id`, `date`, `color_id`, `invoice_id`) 
        VALUES('" . $orderId . "', '" . $pri . "', '" . $q . "', '" . $_SESSION['u']['email'] . "', '1', '" . $pId . "', '" . $date . "', '" . $c . "', '". $invoice_id ."') ");

        $newQey = $avb - $q;

        Database::iud("UPDATE `product` SET `qty` = '" . $newQey . "' WHERE `id` = '" . $pId . "' ");

        echo('Success');
        
    } else {
            
        Database::iud("INSERT INTO `order`(`id`, `price`, `qty`, `user_email`, `order_status_id`, `product_id`, `date`, `color_id`, `invoice_id`) 
        VALUES('" . $orderId . "', '" . $pri . "', '" . $q . "', '" . $_SESSION['u']['email'] . "', '1', '" . $pId . "', '" . $date . "', '" . $c . "', '". $invoice_id ."') ");

        $newQey = $avb - $q;

        Database::iud("UPDATE `product` SET `qty` = '" . $newQey . "' WHERE `id` = '" . $pId . "' ");

        Database::iud("INSERT INTO `promo_usage`(`promo_code_id`, `dis_value`, `user_email`, `invoice_id`) 
        VALUES('". $dis_id ."', '". $dis ."', '". $_SESSION['u']['email'] ."', '". $invoice_id ."') ");

        echo('Success');
        
    }

?>