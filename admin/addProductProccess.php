<?php


    session_start();
    if (!isset($_SESSION['admin'])) {
        header('location: ../signIn.php');
    }


    include "../connection.php";

    $pId = $_POST['pId'];
    $qty = $_POST['qty'];
    $dis = $_POST['dis'];
    $cat = $_POST['cat'];
    $brn = $_POST['brn'];
    $mod = $_POST['mod'];
    $pri = $_POST['pri'];
    $pClr = $_POST['pClr'];

    if (empty($pId)) {
        echo('Please enter product ID.');
    } else if (empty($qty)) {
        echo('Please enter product quantity..');
    } else if (empty($pri)) {
        echo('Please enter product price.');
    } else if (empty($dis)) {
        echo('Please enter product description.');
    } else if ($cat == 0) {
        echo('Please select product catagary.');
    } else if ($brn == 0) {
        echo('Please select product brand.');
    } else if ($mod == 0) {
        echo('Please select product model.');
    } else if (empty($_FILES['img'])) {
        echo('Please select a product image.');
    } else if ($pClr == 0) {
        echo('Please select a product colour.');
    } else {
        
        Database::iud("INSERT INTO `product`(`id`, `price`, `description`, `catagary_id`, `brand_id`, `model_id`, `qty`, `color_id`) 
        VALUES('". $pId ."', '". $pri ."', '". $dis ."', '". $cat ."', '". $brn ."', '". $mod ."', '". $qty ."', '". $pClr ."')");

        $prod_img = "resource/products/" . $pId . $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], "../resource/products/" . $pId . $_FILES['img']['name']);

        Database::iud("INSERT INTO `product_iMG`(`img`, `product_id`) VALUES('". $prod_img ."', '". $pId ."') ");
        
        echo('Success');

    }

?>