<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../signIn.php');
}

    include "../connection.php";
    $m = $_GET['mod'];
    
    if (empty($m)) {
        echo('Please enter a model');
    } else {

        Database::iud("INSERT INTO `model`(`model`) VALUES('". $m ."')");

        echo('Success');

    }

?>