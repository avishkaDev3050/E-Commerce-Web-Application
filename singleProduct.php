<?php

include "connection.php";
$pId = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body class="overflow-x-hidden p-0 m-0">

    <!-- header -->
    <?php include "header.php"; ?>
    <!-- header -->

    <div class="container-fluid">
        <div class="row">

            <!-- product image -->
            <div class="col-12 col-lg-6 d-flex justify-content-center">
                <div class="row align-items-center">

                    <?php
                    if (isset($_GET['id'])) {
                        $pId = $_GET['id'];

                        $p_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $pId . "' ");
                        $p_img    = $p_img_rs->fetch_assoc();
                    ?>

                        <img id="Mainimg" src="<?php echo $p_img['img']; ?>" alt="product image">
                        <div class="d-flex justify-content-around mb-5">
                            <?php
                            $images = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $pId . "' ");
                            $img_num = $images->num_rows;
                            for ($i = 0; $i < $img_num; $i++) {
                                $img_data = $images->fetch_assoc();
                            ?>
                                <div class="p-1 bg-dark-subtle">
                                    <img style="width: 100px; height: 100px;" class="small-img" src="<?php echo $img_data['img']; ?>" alt="product image">
                                </div>
                            <?php
                            }
                            ?>
                        </div>

                    <?php
                    }
                    ?>

                </div>
            </div>
            <!-- product image -->

            <!-- product details -->
            <div class="col-12 col-lg-6 p-5 mb-5 mt-5 card bg-dark-subtle rounded-4">
                <div class="row">

                    <?php
                    $product_details = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pId . "' ");
                    $data = $product_details->fetch_assoc();

                    $brands = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $data['brand_id'] . "'");
                    $brand  = $brands->fetch_assoc();

                    $models = Database::search("SELECT * FROM `model` WHERE `id` = '" . $data['model_id'] . "' ");
                    $model = $models->fetch_assoc();
                    ?>

                    <p style="font-size: 20px"><a href="index.php" class="text-decoration-none link-light fw-bold opacity-50">Home / </a><?php echo $model['model'] ?></p>
                    <h1 style="font-size: 45px" class="fw-bold card-header" id="item"><?php echo $brand['brand'] . ' ' . $model['model'] ?></h1>
                    <h2 style="font-size: 40px" class="fw-bold opacity-75 mt-3">RS <span id="price"><?php echo $data['price'] ?></span></h2>
                    <labe class="mt-3" style="font-size: 28px">Quantity</label>
                        <input type="number" class="fs-5 p-2" style="width: 10%" value="1" id="qty">
                        <h5>Avilable <span id="avbqty"><?php echo $data['qty'] ?></span></h5>
                        <labe class="mt-5" style="font-size: 28px">Product color</label>
                            <?php
                            $color_id_rs = Database::search("SELECT * FROM `color` WHERE `id` = '" . $data['color_id'] . "' ");
                            $color_num = $color_id_rs->num_rows;
                            if ($color_num > 0) {
                                $color_data = $color_id_rs->fetch_assoc();
                            ?>
                                <input type="text" value="<?php echo ($color_data['id']) ?>" id="color" class="form-control d-none">
                                <label class="form-control"><?php echo ($color_data['color']) ?></label>
                            <?php

                            }
                            ?>
                            <p class="d-inline-flex gap-1 mt-3">
                                <a class="btn" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Promo code
                                </a>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <div>
                                        <input type="text" id="c_code">
                                        <button class="btn" onclick="coupon();" id="cBtn">Apply</button> <br>
                                        <label class="fs-6 d-none" id="dis_value"></label>
                                        <label class="fs-6 d-none" id="dis_id"></label>
                                    </div>
                                </div>
                            </div>
                            <h3 class="fw-bold mt-3">Description</h3>
                            <p class="fw-bold opacity-50 fs-5">
                                <?php echo $data['description']; ?>
                            </p>
                            <div class="mt-2">
                                <h6 class="opacity-75">Shipping cost Rs 5000 Island wide.</h6>
                            </div>

                            <div class="col-12 d-flex gap-1 mt-5">
                                <button class="w-50 btn p-1 text-white fw-bold fs-5 btn-outline-info" onclick="buyNow(<?php echo $pId ?>);">Buy Now</button>
                                <button class="w-50 btn p-1 text-white fw-bold fs-5 btn-outline-info" onclick="addToCart(<?php echo $pId; ?>);">Add To Cart</button>
                            </div>

                            <button class="w-100 mt-2 btn p-1 fw-bold fs-5 btn-outline-info" onclick="addToWishList(<?php echo $pId ?>);"><img style="width: 20px; margin-right: 10px" src="resource/heart.png" alt="wish list icon">Add To Wish List</button>

                </div>
            </div>
            <!-- product details -->

            <!-- feedback -->
            <div class="col-10 offset-1 p-3 rounded-3 border border-1 border-white mb-5 gap-3 d-flex">
                <input type="text" class="form-control" placeholder="Feed back" id="fb">
                <button class="btn rounded-5 bg-danger-subtle" onclick="addFeedBack(<?php echo ($pId); ?>);">
                    <img src="resource/sned.png" alt="send icon">
                </button>
            </div>

            <?php

            $feedbacks = Database::search("SELECT * FROM `feedback` WHERE `product_id` = '" . $pId . "' ");
            $fb_num    = $feedbacks->num_rows;
            for ($i = 0; $i < $fb_num; $i++) {
                $fb_data = $feedbacks->fetch_assoc();

                $fb_users = Database::search("SELECT * FROM `user` WHERE `email` = '" . $fb_data['user_email'] . "'");

                $user_name = $fb_users->fetch_assoc();

            ?>

                <div class="col-10 offset-1 col-md-6 offset-md-3 p-3 rounded-3 mb-5 gap-3 d-flex">

                    <div>
                        <img src="<?php echo ($user_name['profile_pic']); ?>" alt="profile" class="rounded-5" style="width: 40px;">
                    </div>

                    <div class="col-12 bg-dark-subtle bg-gradient p-4 rounded-3">
                        <h5><?php echo ($user_name['fname'] . ' ' . $user_name['lname']); ?></h5>
                        <p class="">
                            <?php echo ($fb_data['feedback']); ?>
                        </p>
                    </div>

                </div>
            <?php
            }
            ?>

            <!-- feedback -->


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
            <script>
                var Mainimg = document.getElementById('Mainimg');
                var smallimg = document.getElementsByClassName('small-img');


                smallimg[0].onclick = function() {
                    Mainimg.src = smallimg[0].src;
                }
                smallimg[1].onclick = function() {
                    Mainimg.src = smallimg[1].src;
                }
                smallimg[2].onclick = function() {
                    Mainimg.src = smallimg[2].src;
                }
                smallimg[3].onclick = function() {
                    Mainimg.src = smallimg[3].src;
                }
            </script>
</body>

</html>