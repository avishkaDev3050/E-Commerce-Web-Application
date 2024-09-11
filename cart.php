<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body >
    <!-- header -->
    <?php include "header.php"; ?>
    <!-- header -->

    <div class="container">
        <div class="row">

            <!-- order list -->
            <div class="col-12 col-lg-8 mb-5 mt-5">
                <div class="row">

                    <h4 class="text-uppercase text-center fw-bold p-3 mb-5">welcome to cart</h4>

                    <?php

                    include "connection.php";

                    $total = 0;
                    $shipping = 5000;

                    if (isset($_SESSION['u'])) {

                        $user_email = $_SESSION['u']['email'];

                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '" . $user_email . "' ");
                        $cart_nm = $cart_rs->num_rows;

                        if ($cart_nm > 0) {

                            for ($i = 0; $i < $cart_nm; $i++) {
                                $cart_dt = $cart_rs->fetch_assoc();
                    ?>

                                <div class="col-12 mt-4 mb-3 card">
                                    <div class="row">

                                        <?php

                                        $product        = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cart_dt['product_id'] . "' ");
                                        $product_data   = $product->fetch_assoc();

                                        $total = $total + ($product_data['price'] * $cart_dt['qty']);

                                        $brand = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $product_data['brand_id'] . "' ");
                                        $brand_name = $brand->fetch_assoc();

                                        $model = Database::search("SELECT * FROM `model` WHERE `id` = '" . $product_data['model_id'] . "' ");
                                        $model_name = $model->fetch_assoc();

                                        $color = Database::search("SELECT * FROM `color` WHERE `id` = '" . $cart_dt['color'] . "' ");
                                        $color_name = $color->fetch_assoc();

                                        $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $product_data['id'] . "' ");
                                        $image = $image_rs->fetch_assoc();

                                        ?>

                                        <div class="col-12 col-md-3">
                                            <img src="<?php echo $image['img'] ?>" alt="" style="height: 150px;">
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <h6 class="fw-bold card-header" id="item"><?php echo $brand_name['brand'] . ' ' . $model_name['model'] ?></h6>
                                            <p class="fw-bold fs-6 opacity-50">
                                                <?php echo $product_data['description'] ?>
                                            <h5 class="fw-bold opacity-50"><?php echo $color_name['color'] ?></h5>
                                            </p>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <h6 class="fw-bold">Rs <?php echo $product_data['price'] ?></h6>
                                            <h6 class="fw-bold opacity-50">Quantity : <?php echo $cart_dt['qty'] ?></h6>
                                            <a href=<?php echo "removeCart.php?id=" . $cart_dt['id']; ?> onclick="return confirm('Are yoi sure ?');" class="btn btn-outline-danger">Remove</a>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                        } else {
                            ?>

                            <div class="col-12" style="height: 300px;">
                                <div class="row">
                                    <div class="col-12 emptyCart"></div>
                                    <div class="col-12 text-center mb-2">
                                        <div class="co-12 d-flex justify-content-center">
                                            <div class="row align-items-center">
                                                <img src="resource/out-of-stock.png" alt="empty address picture" style="width: 230px; margin-bottom: 50px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                        <a href="index.php" class="btn btn-outline-info fs-3 fw-bold">Start Shopping</a>
                                    </div>
                                </div>
                            </div>

                    <?php
                        }
                    } else {
                        header('location: signIn.php');
                    }
                    ?>

                </div>
            </div>
            <!-- order list -->

            <!-- order summery -->
            <div class="col-12 col-lg-4 mt-lg-5 mb-3 p-3 card bg-dark-subtle rounded-3">
                <div class="row">

                    <h4 class="fw-bold p-3 card-header">Order Summery</h4>

                    <div class="col-6 mb-3">
                        <h5 class="fw-bold opacity-75 fw-bolder">Subtotal (Items <?php echo $cart_nm ?>)</h5>
                    </div>
                    <div class="col-6">
                        <h6 class="fw-bold5 float-end fw-bold">Price</h6>
                    </div>
                    <?php

                    if (isset($_SESSION['u'])) {

                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email` = '" . $_SESSION['u']['email'] . "' ");
                        $cart_nm = $cart_rs->num_rows;

                        if ($cart_nm > 0) {

                            for ($i = 0; $i < $cart_nm; $i++) {
                                $cart_dt = $cart_rs->fetch_assoc();
                                $product        = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cart_dt['product_id'] . "' ");
                                $product_data   = $product->fetch_assoc();

                                $brand = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $product_data['brand_id'] . "' ");
                                $brand_name = $brand->fetch_assoc();

                                $model = Database::search("SELECT * FROM `model` WHERE `id` = '" . $product_data['model_id'] . "' ");
                                $model_name = $model->fetch_assoc();

                    ?>

                                <div class="col-6">
                                    <h6 class="fw-bold opacity-75"><?php echo $brand_name['brand'] . ' ' . $model_name['model'] ?></h6>
                                </div>
                                <div class="col-6">
                                    <?php
                                        $price = $product_data['price'] * $cart_dt['qty'];
                                    ?>
                                    <h6 class="fw-bold5 float-end">Rs <?php echo($price) ?></h6>
                                </div>
                    <?php

                            }
                        }
                    }

                    ?>
                    <div class="col-6">
                        <h6 class="fw-bold opacity-75">Shipping</h6>
                    </div>
                    <div class="col-6">
                        <h6 class="fw-bold5 float-end">Rs <?php echo $shipping . '' ?></h6>
                    </div>
                    <div class="col-6 mt-4">
                        <h6 class="fw-bold opacity-75">Total</h6>
                    </div>
                    <div class="col-6 mt-4">
                        <h6 class="fw-bold5 float-end">Rs <span id="price"><?php echo $total ?></span> + 5000.00</h6>
                    </div>
                    <a cla class="link-light opacity-75 col-5 float-end" style="cursor: pointer;" onclick="promoShow();">Promo Code</a>
                    <div clbuttonss="col-12 mt-1">
                        <div class="card card-body d-none" id="pro-box">
                            <div>
                                <input type="text" id="c_code">
                                <button class="btn" id="cBtn" onclick="coupon();">Apply</button> <br>
                                        <label class="fs-6 d-none" id="dis_value"></label>
                                        <label class="fs-6 d-none" id="dis_id"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3 mb-4">
                        <button class="btn btn-outline-info w-100" id="payhere-payment" onclick="cartCheckOut();">Proceed to checkout</button>
                    </div>

                </div>
            </div>
            <!-- order summery -->

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="msg-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Messege</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="msg-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>