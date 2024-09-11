<?php

    session_start();
    if (!isset($_SESSION['admin'])) {
        header('location: ../signIn.php');
    }

    include "../connection.php";

    $oId = $_GET['oId'];

    if (isset($oId)) {
        
        Database::iud("UPDATE `order` SET `order_status_id` = '2' WHERE `id` = '". $oId ."' ");

        header('location: pendingOrders.php');

    }

?>