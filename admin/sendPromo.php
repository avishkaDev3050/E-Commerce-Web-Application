<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../signIn.php');
}

    include "../connection.php";

    $id = $_GET['id']; 

    $mail;
    
    require "../SMTP.php";
    require "../PHPMailer.php";
    require "../Exception.php";

    use PHPMailer\PHPMailer\PHPMailer;

    $promos = Database::search("SELECT * FROM `promo_code` WHERE `id` = '". $id ."' ");
    $promo_data = $promos->fetch_assoc();

    
    $users = Database::search("SELECT * FROM `user` WHERE `status` = '1' ");
    $users_n = $users->num_rows;
    if ($users_n > 0) {
        for ($i=0; $i < $users_n; $i++) { 

            $user = $users->fetch_assoc();
            $email = $user['email'];
                
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'avishkapriyasoma@gmail.com';
            $mail->Password = 'wmmfwytkfhbhdhpp';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('avishkapriyasoma@gmail.com', 'Neo Mobiles Offer');
            $mail->addReplyTo('avishkapriyasoma@gmail.com', 'Reset Password');
            $mail->addAddress($user['email']);
            $mail->isHTML(true);
            $mail->Subject = 'Neo Mobiles Offer Season.';
            $bodyContent = '
                    
                                <h1>Hello dear ' . $user['fname'] . ' ' . $user['lname'] . ' !</h1>
                                <p>
                                    Welcome to neo mobiles. <br/>
                                    You can get offer enjoy this season.<br/>
                                    Your promo code is : ' . $promo_data['promo_code'] . ' and <br>
                                    '. $promo_data['discount'] .'% discoucnt from item. 
                                </p> 
                            ';
            $mail->Body    = $bodyContent;

            $mail->send();


        }
    }

    
    if (!$mail->send()) {
        echo('Proccess Failed.');
    } else {
        echo('Success');
    }
?>