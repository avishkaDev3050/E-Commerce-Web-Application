<?php

    include "connection.php";

    $id = $_GET['id'];

    Database::iud("DELETE FROM `cart` WHERE `id` = '". $id ."' ");
    header('location: cart.php');


?>