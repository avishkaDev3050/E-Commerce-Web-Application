<?php

    session_start();
    include "connection.php";

    $coupon = $_GET['c_code'];
    $price = $_GET['price'];
    $dis = $_GET['dis'];
    $dis_id = $_GET['dis_id'];
    $email = $_SESSION['u']['email'];

    $invoice_id = uniqid();
    
    if (empty($coupon)) {   

        $d = new DateTime();
        $date = $d->format("Y-m-d");
    
        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '". $email ."' ");
        $num_rs = $cart_rs->num_rows;

        for ($i=0; $i < $num_rs; $i++) { 
    
            $cart_products = $cart_rs->fetch_assoc();
    
            $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '". $cart_products['product_id'] ."'");
            $product    = $product_rs->fetch_assoc();
    
            $orderId = uniqid();
            $product_id = $product['id'];
            $qty = $cart_products['qty'];
            $avbQty = $product['qty'];
            $color_id = $cart_products['color'];
            $price = $product['price'];
    
                
            Database::iud("INSERT INTO `order`(`id`, `price`, `qty`, `user_email`, `order_status_id`, `product_id`, `date`, `color_id`, `invoice_id`) 
            VALUES('" . $orderId . "', '" . $price . "', '" . $qty . "', '" . $email . "', '1', '" . $product_id . "', '" . $date . "', '" . $color_id . "', '". $invoice_id ."') ");
    
            
            $newQey = $avbQty - $qty;
    
            Database::iud("UPDATE `product` SET `qty` = '" . $newQey . "' WHERE `id` = '" . $product_id . "' ");
            Database::iud("DELETE FROM `cart` WHERE `id` = '". $cart_products['id'] ."' AND `user_email` = '". $email ."' ");
       
            echo('Success');

        }

    } else {
        
        
        $d = new DateTime();
        $date = $d->format("Y-m-d");
    
        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '". $email ."' ");
        $num_rs = $cart_rs->num_rows;
    
        for ($i=0; $i < $num_rs; $i++) { 
    
            $cart_products = $cart_rs->fetch_assoc();
    
            $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '". $cart_products['product_id'] ."'");
            $product    = $product_rs->fetch_assoc();
    
            
            $orderId = uniqid();
            $product_id = $product['id'];
            $qty = $cart_products['qty'];
            $avbQty = $product['qty'];
            $color_id = $cart_products['color'];
            $price = $product['price'];

            $coupons = Database::search("SELECT * FROM `promo_code` WHERE `promo_code` = '". $coupon ."' ");
            $c_num = $coupons->num_rows;
            
            $total;
            if ($c_num > 0) {
                $c_data = $coupons->fetch_assoc();
                $discount = $c_data['discount'];
                $total = $price * ($discount / 100);
                $newPrice = $price - $total;
            }
    
            Database::iud("INSERT INTO `order`(`id`, `price`, `qty`, `user_email`, `order_status_id`, `product_id`, `date`, `color_id`, `invoice_id`) 
            VALUES('" . $orderId . "', '" . $newPrice . "', '" . $qty . "', '" . $email . "', '1', '" . $product_id . "', '" . $date . "', '" . $color_id . "', '". $invoice_id ."') ");
    
            
            $newQey = $avbQty - $qty;
    
            Database::iud("UPDATE `product` SET `qty` = '" . $newQey . "' WHERE `id` = '" . $product_id . "' ");
            Database::iud("DELETE FROM `cart` WHERE `id` = '". $cart_products['id'] ."' AND `user_email` = '". $email ."' ");
        
        }

        Database::iud("INSERT INTO `promo_usage`(`promo_code_id`, `dis_value`, `user_email`, `invoice_id`) 
        VALUES('". $dis_id ."', '". $dis ."', '". $_SESSION['u']['email'] ."', '". $invoice_id ."') ");
        echo('Success');

    }


?>