<?php

    session_start();
    include "connection.php";

    if(isset($_SESSION['u'])) {
        
        if (isset($_GET['id'])) {
            
            $wish_list = Database::search("SELECT * FROM `watch_list` WHERE `product_id` = '". $_GET['id'] ."' AND `email` = '". $_SESSION['u']['email'] ."' ");
            $numn = $wish_list->num_rows;

            if ($numn == 1) {
                echo 'update';
            } else {

                Database::iud("INSERT INTO `watch_list`(`product_id`, `email`)
                VALUES('". $_GET['id'] ."', '". $_SESSION['u']['email'] ."') ");

                echo 'success';
                
            }

        }

    } else {
        echo 'error';
    }

?>