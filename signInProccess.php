<?php

    session_start();
    include "connection.php";;

    $uname = $_POST['uname'];
    $pass  = $_POST['pass'];
    $check = $_POST['check'];

    if (empty($uname)) {
        echo 'Please enter your email address.';
    } else if (strlen($uname) > 100) {
        echo ("Email must have less than 100 characters");
    } else if (!filter_var($uname, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email address';
    } else if (empty($pass)) {
        echo 'Please enter your password.';
    } else if (strlen($pass) < 5 || strlen($pass) > 20) {
        echo ("Password must be between 5 - 20 characters");
    } else {

        $rs = Database::search("SELECT * FROM `user` WHERE `email` = '". $uname ."' AND `password` ='". $pass ."' ");
        $n  = $rs->num_rows;

        if ($n == 1) {
            $d = $rs->fetch_assoc();

            if ($d['status'] == '1') {
                    
                echo "success";
                $_SESSION['u'] = $d;

                if($check == "true") {

                    setcookie("email",$uname,time() + (60*60*24*365));
                    setcookie("password",$pass,time() + (60*60*24*365));
        
                }else {
        
                    setcookie("email","", -1);
                    setcookie("password","", -1);
        
                }
            } else {
                echo('Deactivate account please contact admin.');
            }
            
        } else {
            echo "Invalid password or email address !!!";
        }

    }

?>