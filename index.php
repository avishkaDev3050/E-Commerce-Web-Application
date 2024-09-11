<?php

include "connection.php";

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Neo Mobile</title>

  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body >

  <!-- navbar -->
  <?php include "header.php"; ?>
  <!-- navbar -->

  <!-- contect -->
  <div class="container">
    <div class="row">


      <!-- header -->
      <div class="container">

        <!-- header body  -->
        <div class="row mt-3 mb">
          <!-- logo -->
          <div class="col-12 col-lg-2 d-flex justify-content-center">
            <img class="header-img" src="resource/logo.webp" alt="logo">
          </div>
          <!-- logo -->

          <!-- search -->
          <div class="col-12 col-lg-10 mt-4 offset-1 offset-lg-0">
            <div class="mb-2">
              <select id="brand" class="w-50 p-2" data-bs-theme="dark">
                <option value="0">Select a brand</option>
                <?php
                $brand = Database::search("SELECT * FROM `brand` ");
                $num_brand = $brand->num_rows;
                for ($i = 0; $i < $num_brand; $i++) {
                  $brand_data = $brand->fetch_assoc();
                ?>
                  <option value="<?php echo ($brand_data['id']); ?>">
                    <?php echo ($brand_data['brand']); ?>
                  </option>
                <?php
                }
                ?>
              </select>
              <input type="submit" value="Search" class="search-btn float-end" onclick="search();">
            </div>
            <input type="submit" value="Advanced Search" class="ad-search-btn d-block w-100" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
          </div>
          <!-- search -->
        </div>
        <!-- header body  -->
      </div>


      <!-- carousal -->
      <div class="col-12 mt-4">
        <div class="row">
          <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="resource/Ads/a1.jpg" class="img-thumbnail w-100" style="height: 350px;" alt="advertiesment" />
              </div>
              <div class="carousel-item">
                <img src="resource/Ads/a1.jpg" class="img-thumbnail w-100" style="height: 350px;" alt="advertiesment" />
              </div>
              <div class="carousel-item">
                <img src="resource/Ads/a2.jpg" class="img-thumbnail w-100" style="height: 350px;" alt="advertiesment" />
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
      <!-- carousal -->
    </div>
  </div>
  <!-- contect -->

  <!-- content -->
  <div class="container mb-5 mt-5">
    <div class="row">
      <?php

      $products = Database::search("SELECT * FROM `product` ");
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

        $color_id_rs = Database::search("SELECT * FROM `color` WHERE `id` = '" . $product['color_id'] . "' ");
        $color_data = $color_id_rs->fetch_assoc();

        if ($product['qty'] > 0) {

      ?>

          <div class="col-12 col-md-3 col-lg-3 p-4 card bg-dark-subtle">
            <div class="d-flex justify-content-center p-3">
              <img src="<?php echo $img['img']; ?>" style="height: 250px;" alt="" />
            </div>
            <h6 class="text-center fw-bold mt-3">Rs <?php echo $product['price'] ?></h6>
            <h6 class="text-center fw-bold"><?php echo $color_data['color'] ?></h6>
            <h6 class="text-center fw-bold mb-3"><?php echo $modal['model']; ?></h6>
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

  <!-- advance search -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Advanced Search</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Catagary</label>
              <select id="cat" class="form-select">
                <option value="0">Select a Catagary</option>
                <?php
                $catagary = Database::search("SELECT * FROM `catagary` ");
                $cat_num = $catagary->num_rows;
                for ($i = 0; $i < $cat_num; $i++) {
                  $cat_data = $catagary->fetch_assoc();
                ?>

                  <option value="<?php echo ($cat_data['id']); ?>">
                    <?php echo ($cat_data['catagary']); ?>
                  </option>

                <?php
                }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Brand</label>
              <select id="bran" class="form-select">
                <option value="0">Select a brand</option>
                <?php
                $brand = Database::search("SELECT * FROM `brand` ");
                $brand_num = $brand->num_rows;
                for ($i = 0; $i < $brand_num; $i++) {
                  $brand_data = $brand->fetch_assoc();
                ?>

                  <option value="<?php echo ($brand_data['id']); ?>">
                    <?php echo ($brand_data['brand']); ?>
                  </option>

                <?php
                }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Modal</label>
              <select id="mod" class="form-select">
                <option value="0">Select a modal</option>
                <?php
                $model = Database::search("SELECT * FROM `model` ");
                $model_num = $model->num_rows;
                for ($i = 0; $i < $model_num; $i++) {
                  $model_data = $model->fetch_assoc();
                ?>

                  <option value="<?php echo ($model_data['id']); ?>">
                    <?php echo ($model_data['model']); ?>
                  </option>

                <?php
                }
                ?>
              </select>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-info" onclick="advancedSearch();">Search</button>
        </div>
      </div>
    </div>
  </div>
  <!-- advance search -->

  <!-- footer -->
  <?php include "footer.php"; ?>
  <!-- footer -->


  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>