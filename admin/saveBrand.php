<?php

    session_start();
    if (!isset($_SESSION['admin'])) {
        header('location: ../signIn.php');
    }
    include "../connection.php";
    $b = $_GET['brn'];
    
    if (empty($b)) {
        echo('Please enter a brand');
    } else {

        Database::iud("INSERT INTO `brand`(`brand`) VALUES('". $b ."')");

        echo('Success');

    }

?>