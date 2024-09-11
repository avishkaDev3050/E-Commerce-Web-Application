<?php

    session_start();
    include "connection.php";

    $id = $_GET['id'];

    Database::iud("DELETE FROM `address` WHERE `id` = '". $id ."' AND `user_email` = '". $_SESSION['u']['email'] ."' ");

    header("location: userAddressBook.php");

?>