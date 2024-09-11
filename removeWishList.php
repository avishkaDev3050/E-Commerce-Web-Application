<?php

    session_start();
    include "connection.php";

    if (isset($_SESSION['u'])) {
        
        if (isset($_GET['id'])) {
            
            Database::iud("DELETE  FROM `watch_list` WHERE `id` = '". $_GET['id'] ."' ");

            header('location: wishList.php');

        }

    }

?>