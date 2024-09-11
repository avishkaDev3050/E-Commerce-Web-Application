<?php

    session_start();
    if (!isset($_SESSION['admin'])) {
        header('location: ../signIn.php');
    }

    include "../connection.php";

    $e = $_GET['em'];
    
    Database::search("UPDATE `user` SET `status` = '0' WHERE `email` = '". $e ."' ");

    header('location: usersList.php');

?>