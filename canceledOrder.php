<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Products</title>

    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

    <!-- admin header -->
    <?php include "adminNavbar.php"; ?>
    <!-- admin header -->

    <div class="container">
        <div class="row">

            <div class="col-12">
                <h1 class="text-lg-center mt-5">Canceled Orders.</h1>

                <div class="mt-5">

                    <table class="table table-success border border-1 border-black mt-5">
                        <thead>
                            <tr class="border border-3 border-black text-center">
                                <th>Order Id</th>
                                <th>Product</th>
                                <th>User</th>
                                <th>Mobile</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "connection.php";
                            $order        = Database::search("SELECT * FROM `order` WHERE `order_status_id` = '4' ");
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

                                $brand;
                                $model;
                                if ($prod_n > 0) {
                                    $product_data   = $product->fetch_assoc();

                                    $brand = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $product_data['brand_id'] . "' ");
                                    $brand_name = $brand->fetch_assoc();

                                    $model = Database::search("SELECT * FROM `model` WHERE `id` = '" . $product_data['model_id'] . "' ");
                                    $model_name = $model->fetch_assoc();
                                }

                            ?>
                                <tr class="border border-3 border-black text-center fw-bold">
                                    <td><?php echo ($order_data['id']); ?></td>
                                    <td><?php echo $brand_name['brand'] . ' ' . $model_name['model'] ?></td>
                                    <td><?php echo ($name); ?></td>
                                    <td><?php echo ($mobile); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                        $order = Database::search("SELECT * FROM `order` WHERE `order_status_id` = '4' ");
                        $order_num = $order->num_rows;
                        ?>
                        <p class="mt-5 fs-3 d-flex justify-content-end">
                           Canceled order Count :  <?php echo($order_num); ?>
                        </p>

                    <div class="col-12" style="margin-top: 100px;">
                        <p class="text-center opacity-75" style="font-size: 18px;">&copy; 2024 Neo Mobile Kandy (Pvt), Ltd || All right recieved</p>
                    </div>


                </div>
            </div>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>