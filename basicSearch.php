<?php

include "connection.php";

$s = $_GET['brand'];

if ($s == 0) { 
    echo("error");
} else {

    $brand = Database::search("SELECT * FROM `brand` WHERE `id` = '" . $s . "' ");
    $brand_num = $brand->num_rows;
    if ($brand_num > 0) {
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neo Mobile</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>

    <!-- header -->
    <?php include "header.php"; ?>
    <!-- header -->

    <div class="container">
        <div class="row">

            <!-- content -->
            <div class="container mb-5 mt-5">
                <div class="row">
                    <?php

                    $products = Database::search("SELECT * FROM `product` WHERE `brand_id` = '" . $s . "' ");
                    $product_num = $products->num_rows;
                    
                    for ($i = 0; $i < $product_num; $i++) {
                        $product = $products->fetch_assoc();
                        $pid = $product['id'];

                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $product['id'] . "' ");
                        $img    = $img_rs->fetch_assoc();
                        $emt_img = $img;

                        $modals  = Database::search("SELECT * FROM `model` WHERE `id` = '" . $product['model_id'] . "'  ");
                        $modal   = $modals->fetch_assoc();
                        $emt_model = $modal;

                        if ($product['qty'] > 0) {

                    ?>

                            <div class="col-12 col-md-3 col-lg-3 p-4 card bg-dark-subtle">
                                <div class="d-flex justify-content-center p-3">
                                    <img src="<?php echo $img['img']; ?>" style="height: 250px;" alt="" />
                                </div>
                                <h6 class="text-center fw-bold mt-3">Rs <?php echo $product['price'] ?></h6>
                                <h6 class="text-center fw-bold mt-3 mb-3"><?php echo $modal['model']; ?></h6>
                                <div class="d-flex justify-content-center card-footer">
                                    <button class="btn btn-outline-info" onclick="singleProduct(<?php echo $pid; ?>);">
                                        Learn More
                                    </button>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-12 col-md-3 col-lg-3 p-4 card bg-dark-subtle">
                                <div class="d-flex justify-content-center p-3">
                                    <img src="<?php echo $img['img']; ?>" style="height: 250px;" alt="" />
                                </div>
                                <h6 class="text-center fw-bold mt-3">Pending</h6>
                                <h6 class="text-center fw-bold mt-3 mb-3"><?php echo $modal['model']; ?></h6>
                                <div class="d-flex justify-content-center card-footer">
                                    <button class="btn btn-outline-danger disabled">
                                        Out of stock
                                    </button>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
        <!-- content -->

    </div>
    </div>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="script.js"></script>
</html>
</body>

<?php
    }
}
?>