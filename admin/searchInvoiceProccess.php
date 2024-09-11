<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../signIn.php');
}

    include "../connection.php";

    $txt = $_GET['txt'];

    $arr = [];

    if (empty($txt)) {
        $arr['err'] = '1';
    } else {

        $order        = Database::search("SELECT * FROM `order` WHERE `order_status_id` = '3' AND `invoice_id` = '". $txt ."' ");
        $order_n = $order->num_rows;
        
        if($order_n > 0) { 
            for ($i=0; $i < $order_n; $i++) { 
                $order_data   = $order->fetch_assoc();

            $id = $order_data['id'];
            $arr['id'] = $id;
            $qty = $order_data['qty'];
            $arr['q'] = $qty;
            $date = $order_data['date'];
            $arr['date'] = $date;

            $product        = Database::search("SELECT * FROM `product` WHERE `id` = '". $order_data['product_id'] ."' ");
            $prod_n = $product->num_rows;

            $users = Database::search("SELECT * FROM `user` WHERE `email` = '". $order_data['user_email'] ."' ");
            $user_num = $users->num_rows;

            if ($user_num > 0) {
                $user_data = $users->fetch_assoc();
                $mobile = $user_data['mobile'];
                $arr['mob'] = $mobile;
            }
            
            if ($prod_n > 0) {
                $product_data   = $product->fetch_assoc();

                $brand = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $product_data['brand_id'] . "' ");
                $brand_name = $brand->fetch_assoc();

                $model = Database::search("SELECT * FROM `model` WHERE `id` = '" . $product_data['model_id'] . "' ");
                $model_name = $model->fetch_assoc();

                $item = $brand_name['brand'] . ' ' . $model_name['model'];
                $arr['mod'] = $item;;
            }
            
            $msg = 'Success';
            $arr['msg'] = $msg;

            }
        } else {
            $arr['not'] = '2';
        } 
    
    }

    $json = json_encode($arr);
    echo($json);

?>