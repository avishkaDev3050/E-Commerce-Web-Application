<?php

session_start();
include "connection.php";

if (isset($_SESSION['u'])) {
    if (isset($_POST['id'])) {

        $email = $_SESSION['u']['email'];
        $pid   = $_POST['id'];
        $qty   = $_POST['qty'];
        $color = $_POST['color'];
        $pri = $_POST['pri'];

        if (empty($color)) {
            echo '3';
        } else {
            $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");
            $product    = $product_rs->fetch_assoc();

            if ($product['qty'] < $qty) {
                echo('2');
            } else {
                $model = Database::search("SELECT * FROM `model` WHERE `id` = '" . $product['model_id'] . "' ");
                $model_name = $model->fetch_assoc();

                $line_1 = '';
                $line_2 = '';
                $city_name = '';

                $adddress_rs = Database::search("SELECT *  FROM `address` WHERE `user_email` = '" . $email . "' ");
                $adddress_num = $adddress_rs->num_rows;
                if ($adddress_num == 0) {
                    echo ('1');
                } else {
                    $adddress    = $adddress_rs->fetch_assoc();
                    $line_1 = $adddress['line_1'];
                    $line_2 = $adddress['line_2'];
                    $city_rs = Database::search("SELECT * FROM `city` WHERE `id` = '" . $adddress['city_id'] . "' ");
                    $city_name  = $city_rs->fetch_assoc();
                }

                $amount = $qty * $pri + 5000;
                // $amount = 30;
                $merchant_id = "1226423";
                $order_id = uniqid();
                $currency = "LKR";
                $item = $model_name['model'];
                $merchant_secret = "MzkzMjU5NTAzNjI2Mjk2Njc3MTIyNDYzNTc3NjYwMTY1MjExNjgyNg==";
                $fname = $_SESSION['u']['fname'];
                $lname = $_SESSION['u']['lname'];
                $phone = $_SESSION['u']['mobile'];
                $addres = $line_1 . ' ' . $line_2;
                $city = $city_name['city'];
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
            }
        }
    }
} else {
    echo ('0');
}
