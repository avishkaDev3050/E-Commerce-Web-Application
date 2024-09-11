<?php

session_start();
include "connection.php";;


if (isset($_SESSION['u'])) {

    $pid = $_GET['id'];
    $qty = $_GET['qty'];
    $clr = $_GET['clr'];

    if ($clr == 0) {
        echo 'Please select a color';
    } else {

        $products = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");
        $prod_n = $products->num_rows;
        if ($prod_n > 0) {
            $product = $products->fetch_assoc();
            $avbqty = $product['qty'];

            if ($avbqty < $qty) {
                echo('Invalid quantity.Please select less than ' . $avbqty . '.' );
            } else {

                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id` = '" . $pid . "' AND `user_email` = '" . $_SESSION['u']['email'] . "' AND `color` = '" . $clr . "' ");
                $cart_nm = $cart_rs->num_rows;

                if ($cart_nm == 1) {
                    Database::iud("UPDATE `cart` SET `qty` = '" . $qty . "' WHERE `user_email` = '" . $_SESSION['u']['email'] . "' ");
                    echo 'success';
                } else {

                    Database::iud("INSERT INTO `cart`(`qty`, `product_id`, `user_email`, `color`) 
                    VALUES('" . $qty . "', '" .  $pid . "', '" . $_SESSION['u']['email'] . "', '" . $clr . "') ");
                    echo 'success';
                }
            }
        }
    }
} else {
    echo 'error';
}
