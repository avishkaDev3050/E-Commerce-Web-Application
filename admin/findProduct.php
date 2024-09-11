<?php

$id = $_GET['id'];
if (empty($id)) {
    header('location: productList.php');
}
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
                <h1 class="mb-5">Product Details</h1>

                <button class="btn btn-danger float-end mb-5 mt-5" onclick="window.location = 'productList.php';">Back</button>

                <div class="col-12">

                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Product Id</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../connection.php";
                            $product        = Database::search("SELECT * FROM `product` WHERE `id` = '". $id ."'  ");
                            $prod_n = $product->num_rows;
                            for ($i = 0; $i < $prod_n; $i++) {
                                $product_data   = $product->fetch_assoc();

                                $brand = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $product_data['brand_id'] . "' ");
                                $brand_name = $brand->fetch_assoc();

                                $model = Database::search("SELECT * FROM `model` WHERE `id` = '" . $product_data['model_id'] . "' ");
                                $model_name = $model->fetch_assoc();

                            ?>
                                <tr class="text-center fw-bold">
                                    <td><?php echo ($product_data['id']); ?></td>
                                    <td><?php echo $brand_name['brand'] . ' ' . $model_name['model'] ?></td>
                                    <td><?php echo ($product_data['qty']); ?></td>
                                    <td><?php echo ($product_data['price']); ?></td>
                                    <td><a href="updateProduct.php?pId=<?php echo($product_data['id']); ?>" class="btn">Update</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

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


  <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
  <!-- Custom JS -->
  <script src="js/scripts.js"></script>
</body>

</html>