<?php

    include "connection.php";;
    session_start();

    $password = $_POST['psw'];
    $email = $_POST['em'];

    $adminRs = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "' AND `password` = '". $password ."' ");

    $row = $adminRs->num_rows;

    if ($row > 0) {
        $admin = $adminRs->fetch_assoc();
        echo 'success';
        $_SESSION['admin'] = $admin;
    } else {
        echo 'Invalid Password';
    }

?>