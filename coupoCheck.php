<?php

use Random\RandomError;

    session_start();
    include "connection.php";
       
    $c_code = $_POST['c_code'];
    $price = $_POST['price'];
    $array = [];
    
    if (!isset($_SESSION['u'])) {
        $log = 'log';
        $array['log'] = $log;
    } else {
     
        if (empty($c_code)) {
            $emt = 'emt';
            $array['emt'] = $emt;
        } else {

            $coupons = Database::search("SELECT * FROM `promo_code` WHERE `promo_code` = '". $c_code ."'   ");
            $c_num = $coupons->num_rows;

            if ($c_num > 0) {
                
                $promo_usage = Database::search("SELECT * FROM `promo_usage` WHERE `user_email` = '". $_SESSION['u']['email'] ."' ");
                $promo_usage_num = $promo_usage->num_rows;
            
                if ($promo_usage_num > 0) {
                    $used = 'used';
                    $array['used'] = $used;
                } else {
                    
                    $c_data = $coupons->fetch_assoc();
                    $d = new DateTime();
                    $date = $d->format('Y-m-d');
                    
                    if ($c_data['exp_date'] < $date) {
                        $exp = 'exp';
                        $array['exp'] = $exp;
                    } else {
                        
                        $discount = $c_data['discount'];
                        
                        $dis_value = $price * ($discount / 100);
                        $amount = $price - $dis_value;

                        $msg = 'Success';
                        $array['msg'] = $msg;
                        $array['amount'] = $amount;
                        $array['dis'] = $dis_value;
                        $id = $c_data['id'];
                        $array['id'] = $id;

                    }

                }

            } else {
                $invd = 'invd';
                $array['invd'] = $invd;
            }

        }

    }

    $json = json_encode($array);
    echo($json);

?>