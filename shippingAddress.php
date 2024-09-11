<?php

    session_start();
    include "connection.php";

    $adr = $_POST['adr'];

    if (empty($adr)) {
        echo('Please select a shipping address.');
    } else {

        Database::iud("UPDATE `order` SET `address_id` = '". $adr ."' WHERE `user_email` = '". $_SESSION['u']['email'] ."' ");

        echo('Success');

    }

?>