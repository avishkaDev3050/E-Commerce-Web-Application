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
  <title>Promo Code List</title>
 
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
        <h1 class="mb-1">Available Promo Code List</h1>

        <button type="button" class="btn fs-5 float-end mb-5 mt-5" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add new promo</button>

        <div class="mt-3 col-12">

          <table class="table table table-hover table-dark">
            <thead>
              <tr class="text-center border-bottom border-light fs-4">
                <th scope="col">Id</th>
                <th scope="col">Promo Code</th>
                <th scope="col">Discount</th>
                <th scope="col">Expire Date</th>
                <th scope="col">#</th>
                <th scope="col">#</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "../connection.php";
              $promo = Database::search("SELECT * FROM `promo_code`");
              $promo_num = $promo->num_rows;
              for ($i = 0; $i < $promo_num; $i++) {
                $promo_data = $promo->fetch_assoc();

              ?>
                <tr class="text-center fs-5 p-3">
                  <td><?php echo ($promo_data['id']); ?></td>
                  <td><?php echo ($promo_data['promo_code']); ?></td>
                  <td><?php echo ($promo_data['discount']); ?></td>
                  <td><?php echo ($promo_data['exp_date']); ?></td>
                  <td><a href="removePromo.php?id=<?php echo ($promo_data['id']); ?>" class="btn link-danger">Remove</a></td>
                  <td><a onclick="sendPromo(<?php echo ($promo_data['id']); ?>);" class="btn link-info">Send</a></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>

          <?php
          $promo = Database::search("SELECT * FROM `promo_code` ");
          $promo_num = $promo->num_rows;
          ?>
          <p class="mt-5 fs-3 d-flex justify-content-end">
            Total Promo Count : <?php echo ($promo_num); ?>
          </p>


          <div class="col-12" style="margin-top: 170px;">
            <p class="text-center opacity-75" style="font-size: 18px;">&copy; 2024 Neo Mobile Kandy (Pvt), Ltd || All right recieved</p>
          </div>

        </div>
      </div>

    </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">New Promo Code</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Promo Code</label>
              <input type="text" class="form-control" id="promo" placeholder="Add new promo code.">
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Discount (%)</label>
              <input type="text" class="form-control" id="dis" placeholder="Add new discount.">
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Expire Date</label>
              <input type="date" class="form-control" id="exp" placeholder="Add expire date.">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-info" onclick="promoCode();">Save</button>
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