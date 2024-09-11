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
                <h1 class="mb-5">Available Product List</h1>

                <div class="mt-5">
                    <form action="findProduct.php" method="get" class="d-flex gap-4">
                        <input type="search" class="form-control" placeholder="Search with invoice reference." id="search" name="id">
                        <button name="submit" class="btn btn-info" name="searchBtn" href="findInvoice.php">Search</button>
                    </form>
                </div>

                <div class="mt-3 col-12">

                    <table class="table table-hover table-dark">
                        <thead>
                            <tr class="text-center border-bottom border-light fs-4">
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
                            $product        = Database::search("SELECT * FROM `product` WHERE `qty` > 0 ");
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
                                    <td><?php echo ($product_data['qty']); ?></td>
                                    <td><?php echo ($product_data['price']); ?></td>
                                    <td><a href="updateProduct.php?pId=<?php echo ($product_data['id']); ?>" class="btn ">Update</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                    $products = Database::search("SELECT * FROM `product` WHERE `qty` > 0 ");
                    $prod_num = $products->num_rows;
                    ?>
                    <p class="mt-5 fs-3 d-flex justify-content-end">
                        Available Product Count : <?php echo ($prod_num); ?>
                    </p>
                    <div class="d-flex gap-3" style="margin-top: 80px;">
                        <button class="btn float-end mb-5 w-100 d-none d-lg-block" onclick="productListReport();">Print</button>
                        <button class="btn float-end mb-5 w-100" onclick="window.location = 'addProduct.php';">Register Product</button>
                        <button class="btn float-end mb-5 w-100" data-bs-toggle="modal" data-bs-target="#colorModal" data-bs-whatever="@mdo">New Colour</button>
                        <button class="btn float-end mb-5 w-100" data-bs-toggle="modal" data-bs-target="#catagaryModal" data-bs-whatever="@mdo">New Catagary</button>
                        <button class="btn float-end mb-5 w-100" data-bs-toggle="modal" data-bs-target="#modelModal" data-bs-whatever="@mdo">New Model</button>
                        <button class="btn float-end mb-5 w-100" data-bs-toggle="modal" data-bs-target="#brandModal" data-bs-whatever="@mdo">New Brand</button>
                    </div>

                    <div class="0px;">
                        <p class="text-center opacity-75" style="font-size: 18px;">&copy; 2024 Neo Mobile Kandy (Pvt), Ltd || All right recieved</p>
                    </div>

                </div>
            </div>


            <!-- Colour modal -->
            <div class="modal fade" id="colorModal" tabindex="-1" aria-labelledby="colorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New Colour</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Colour</label>
                            <input type="text" class="form-control" id="clr" placeholder="Enter a colour.">
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <?php
                                    $clrs = Database::search("SELECT * FROM `color` ");
                                    $clr_num = $clrs->num_rows;
                                    for ($i=0; $i < $clr_num; $i++) { 
                                        $clr_data = $clrs->fetch_assoc();
                                ?>
                                <div class="mt-3 col-4">
                                    <div class="p-3 bg-black rounded rounded-5">
                                        <label>
                                            <?php echo($clr_data['color']); ?>
                                        </label>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-info" onclick="saveColor();">Save</button>
                    </div>
                    </div> 
                </div>
            </div>
            <!-- Colour modal -->

            <!-- catagary modal -->
            <div class="modal fade" id="catagaryModal" tabindex="-1" aria-labelledby="colorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New Catagary</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Catagary</label>
                            <input type="text" class="form-control" id="newCat" placeholder="Enter a catagary.">
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <?php
                                    $cat = Database::search("SELECT * FROM `catagary` ");
                                    $cat_num = $cat->num_rows;
                                    for ($i=0; $i < $cat_num; $i++) { 
                                        $cat_data = $cat->fetch_assoc();
                                ?>
                                <div class="mt-3 col-4">
                                    <div class="p-3 bg-black rounded rounded-5">
                                        <label>
                                            <?php echo($cat_data['catagary']); ?>
                                        </label>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-info" onclick="saveNewCatagary();">Save</button>
                    </div>
                    </div> 
                </div>
            </div>
            <!-- catagary modal -->

            <!-- model modal -->
            <div class="modal fade" id="modelModal" tabindex="-1" aria-labelledby="colorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New Model</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Model</label>
                            <input type="text" class="form-control" id="newMod" placeholder="Enter a model.">
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <?php
                                    $mod = Database::search("SELECT * FROM `model` ");
                                    $mod_num = $mod->num_rows;
                                    for ($i=0; $i < $mod_num; $i++) { 
                                        $mod_data = $mod->fetch_assoc();
                                ?>
                                <div class="mt-3 col-4">
                                    <div class="p-3 bg-black rounded rounded-5">
                                        <label>
                                            <?php echo($mod_data['model']); ?>
                                        </label>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-info" onclick="saveModel();">Save</button>
                    </div>
                    </div> 
                </div>
            </div>
            <!-- model modal -->

            <!-- brand model -->
            <div class="modal fade" id="brandModal" tabindex="-1" aria-labelledby="colorModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New Brand</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Brand</label>
                            <input type="text" class="form-control" id="newBrn" placeholder="Enter a brand.">
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <?php
                                    $brn = Database::search("SELECT * FROM `brand` ");
                                    $brn_num = $brn->num_rows;
                                    for ($i=0; $i < $brn_num; $i++) { 
                                        $brn_data = $brn->fetch_assoc();
                                ?>
                                <div class="mt-3 col-4">
                                    <div class="p-3 bg-black rounded rounded-5">
                                        <label>
                                            <?php echo($brn_data['brand']); ?>
                                        </label>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-info" onclick="saveBrand();">Save</button>
                    </div>
                    </div> 
                </div>
            </div>
            <!-- brand model -->

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