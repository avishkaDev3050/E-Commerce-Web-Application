<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
</head>

<body >

    <!-- heaader -->
    <?php include "header.php"; ?>
    <!-- heaader -->

    <div class="container">
        <div class="row">

            <div class="col-12">
                <h1 class="text-center mt-3">My Orders</h1>
            </div>

            <?php

            include "connection.php";

            $items = Database::search("SELECT * FROM `order` WHERE `user_email` = '" . $_SESSION['u']['email'] . "' ");
            $item_num = $items->num_rows;
            if ($item_num > 0) {
                for ($i = 0; $i < $item_num; $i++) {
                    $item_data = $items->fetch_assoc()

            ?>
                    <div class="cop-12 col-md-6 col-lg-4 mt-2 mb-5">
                        <div class="mt-5">
                            <label>Order date : <?php echo ($item_data['date']); ?></label>
                        </div>
                        <div class="cart bg-dark-subtle mt-2 rounded-4 d-flex gap-3 p-3">
                            <div>
                                <?php

                                $p_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $item_data['product_id'] . "' ");
                                $p_img    = $p_img_rs->fetch_assoc();

                                ?>
                                <img src="<?php echo $p_img['img']; ?>" alt="product image" style="width: 130px; margin-top: 10px;">
                            </div>
                            <div class="d-flex flex-column mt-4">
                                <?php
                                $product_details = Database::search("SELECT * FROM `product` WHERE `id` = '" . $item_data['product_id'] . "' ");
                                $data = $product_details->fetch_assoc();

                                $brands = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $data['brand_id'] . "'");
                                $brand  = $brands->fetch_assoc();

                                $models = Database::search("SELECT * FROM `model` WHERE `id` = '" . $data['model_id'] . "' ");
                                $model = $models->fetch_assoc();
                                ?>
                                <label>Item : <?php echo $brand['brand'] . ' ' . $model['model'] ?></label>
                                <label>Quantity : <?php echo ($item_data['qty']); ?></label>
                                <label>Price : Rs <?php echo ($item_data['price']); ?></label>
                                <?php
                                $pColor = Database::search("SELECT * FROM `color` WHERE `id` = '" . $item_data['color_id'] . "' ");
                                $clr_n = $pColor->num_rows;
                                if ($clr_n > 0) {
                                    $clr_data = $pColor->fetch_assoc();
                                ?>
                                    <label>Colour : <?php echo ($clr_data['color']); ?></label>
                                <?php
                                }
                                ?>
                                <?php
                                if ($item_data['order_status_id'] == 1) {
                                ?>
                                    <label>Order Status : Pending</label>
                                <?php
                                } else if ($item_data['order_status_id'] == 2) {
                                ?>
                                    <label>Order Status : Proccesing</label>
                                <?php
                                } else if ($item_data['order_status_id'] == 3) {
                                ?>
                                    <label>Order Status : Delivered</label>
                                <?php
                                } else if ($item_data['order_status_id'] == 4) {
                                ?>
                                    <label>Order Status : Canceled</label>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                        <?php
                        if ($item_data['order_status_id'] == 4) {
                        } else if ($item_data['order_status_id'] == 3) {
                        ?>
                            <div class="card-footer p-3">
                                <?php
                                    $id = $item_data['id'];
                                    $item = $brand['brand'] . ' ' . $model['model'];
                                    $invoice = $item_data['invoice_id'];
                                ?>
                                <a href="invoice.php?odrId=<?php echo $id; ?>&item=<?php echo $item ?>&invoicee_id=<?php echo $invoice ?>" class="btn btn-outline-info float-end ms-2">Invoice</a>
                            </div>
                        <?php
                        } else if ($item_data['order_status_id'] == 2) {
                        ?>
                            <div class="card-footer p-3">
                                <?php
                                    $id = $item_data['id'];
                                    $item = $brand['brand'] . ' ' . $model['model'];
                                    $invoice = $item_data['invoice_id'];
                                ?>
                                <a href="invoice.php?odrId=<?php echo $id; ?>&item=<?php echo $item ?>&invoicee_id=<?php echo $invoice ?>" class="btn btn-outline-info float-end ms-2">Invoice</a>
                            </div>
                        <?php
                        } else if ($item_data['order_status_id'] == 1) {
                        ?>
                            <div class="card-footer p-3">
                                <?php
                                    $id = $item_data['id'];
                                    $item = $brand['brand'] . ' ' . $model['model'];
                                    $invoice = $item_data['invoice_id'];
                                ?>
                                <a href="invoice.php?odrId=<?php echo $id; ?>&item=<?php echo $item ?>&invoice_id=<?php echo $invoice ?>" class="btn btn-outline-info float-end ms-2">Invoice</a>
                                <a class="btn btn-outline-info float-end ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Set Address</a>
                                <a class="btn btn-outline-danger float-end ms-2" href="<?php echo ('cancelProduct.php?odrId=' . $item_data['id']); ?>" onclick="return confirm('Canceled after check your email <?php echo ($_SESSION['u']['email']); ?>.');">Cancel Orders</a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="co-12 d-lg-flex justify-content-center">
                    <div class="row mt-5">
                        <img src="resource/out-of-stock.png" alt="empty address picture" style="width: 300px; margin-top: 50px; margin-bottom: 100px;">
                    </div>
                </div>
            <?php
            }
            ?>

            <!-- address modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Shipping Address</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="d-none" id="msg">
                                    <p class="text-white fw-bold" id="err"></p>
                                </div>               
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Address</label>
                                    <select id="adr" class="form-select">
                                        <option value="0">Select a address</option>
                                        <?php
                                                                            
                                            $user = $_SESSION['u'];

                                            $address = Database::search("SELECT * FROM `address` WHERE `user_email` = '" . $user['email'] . "' ");

                                            $num = $address->num_rows;

                                            if ($num > 0) {
                                                for ($i = 0; $i < $num; $i++) {
                                                    $address_data = $address->fetch_assoc();
                                        ?>
                                                    <option value="<?php echo($address_data['id']); ?>">
                                                        <?php echo($address_data['line_1'] . ' ' . $address_data['line_2']); ?>
                                                    </option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-outline-info" onclick="shippingAddress();">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- address modal -->

        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="script.js"></script>
</body>
</html>