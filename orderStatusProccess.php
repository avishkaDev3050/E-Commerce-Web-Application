<?php

    include "connection.php";
        
    require "SMTP.php";
    require "PHPMailer.php";
    require "Exception.php";

    use PHPMailer\PHPMailer\PHPMailer;


    $oId = $_GET['oId'];
    $email = $_GET['email'];

    Database::search("UPDATE `order` SET `order_status_id` = '3' WHERE `id` = '". $oId ."' ");

    
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'avishkapriyasoma@gmail.com';
    $mail->Password = 'wmmfwytkfhbhdhpp';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('avishkapriyasoma@gmail.com', 'Neo Mobile Delivery Department');
    $mail->addReplyTo('avishkapriyasoma@gmail.com', 'Reset Password');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Neo Mobiles Order Delivery Confirmed.';
    $bodyContent = '<h1 style="font-weight: bold;">Neo Mobiles Delivery Department</h1<br>';
    $bodyContent = '<p style="font-size: 18px;">Hello valuable custormer your order is delivered now.</p<br>';
    $mail->Body    = $bodyContent;

    $mail->send();


    header('location: orderStatus.php');

?>