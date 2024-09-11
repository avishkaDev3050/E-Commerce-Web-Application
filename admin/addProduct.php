<?php
include '../connection.php'; 

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
    <title>Product Management</title>
    
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
    <?php include 'adminNavbar.php'; ?>
    <!-- admin header -->

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-3">
                <h1 class="mb-5">Register Product</h1>

                <div class="row d-flex justify-content-around">
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Product Id</label>
                        <input type="text" class="form-control" id="prod-id">
                    </div>
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Quantity</label>
                        <input type="text" class="form-control" id="prod-qty">
                    </div>
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" id="price">
                    </div>
                </div>
                <div class="row d-flex justify-content-around mt-4">
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Description</label>
                        <textarea id="dis" class="form-control"></textarea>
                    </div>
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Catagary</label>
                        <select id="cat" class="form-control">
                            <option value="0">Select a catagary</option>
                            <?php
                            $catagary = Database::search(
                                'SELECT * FROM `catagary` '
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
                            <option value="0">Select a brand</option>
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
                            <option value="0">Select a model</option>
                            <?php
                            $model = Database::search('SELECT * FROM `model` ');
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
                        <label class="form-label">Product Image</label>
                        <input type="file" multiple id="prod_img" class="form-select">
                    </div>
                    <div class="mt-4 col-12 col-lg-3">
                        <label class="form-label">Colours</label>
                        <select id="pClr" class="form-select">
                            <option value="0">Select a colour</option>
                            <?php
                                $colors = Database::search("SELECT * FROM `color`");
                                $clr_n  = $colors->num_rows;
                                for ($i = 0; $i < $clr_n; $i++) {
                                    $clr_dt = $colors->fetch_assoc();
                            ?>
                                    <option value="<?php echo($clr_dt['id']); ?>"><?php echo($clr_dt['color']); ?></option>

                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mt-5 mb-5 col-12 col-lg-3 float-end">
                    <button class="btn btn-info w-100" onclick="addProduct();">Register</button>
                </div>
            </div>

            <div class="col-12 col-lg-10 offset-lg-3" style="margin-top: 20px;">
                <p class="text-center opacity-75" style="font-size: 18px;">&copy; 2024 Neo Mobile Kandy (Pvt), Ltd || All right recieved</p>
            </div>

        </div>
    </div>

    
  <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
  <!-- Custom JS -->
  <script src="js/scripts.js"></script>
    <script src="../script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>