<?php

    session_start();
    include "connection.php";

    $l1 = $_POST['l1'];
    $l2 = $_POST['l2'];
    $z  = $_POST['z'];
    $c  = $_POST['c'];
    $d  = $_POST['d'];

    if (empty($l1)) {
        echo('Please enter your address line 1.');
    } else if (empty($l2)) {
        echo('Please enter your address line 2.');
    } else if (empty($z)) {
        echo('Please enter your zip code.');
    } else if (empty($c)) {
        echo('Please select your city.');
    } else if (empty($d)) {
        echo('Please enter your address district.');
    } else {

        Database::iud("INSERT INTO `address`(`line_1`, `line_2`, `zip_code`, `user_email`, `district_id`, `city_id`) VALUES('". $l1 ."', '". $l2 ."', '". $z ."', '". $_SESSION['u']['email'] ."', '". $d ."', '". $c ."') ");
        Database::iud("UPDATE `user` SET `address_status` = '1' WHERE `email` = '". $_SESSION['u']['email'] ."' ");
        echo("Success");

    }

?>