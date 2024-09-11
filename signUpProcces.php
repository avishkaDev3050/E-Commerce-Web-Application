<?php

    include "connection.php";

    $e = $_POST['e'];
    $m = $_POST['m'];
    $f = $_POST['f'];
    $l = $_POST['l'];
    $p = $_POST['p'];

    if (empty($e)) {
        echo 'Please enter your email address !!!';
    } else if (strlen($e) > 100) {
        echo "Email must have less than 100 characters !!!";
    } else if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email address !!!';
    } else if(empty($f)) {
        echo 'Please enter first name. !!!';
    } else if (strlen($f) > 50) {
        echo "first name must have less than 50 characters !!!";
    } else if (empty($l)) {
        echo 'Please enter your last name !!!';
    } else if (strlen($l) > 55) {
        echo "last name must have less than 50 characters !!!";
    } else if (empty($m)) {
        echo ("Please enter your Mobile !!!");
    } else if (strlen($m) != 10) {
        echo ("Mobile must have 10 characters !!!");
    } else if (!preg_match("/07[0,1,2,3,4,5,6,7,8][0-9]/", $m)) {
        echo ("Invalid Mobile !!!");
    }else if (empty($p)) {
        echo 'Please enter your password !!!';
    } else if (strlen($p) < 5 || strlen($p) > 20 ) {
        echo ("Password must be between 5 - 20 characters !!!");
    } else {

        $user_rs  = Database::search("SELECT * FROM `user` WHERE `email` = '". $e ."' ");
        $user_num = $user_rs->num_rows;

        if ($user_num == 1) {
            echo 'All ready have an account';
        } else {

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            Database::iud("INSERT INTO `user`(`fname`, `lname`, `email`, `mobile`, `password`, `joined_date`, `status`, `address_status`, `profile_pic`) 
            VALUES('". $f ."', '". $l ."', '". $e ."', '". $m ."', '". $p ."', '". $date ."', '1', '0', 'resource/profile/profile.jpg')");

            echo 'success';

        }

    }

?>