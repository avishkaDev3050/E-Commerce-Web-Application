<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])) {

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."'");
    $n = $rs -> num_rows;

    if($n == 1) {

        $user = $rs->fetch_assoc();

        $code = uniqid();

        Database::iud ("UPDATE `user` SET `verification_code` = '".$code."' WHERE
        `email` = '".$email."'");

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'avishkapriyasoma@gmail.com';
            $mail->Password = 'wmmfwytkfhbhdhpp';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('avishkapriyasoma@gmail.com', 'Reset Password');
            $mail->addReplyTo('avishkapriyasoma@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Neo Mobiles Forgot Password Verification Code';
            $bodyContent = '<h1 style="color: red; font-weight: bold;">Neo Mobiles</h1<br>';
            $bodyContent .= '<h3>Hi ' . $user['fname'] . ' ' . $user['lname'] . '</h2><br>';
            $bodyContent .= '<h4>Your code is: ' . $code . '</h4>';
            $mail->Body    = $bodyContent;

            if(!$mail -> send()) {
                echo 'Verification code sending failed';
            }else {
                echo 'Success';
            }

    }else {
        echo ("Invalid Email address");
    }

}

?>