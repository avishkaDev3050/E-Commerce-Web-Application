<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../signIn.php');
}

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../bootstrap.css">
</head>

<body>

    <!-- heaader -->
    <?php include "adminNavbar.php"; ?>
    <!-- heaader -->

    <div class="container">
        <div class="row">

            <div class="col-12 col-lg-10 offset-lg-3">
                <h1 class="mb-5">Order Statuss</h1>
            </div>

            <?php

            include "../connection.php";

            $items = Database::search("SELECT * FROM `order` WHERE `order_status_id` = '2' ");
            $item_num = $items->num_rows;
            if ($item_num > 0) {
                for ($i = 0; $i < $item_num; $i++) {
                    $item_data = $items->fetch_assoc()

            ?>
                    <div class="col-12 col-lg-9 offset-lg-3 mt-2 mb-5">
                        <div class="mt-5">
                            <label>Order date : <?php echo ($item_data['date']); ?></label>
                        </div>
                        <div class="cart bg-dark-subtle  mt-2 rounded-4 d-flex gap-3 p-3">
                            <div>
                                <?php

                                $p_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $item_data['product_id'] . "' ");
                                $p_img    = $p_img_rs->fetch_assoc();

                                ?>
                                <img src="<?php echo '../' . $p_img['img']; ?>" alt="product image" style="width: 130px; margin-top: 10px;">
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
                                <label>To : <?php echo ($item_data['user_email']) ?> </label>
                                <label>Item : <?php echo $brand['brand'] . ' ' . $model['model'] ?></label>
                                <label>Quantity : <?php echo ($item_data['qty']); ?></label>
                                <label>Price : Rs <?php echo ($item_data['price']); ?></label>
                            </div>
                        </div>
                        <div class="card-footer p-3">
                            <a href="orderStatusProccess.php?oId=<?php echo ($item_data['id']); ?> &email=<?php echo ($item_data['user_email']); ?>" class="btn btn-info float-end ms-2">Done</a>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="col-12 col-lg-10 offset-lg-3 d-lg-flex justify-content-center">
                    <div class="row mt-5">
                        <img src="../resource/out-of-stock.png" alt="empty address picture" style="width: 300px; margin-top: 50px; margin-bottom: 100px;">
                    </div>
                </div>
            <?php
            }
            ?>

            <div class="col-12 col-lg-10 offset-lg-3" style="margin-top: 150px;">
                <p class="text-center opacity-75" style="font-size: 18px;">&copy; 2024 Neo Mobile Kandy (Pvt), Ltd || All right recieved</p>
            </div>

        </div>
    </div>

    <!-- footer -->
    <!-- <?php include "footer.php"; ?> -->
    <!-- footer -->


    <script src="../script.js"></script>
    <script src="../bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
</body>

</html>