<?php
session_start();
include "../connection.php";
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

  <div class="col-12 col-lg-9">
    <div class="row">
      <div class="offset-1 offset-md-0 offset-lg-4  ">
        <h3 class="ms-lg-5">Welc]ome To Dashboard</h3>

        <div class="d-md-flex justify-content-between">
          <div class="col-9 col-md-3 p-3 mt-5 m-lg-5 box">
            <h4>Monthly Incomets</h4>
            <?php
            $total_amount = 0;
            $orders = Database::search("SELECT * FROM `order` WHERE `order_status_id` != '4' ");
            $order_num = $orders->num_rows;
            for ($i = 0; $i < $order_num; $i++) {
              $order_data = $orders->fetch_assoc();
              $month = $order_data['date'];
              $dateTime = new DateTime($month);
              $m = $dateTime->format('m');
              $current_date = new DateTime();
              $current_m = $current_date->format('m');
              if ($m == $current_m) {
                $price = $order_data['price'];
                $total_amount += $price;
              }
            }
            ?>
            <p class="box-count">
              Rs <?php echo ($total_amount); ?>
            </p>
          </div>
          <div class="col-9 col-md-3 p-3 mt-5 m-lg-5 box">
            <h4>Daily Incomets</h4>
            <?php
            $total_amount = 0;
            $orders = Database::search("SELECT * FROM `order` WHERE `order_status_id` != '4' ");
            $order_num = $orders->num_rows;
            for ($i = 0; $i < $order_num; $i++) {
              $order_data = $orders->fetch_assoc();
              $month = $order_data['date'];
              $dateTime = new DateTime($month);
              $m = $dateTime->format('d');
              $current_date = new DateTime();
              $current_m = $current_date->format('d');
              if ($m == $current_m) {
                $price = $order_data['price'];
                $total_amount += $price;
              }
            }
            ?>
            <p class="box-count">
              Rs <?php echo ($total_amount); ?>
            </p>
          </div>
          <div class="col-9 col-md-3 p-3 mt-5 m-lg-5 box">
            <h4>Available Productss</h4>
            <?php
            $products = Database::search("SELECT * FROM `product` ");
            $prod_num = $products->num_rows;
            ?>
            <p class="box-count">
              <?php echo ($prod_num); ?>
            </p>
          </div>
        </div>

        <div class="d-md-flex justify-content-between">
          <div class="col-12 col-md-3 p-3 mt-5 m-lg-5 box">
            <H4>Proccessing Orders</H4>
            <?php
            $product = Database::search("SELECT * FROM `order` WHERE `order_status_id` = '2' ");
            $product_num = $product->num_rows;
            ?>
            <p class="box-count">
              <?php echo ($product_num); ?>
            </p>
            </p>
          </div>
          <div class="col-9 col-md-3 p-3 mt-5 m-lg-5 box">
            <h4>Canceled Orders</h4>
            <?php
            $product = Database::search("SELECT * FROM `order` WHERE `order_status_id` = '4' ");
            $product_num = $product->num_rows;
            ?>
            <p class="box-count">
              <?php echo ($product_num); ?>
            </p>
          </div>
          <div class="col-9 col-md-3 p-3 mt-5 m-lg-5 box">
            <H4>Pending Orders</H4>
            <?php
            $orders = Database::search("SELECT * FROM `order` WHERE `order_status_id` = '1' ");
            $order_num = $orders->num_rows;
            ?>
            <p class="box-count">
              <?php echo ($order_num); ?>
            </p>
          </div>
        </div>
        <div class="d-md-flex justify-content-between">
          <div class="col-12 col-md-3 p-3 alert mt-5 m-lg-5 box">
            <H4>Active Usersss</H4>
            <?php
            $user = Database::search("SELECT * FROM `user` WHERE `status` = '1' ");
            $user_num = $user->num_rows;
            ?>
            <p class="box-count">
              <?php echo ($user_num); ?>
            </p>
          </div>
        </div>

        <div class="col-12" style="margin-top: 100px;">
          <p class="text-center opacity-75" style="font-size: 18px;">&copy; 2024 Neo Mobile Kandy (Pvt), Ltd || All right recieved</p>
        </div>
        
      </div>

    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.35.3/apexcharts.min.js"></script>
  <!-- Custom JS -->
  <script src="js/scripts.js"></script>
</body>

</html>