<?php
$pId = ($_GET['pId']);

session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../signIn.php');
}

?>

<?php
include '../connection.php'; ?>

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
    <?php include 'adminNavbar.php'; ?>
    <!-- admin header -->

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-9 offset-lg-3">
                <h1 class="mb-5">Update Product</h1>

                <div class="row d-flex justify-content-around">
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Product Id</label>
                        <input type="text" class="form-control" id="prod-id" value="<?php echo ($pId); ?>">
                    </div>
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Quantity</label>
                        <?php
                        $product        = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pId . "' ");
                        $prod_n = $product->num_rows;

                        $qty;
                        $price;
                        $description;
                        $cat_id;
                        $brn_id;
                        $mod_id;
                        $clr_id;

                        if ($prod_n > 0) {
                            $product_data = $product->fetch_assoc();
                            $qty = $product_data['qty'];
                            $price = $product_data['price'];
                            $description = $product_data['description'];
                            $cat_id = $product_data['catagary_id'];
                            $brn_id = $product_data['brand_id'];
                            $mod_id = $product_data['model_id'];
                            $clr_id = $product_data['color_id'];
                        }
                        ?>
                        <input type="text" class="form-control" id="prod-qty" value="<?php echo ($qty); ?>">
                    </div>
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" id="price" value="<?php echo ($price); ?>">
                    </div>
                </div>
                <div class="row d-flex justify-content-around mt-4">
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Description</label>
                        <textarea id="dis" class="form-control"><?php echo ($description); ?></textarea>
                    </div>
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Catagary</label>
                        <select id="cat" class="form-control">
                            <?php
                            $catagary = Database::search(
                                "SELECT * FROM `catagary` WHERE `id` = '" . $cat_id . "' "
                            );
                            $cat_n = $catagary->num_rows;
                            for ($i = 0; $i < $cat_n; $i++) {
                                $cat_data = $catagary->fetch_assoc(); ?>
                                <option value="<?php echo $cat_data['id']; ?>">
                                    <?php echo $cat_data['catagary']; ?>
                                </option>
                            <?php
                            }
                            ?>
                            <?php
                            $catagary = Database::search(
                                "SELECT * FROM `catagary`"
                            );
                            $cat_n = $catagary->num_rows;
                            for ($i = 0; $i < $cat_n; $i++) {
                                $cat_data = $catagary->fetch_assoc(); ?>
                                <option value="<?php echo $cat_data['id']; ?>">
                                    <?php echo $cat_data['catagary']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Brand</label>
                        <select id="brn" class="form-control">
                            <?php
                            $brand = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $brn_id . "' ");
                            $brand_n = $brand->num_rows;
                            for ($i = 0; $i < $brand_n; $i++) {
                                $brand_data = $brand->fetch_assoc(); ?>
                                <option value="<?php echo $brand_data['id']; ?>">
                                    <?php echo $brand_data['brand']; ?>
                                </option>
                            <?php
                            }
                            ?>
                            <?php
                            $brand = Database::search('SELECT * FROM `brand` ');
                            $brand_n = $brand->num_rows;
                            for ($i = 0; $i < $brand_n; $i++) {
                                $brand_data = $brand->fetch_assoc(); ?>
                                <option value="<?php echo $brand_data['id']; ?>">
                                    <?php echo $brand_data['brand']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row d-flex justify-content-around mt-4">
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Model</label>
                        <select id="mod" class="form-control">
                            <?php
                            $model = Database::search("SELECT * FROM `model` WHERE `id` = '" . $mod_id . "' ");
                            $model_n = $model->num_rows;
                            for ($i = 0; $i < $model_n; $i++) {
                                $model_data = $model->fetch_assoc(); ?>
                                <option value="<?php echo $model_data['id']; ?>">
                                    <?php echo $model_data['model']; ?>
                                </option>
                            <?php
                            }
                            ?>
                            <?php
                            $model = Database::search("SELECT * FROM `model` ");
                            $model_n = $model->num_rows;
                            for ($i = 0; $i < $model_n; $i++) {
                                $model_data = $model->fetch_assoc(); ?>
                                <option value="<?php echo $model_data['id']; ?>">
                                    <?php echo $model_data['model']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Colours</label>
                        <select id="pClr" class="form-select">
                            <?php
                            $colors = Database::search("SELECT * FROM `color` WHERE `id` = '". $clr_id ."' ");
                            $clr_n  = $colors->num_rows;
                            for ($i = 0; $i < $clr_n; $i++) {
                                $clr_dt = $colors->fetch_assoc();
                            ?>
                                <option value="<?php echo ($clr_dt['id']); ?>"><?php echo ($clr_dt['color']); ?></option>

                            <?php
                            }
                            ?>
                            <?php
                            $colors = Database::search("SELECT * FROM `color` ");
                            $clr_n  = $colors->num_rows;
                            for ($i = 0; $i < $clr_n; $i++) {
                                $clr_dt = $colors->fetch_assoc();
                            ?>
                                <option value="<?php echo ($clr_dt['id']); ?>"><?php echo ($clr_dt['color']); ?></option>

                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mt-5 mb-5 col-12 col-lg-3 float-end">
                    <button class="btn btn-info w-100" onclick="updateProduct();">Update</button>
                </div>
            </div>

            <div class="col-12 col-lg-9 offset-lg-3" style="margin-top: 20px;">
                <p class="text-center opacity-75" style="font-size: 18px;">&copy; 2024 Neo Mobile Kandy (Pvt), Ltd || All right recieved</p>
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