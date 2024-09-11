<?php

    session_start();
    include "connection.php";
    $email = $_SESSION['u']['email'];

    $address = Database::search("SELECT * FROM `address` WHERE `user_email` = '". $email ."' ");
    $adr_dt  = $address->fetch_assoc();
    $adrs = $adr_dt['line_1'] . ' ' . $adr_dt['line_2'];

    $city = Database::search("SELECT * FROM `city` WHERE `id` = '". $adr_dt['city_id'] ." '");
    $city_dt = $city->fetch_assoc();
    $city_name = $city_dt['city'];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '". $email ."' ");
    $num_rs = $cart_rs->num_rows;

    $qty;
    if ($num_rs > 0) {
        for ($i=0; $i < $num_rs; $i++) { 

            $cart_products = $cart_rs->fetch_assoc();
    
            $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '". $cart_products['product_id'] ."'");
            $product    = $product_rs->fetch_assoc();
            
            $qty = $cart_products['qty'];
    
            $model = Database::search("SELECT * FROM `model` WHERE `id` = '". $product['model_id'] ."' ");
            $model_name = $model->fetch_assoc();
    
        } 
    } else {
        echo('Cart is empty');
    }

    $price = $_GET['price'];

    $amount = $price * $qty + 5000;
    // $amount = 30;
    $merchant_id = "1226423";
    $order_id = uniqid();
    $currency = "LKR";
    $item = 'Apple iPhone 11, Appl iPhone 7';
    $merchant_secret = "MzkzMjU5NTAzNjI2Mjk2Njc3MTIyNDYzNTc3NjYwMTY1MjExNjgyNg==";
    $fname = $_SESSION['u']['fname'];
    $lname = $_SESSION['u']['lname'];
    $phone = $_SESSION['u']['mobile'];
    $addres = $adrs;
    $city = $city_name;
    $country = "Sri Lanka";

    $hash = strtoupper(
        md5(
            $merchant_id .
                $order_id .
                number_format($amount, 2, '.', '') .
                $currency .
                strtoupper(md5($merchant_secret))
        )
    );

    $array = [];
    $array["amount"] = $amount;
    $array["merchant_id"] = $merchant_id;
    $array["order_id"] = $order_id;
    $array["currency"] = $currency;
    $array["item"] = $item;
    $array["merchant_secret"] = $merchant_secret;
    $array["fname"] = $fname;
    $array["lname"] = $lname;
    $array["email"] = $email;
    $array["phone"] = $phone;
    $array["addres"] = $addres;
    $array["city"] = $city;
    $array["country"] = $country;
    $array["hash"] = $hash;
    
    $jsonObj = json_encode($array);            
    echo $jsonObj;

?>