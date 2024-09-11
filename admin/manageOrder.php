<?php
    include "../connection.php";
    
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
    <title>Manage Order</title>
    
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
                <div class="row">

                    <h1 class="mb-5">Manage Ordera</h1>

                    <table class="table table-hover  mt-5">
                        <thead>
                            <tr class="text-center border-bottom border-light fs-4">
                                <th>Order Status</th>
                                <th>Orders Count</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center fs-5 p-3">
                                <td>Pending</td>
                                <?php
                                $p_order = Database::search("SELECT * FROM `order` WHERE `order_status_id` = '1' ");
                                $p_num = $p_order->num_rows;
                                ?>
                                <td><?php echo($p_num); ?></td>
                                <td><a class="link-light text-decoration-none" href="pendingOrders.php">View</a></td>
                            </tr>
                            <tr class="text-center fs-4 p-3">
                                <td>Proccessing</td>
                                <?php
                                $p_order = Database::search("SELECT * FROM `order` WHERE `order_status_id` = '2' ");
                                $p_num = $p_order->num_rows;
                                ?>
                                <td><?php echo($p_num); ?></td>
                                <td><a class="link-light text-decoration-none" href="orderStatus.php">View</a></td>
                            </tr>
                        </tbody>
                    </table>
                        
                    <?php
                        $order = Database::search("SELECT * FROM `order` WHERE `order_status_id` = '3' ");
                        $order_num = $order->num_rows;
                    ?>
                    <p class="mt-5 mb-5 fs-3 d-flex justify-content-end">
                       Delivered order Count :  <?php echo($order_num); ?>
                    </p>

                    <div class="col-12" style="margin-top: 170px;">
                        <p class="text-center opacity-75" style="font-size: 18px;">&copy; 2024 Neo Mobile Kandy (Pvt), Ltd || All right recieved</p>
                    </div>

                </div>
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