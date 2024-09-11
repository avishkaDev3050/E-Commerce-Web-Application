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

    <link rel="stylesheet" href="../bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

    <div class="container">
        <div class="row">

            <div class="col-12">
                <h1 class="text-lg-center mt-5">Neo Mobiles Kandy (Pvt), Ltd</h1>
                <p class="text-center">No 04 Raja Weediya, Kandy</p>
                <p class="text-center">Available Products</p>
                <p class="text-center mb-5">
                    <?php
                    $d = new DateTime();
                    echo $d->format('Y-M-d');
                    ?>
                </p>

                <div class="mt-3">

                    <table class="table border border-1 border-black">
                        <thead>
                            <tr class="border-black border-light fs-4 text-center">
                                <th scope="col">Product Id</th>
                                <th scope="col">Catagary</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../connection.php';
                            $product = Database::search(
                                'SELECT * FROM `product` WHERE `qty` > 0 '
                            );
                            $prod_n = $product->num_rows;
                            for ($i = 0; $i < $prod_n; $i++) {

                                $product_data = $product->fetch_assoc();

                                $catagary = Database::search(
                                    "SELECT * FROM `catagary` WHERE `id` = '" .
                                        $product_data['catagary_id'] .
                                        "' "
                                );
                                $cat_data = $catagary->fetch_assoc();

                                $brand = Database::search(
                                    "SELECT * FROM `brand` WHERE `id` = '" .
                                        $product_data['brand_id'] .
                                        "' "
                                );
                                $brand_name = $brand->fetch_assoc();

                                $model = Database::search(
                                    "SELECT * FROM `model` WHERE `id` = '" .
                                        $product_data['model_id'] .
                                        "' "
                                );
                                $model_name = $model->fetch_assoc();
                                ?>
                                <tr class="fs-5 p-3 text-center">
                                    <td><?php echo $product_data['id']; ?></td>
                                    <td><?php echo $cat_data[
                                        'catagary'
                                    ]; ?></td>
                                    <td><?php echo $brand_name['brand'] .
                                        ' ' .
                                        $model_name['model']; ?></td>
                                    <td><?php echo $product_data['qty']; ?></td>
                                    <td><?php echo $product_data[
                                        'price'
                                    ]; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    
                    <?php
                    $products = Database::search('SELECT * FROM `product` WHERE `qty` > 0 ');
                    $prod_num = $products->num_rows;
                    ?>
                        <p class="mt-5 fs-3 d-flex justify-content-end">
                           Available Product Count :  <?php echo $prod_num; ?>
                        </p>


                    <div class="col-12" style="margin-top: 100px;">
                        <p class="text-center opacity-75" style="font-size: 18px;">&copy; 2024 Neo Mobile Kandy (Pvt), Ltd || All right recieved</p>
                    </div>


                </div>
            </div>

        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>