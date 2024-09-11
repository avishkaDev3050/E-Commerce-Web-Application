<?php

session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../signIn.php');
}

?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="../bootstrap.css">
</head>

<body>


    <!-- admin header -->
    <?php include "adminNavbar.php"; ?>
    <!-- admin header -->

    <div class="container">
        <div class="row">

            <div class="col-12 col-lg-10 offset-lg-3">
                <h1 class="mb-5">Out Of Stock</h1>

                <div class="mt-3 col-12">

                    <table class="table table-hover table-dark">
                        <thead>
                            <tr class="text-center border-bottom border-light fs-4">
                                <th scope="col">Product Id</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../connection.php";
                            $product        = Database::search("SELECT * FROM `product` WHERE `qty` = 0 ");
                            $prod_n = $product->num_rows;
                            for ($i = 0; $i < $prod_n; $i++) {
                                $product_data   = $product->fetch_assoc();

                                $brand = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $product_data['brand_id'] . "' ");
                                $brand_name = $brand->fetch_assoc();

                                $model = Database::search("SELECT * FROM `model` WHERE `id` = '" . $product_data['model_id'] . "' ");
                                $model_name = $model->fetch_assoc();

                            ?>
                                <tr class=" text-center fs-5 p-3">
                                    <td><?php echo ($product_data['id']); ?></td>
                                    <td><?php echo $brand_name['brand'] . ' ' . $model_name['model'] ?></td>
                                    <td><?php echo ($product_data['price']); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                    $products = Database::search("SELECT * FROM `product` WHERE `qty` = 0 ");
                    $prod_num = $products->num_rows;
                    ?>
                    <p class="mt-5 fs-3 d-flex justify-content-end">
                        Product Count : <?php echo ($prod_num); ?>
                    </p>
                    <div style="margin-top: 80px;">
                        <button class="btn btn-info float-end mb-5 d-none d-lg-block" onclick="outOfStockReport();">Print</button>
                    </div>

                    <div style="margin-top: 320px;">
                        <p class="text-center opacity-75" style="font-size: 18px;">&copy; 2024 Neo Mobile Kandy (Pvt), Ltd || All right recieved</p>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="../script.js"></script>
    <script src="../bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
    <!-- Custom JS -->
    <script src="js/scripts.js"></script>
</body>
</html>