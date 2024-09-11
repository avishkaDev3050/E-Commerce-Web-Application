<?php

    session_start();
    include "connection.php";

    $user = $_SESSION['u'];

    $fname   = $_POST['fname'];
    $lname   = $_POST['lname'];
    $mobile  = $_POST['mobile'];

    if (empty($fname)) {
        echo('Please enter your first name.');
    } else if(empty($lname)) {
        echo('Please enter your last name.');
    }  else if (empty($mobile)) {
        echo('Please enter your mobile number');
    } else {

        Database::iud("UPDATE `user` SET `fname` = '". $fname ."', `lname` = '". $lname ."', `mobile` = '". $mobile ."' WHERE `email` = '". $user['email'] ."' ");

        echo('Success');

    }

?>