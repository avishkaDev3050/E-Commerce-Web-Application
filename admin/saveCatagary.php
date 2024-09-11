<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../signIn.php');
}

    include "../connection.php";
    $c = $_GET['cat'];
    
    if (empty($c)) {
        echo('Please enter a catagary');
    } else {

        Database::iud("INSERT INTO `catagary`(`catagary`) VALUES('". $c ."')");

        echo('Success');

    }

?>