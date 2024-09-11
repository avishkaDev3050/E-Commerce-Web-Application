<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../signIn.php');
}

    include "../connection.php";
    $c = $_GET['clr'];
    
    if (empty($c)) {
        echo('Please enter a color');
    } else {

        Database::iud("INSERT INTO `color`(`color`) VALUES('". $c ."')");

        echo('Success');

    }

?>