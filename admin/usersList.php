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
                <h1 class="mb-5">Available Users List</h1>

                <button class="btn btn-info float-end mb-5" onclick="usersListReport();;">Print</button>

                <div class="mt-3 col-12">

                    <table class="table table-hover table-dark">
                        <thead>
                            <tr class="text-center border-bottom border-light fs-4">
                                <th scope="col">User Email</th>
                                <th scope="col">First Namet</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../connection.php";
                            $users = Database::search("SELECT * FROM `user`");
                            $user_num = $users->num_rows;
                            for ($i=0; $i < $user_num; $i++) { 
                                $user_data = $users->fetch_assoc();

                            ?>
                                <tr class="text-center fs-5 p-3">
                                    <td><?php echo ($user_data['email']); ?></td>
                                    <td><?php echo ($user_data['fname']); ?></td>
                                    <td><?php echo ($user_data['lname']); ?></td>
                                    <td><?php echo ($user_data['mobile']); ?></td>
                                    <?php
                                        if ($user_data['status'] == 1) {
                                    ?>
                                            <td><a href="deactiveUser.php?em=<?php echo($user_data['email']); ?>" class="link-success btn">Active</a></td>
                                    <?php
                                        } else {
                                    ?>
                                            <td><a href="activeUser.php?em=<?php echo($user_data['email']); ?>" class="btn link-danger">Deactive</a></td>
                                    <?php
                                        }
                                    ?>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    
                    <?php
                        $users = Database::search("SELECT * FROM `user` WHERE `status` = '1' ");
                        $users_num = $users->num_rows;
                    ?>
                        <p class="mt-5 fs-3 d-flex justify-content-end">
                           Active users Count :  <?php echo($users_num); ?>
                        </p>

                    <?php
                        $users = Database::search("SELECT * FROM `user` WHERE `status` = '0' ");
                        $users_num = $users->num_rows;
                    ?>
                        <p class="mt-1 fs-3 d-flex justify-content-end">
                           Inactive users Count :  <?php echo($users_num); ?>
                        </p>


                    <div class="col-12" style="margin-top: 100px;">
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