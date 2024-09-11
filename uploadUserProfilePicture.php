<?php

    session_start();
    include "connection.php";

    $user = $_SESSION['u'];
    
    if (empty($_FILES['profile'])) {
        echo('Please select your profile picture.');
    } else {
        $pro_pic = "resource/profile/" . uniqid() . $_FILES['profile']['name'];
        move_uploaded_file($_FILES['profile']['tmp_name'], $pro_pic);

        Database::iud("UPDATE `user` SET `profile_pic` = '". $pro_pic ."' WHERE `email` = '". $user['email'] ."' ");

        echo 'Success';
    }


?>