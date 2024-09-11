<?php

include "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;


$email = $_GET['em'];

if (empty($email)) {
    echo ("Please enter admin password.");
} else {


    $adminRow   = Database::search("SELECT * FROM `admin` WHERE `email` = '" . $email . "' ");
    $row        = $adminRow->num_rows;

    if ($row > 0) {

        $user   = $adminRow->fetch_assoc();
        $status = $user['status'];

        if ($status == 1) {


            $password   = uniqid();

            Database::iud("UPDATE `admin` SET `password` = '" . $password . "' WHERE `email` = '" . $email . "' ");


            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'avishkapriyasoma@gmail.com';
            $mail->Password = 'wmmfwytkfhbhdhpp';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('avishkapriyasoma@gmail.com', 'Admin Password');
            $mail->addReplyTo('avishkapriyasoma@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Neo Mobiles Admin Verification Code';
            $bodyContent = '
                    
                                <h1>Hello dear ' . $user['fname'] . ' ' . $user['lname'] . ' !</h1>
                                <p>
                                    Welcome to neo mobiles admin panel. <br/>
                                    You are active admin. <br/>
                                    Your password is : ' . $password . ' 
                                </p> 
                            ';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Password sending failed';
            } else {
                echo('Success');
            }
        } else {
            echo('Yor are deactivated admin.');
        } 
    } else {
        echo('Invalid email');
    }
}
