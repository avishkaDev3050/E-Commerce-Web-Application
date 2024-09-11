<?php


session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../signIn.php');
}


    include "../connection.php";

    $id = $_GET['id'];

    Database::iud("DELETE FROM `promo_code` WHERE `id` = '". $id ."' ");

    header('location: promoList.php');

?>