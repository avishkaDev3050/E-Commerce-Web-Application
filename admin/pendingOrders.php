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
    <title>Pending Products</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="../bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

    <!-- admin header -->
    <?php include "adminNavbar.php"; ?>
    <!-- admin header -->

    <div class="container">
        <div class="row">

            <div class="col-12 col-lg-10 offset-lg-3">
                <h1 class="mb-5">Pending Orders.</h1>

                <div class="mt-5">

                    <table class="table table-hover mt-5">
                        <thead>
                            <tr class="text-center border-bottom border-light fs-4">
                                <th scope="col">Invoice Id</th>
                                <th scope="col">Product</th>
                                <th scope="col">User</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../connection.php";
                            $order        = Database::search("SELECT * FROM `order` WHERE `order_status_id` = '1' ");
                            $order_n = $order->num_rows;
                            for ($i = 0; $i < $order_n; $i++) {
                                $order_data   = $order->fetch_assoc();

                                $product        = Database::search("SELECT * FROM `product` WHERE `id` = '". $order_data['product_id'] ."' ");
                                $prod_n = $product->num_rows;

                                $users = Database::search("SELECT * FROM `user` WHERE `email` = '". $order_data['user_email'] ."' ");
                                $user_num = $users->num_rows;

                                $name;
                                $mobile;
                                if ($user_num > 0) {
                                    $user_data = $users->fetch_assoc();
                                    $name = $user_data['fname'] . ' ' . $user_data['lname'];
                                    $mobile = $user_data['mobile'];
                                }

                                if ($prod_n > 0) {
                                    $product_data   = $product->fetch_assoc();

                                    $brand = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $product_data['brand_id'] . "' ");
                                    $brand_name = $brand->fetch_assoc();

                                    $model = Database::search("SELECT * FROM `model` WHERE `id` = '" . $product_data['model_id'] . "' ");
                                    $model_name = $model->fetch_assoc();


                                }

                            ?>
                                <tr class="text-center fs-5 p-3">
                                    <td><?php echo ($order_data['invoice_id']); ?></td>
                                    <td><?php echo $brand_name['brand'] . ' ' . $model_name['model'] ?></td>
                                    <td><?php echo ($name); ?></td>
                                    <?php
                                        $id = $order_data['id'];
                                        $item = $brand_name['brand'] . ' ' . $model_name['model'];
                                        $invoice = $order_data['invoice_id'];
                                        $e = $order_data['user_email'];
                                    ?>
                                    <td><a href="shippingAddressReport.php?odrId=<?php echo $id;  ?>&item=<?php echo $item; ?>&invoice_id=<?php echo $invoice ?>&e=<?php echo $e; ?>" class="btn float-end ms-2">View</a></td>
                                    <td><a href="activeProccess.php?oId=<?php echo($order_data['id']); ?>" class="btn">Proccess Now</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                        $order = Database::search("SELECT * FROM `order` WHERE `order_status_id` = '1' ");
                        $order_num = $order->num_rows;
                    ?>
                        <p class="mt-5 fs-3 d-flex justify-content-end">
                           Pending order Count :  <?php echo($order_num); ?>
                        </p>

                    <div class="col-12" style="margin-top: 200px;">
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