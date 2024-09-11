<?php

    session_start();
    include "connection.php";

    require "SMTP.php";
    require "PHPMailer.php";
    require "Exception.php";

    use PHPMailer\PHPMailer\PHPMailer;
    
    $oId = $_GET['odrId'];

    Database::iud("UPDATE `order` SET `order_status_id` = '4' WHERE `id` = '". $oId ."' AND `user_email` = '". $_SESSION['u']['email'] ."' ");

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
    $mail->addAddress($_SESSION['u']['email']);
    $mail->isHTML(true);
    $mail->Subject = 'Neo Mobiles Order Cancel.';
    $bodyContent = '<h1 style="color: red; font-weight: bold;">Neo Mobiles Order Canceled</h1<br>';
    $bodyContent .= '<h3>Hi ' . $_SESSION['u']['fname'] . ' ' . $_SESSION['u']['lname'] . '</h2><br>';
    $bodyContent .= '<p>Hi! your order was canceled successfull.Your payment is refund into 24 hours.If you have any issue you can contact us.</p><br>';
    $bodyContent .= '<p>Mobile : 074 1387 807</p><br>';
    $mail->Body    = $bodyContent;

    $mail->send();

    header('location: myOrder.php');

?>