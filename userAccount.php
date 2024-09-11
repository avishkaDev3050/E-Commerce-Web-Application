<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body >

    <!-- header -->
    <?php include "header.php"; ?>
    <!-- header -->

    <div class="container">
        <div class="row gap-5 offset-md-2" style="margin-top: 100px; margin-bottom: 100px;">

            <div class="col-12 col-md-3 pro-box card-box" onclick="window.location = 'profile.php';">

                <?php
                include "connection.php";

                if (isset($_SESSION['u'])) {
                    $data = $_SESSION['u'];

                    $pro_pic = Database::search("SELECT * FROM `user` WHERE `email` = '" . $data['email'] . "' ");
                    $num = $pro_pic->num_rows;
                    if ($num > 0) {
                        $user = $pro_pic->fetch_assoc();
                ?>
                        <img src="<?php echo ($user['profile_pic']); ?>" alt="profile">
                <?php
                    }
                }
                ?>

                <h3 class="text-center">Profile</h3>
            </div>

            <div class="col-12 col-md-3 adr-box card-box" onclick="window.location = 'userAddressBook.php';">
                <img src="resource/home.png" alt="Order icon">
                <h3 class="text-center">Address Book</h3>
            </div>

            <div class="col-12 col-md-3 odr-box card-box" onclick="window.location = 'myOrder.php';">
                <img src="resource/order.png" alt="Order history icon">
                <h3 class="text-center">My Orders</h3>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="script.js"></script>
</body>
</html>