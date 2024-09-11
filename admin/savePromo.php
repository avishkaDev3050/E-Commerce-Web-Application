<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../signIn.php');
}

    include "../connection.php";
    
    $promo  = $_GET['promo'];
    $dis    = $_GET['dis'];
    $exp    = $_GET['exp'];

    if (empty($promo)) {
        echo('Please enter new promo code.');
    } else if (empty($dis)) {
        echo('Please enter persontage of discount.');
    } else if (empty($exp)) {
        echo('Please enter expire date.');
    } else {

        $promos = Database::search("SELECT * FROM `promo_code` WHERE `promo_code` = '". $promo ."' ");
        $promo_n = $promos->num_rows;
       
        if ($promo_n > 0) {
            
            echo('Already registered');
            
        } else {
  
            Database::iud("INSERT INTO `promo_code`(`promo_code`, `discount`, `exp_date`) VALUES('". $promo ."', '". $dis ."', '". $exp ."')");
            
            echo('Success');

        }

    }
 
?>