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
        <div class="row mb-5">

            <div class="col-12 mb-4">
                <h1 class="text-center mt-4">Address Book</h1>
            </div>

            <div class="mt-4">
                <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addressModal" data-bs-whatever="@mdo">Add Address +</button>

                <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Address</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="d-none" id="msg">
                                    <p class="text-white fw-bold" id="err"></p>
                                </div>

                                <form enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Line 1 *</label>
                                        <input type="text" class="form-control" id="line-1" placeholder="Ente addressr line 1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Line 2</label>
                                        <input type="text" class="form-control" id="line-2" placeholder="Ente addressr line 2">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Zip Code</label>
                                        <input type="text" class="form-control" id="zip-code" placeholder="Ente city zip code.">
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name"  class="col-form-label">City</label>
                                        <select id="city" class="form-select">
                                            <option value="0">Select a city</option>
                                            <?php

                                                include "connection.php";

                                                $city = Database::search("SELECT * FROM `city` ORDER BY `city` ASC");
                                                $num_city = $city->num_rows;
                                                for ($i=0; $i < $num_city; $i++) { 
                                                    $city_data = $city->fetch_assoc();
                                            ?>

                                                    <option value="<?php echo($city_data['id']); ?>">
                                                        <?php echo($city_data['city']); ?>
                                                    </option>

                                            <?php
                                                } 
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="recipient-name"  class="col-form-label">District</label>
                                        <select id="district" class="form-select">
                                            <option value="0">Select a district</option>
                                            <?php

                                                $district = Database::search("SELECT * FROM `district` ORDER BY `district` ASC ");
                                                $num_district = $district->num_rows;
                                                for ($i=0; $i < $num_district; $i++) { 
                                                    $district_data = $district->fetch_assoc();
                                            ?>

                                                    <option value="<?php echo($district_data['id']); ?>">
                                                        <?php echo($district_data['district']); ?>
                                                    </option>

                                            <?php
                                                } 
                                            ?>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-outline-info" onclick="addUserAddress();">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            $user = $_SESSION['u'];

            $address = Database::search("SELECT * FROM `address` WHERE `user_email` = '" . $user['email'] . "' ");

            $num = $address->num_rows;

            if ($num > 0) {
                for ($i = 0; $i < $num; $i++) {
                    $address_data = $address->fetch_assoc();

                    $district = Database::search("SELECT * FROM `district` WHERE `id` = '" . $address_data['district_id'] . "' ");
                    $district_data = $district->fetch_assoc();

                    $province = Database::search("SELECT * FROM `province` WHERE `id` = '" . $district_data['province_id'] . "' ");
                    $province_data = $province->fetch_assoc();
            ?>

                    <div class="col-10 offset-1 col-md-3 offset-md-1 bg-dark-subtle card mt-5 p-2">
                        <h3 class="card-header">Address <?php echo ($i + 1); ?></h3>
                        <p class="card-body">
                            Line 1 : <?php echo ($address_data['line_1']); ?>, <br>
                            Line 2 : <?php echo ($address_data['line_2']); ?>. <br>
                            Zip code : <?php echo ($address_data['zip_code']); ?> <br>
                            District : <?php echo ($district_data['district']); ?> <br>
                            Province : <?php echo ($province_data['province']); ?> <br>
                        </p>
                        <div class="card-footer">
                            <a href=<?php echo ("removeuserAddress.php?id=" . $address_data['id']); ?> class="float-end text-decoration-none btn btn-outline-danger" onclick="return confirm('Are you sure ?');">Remove</a>
                        </div>
                    </div>

                <?php
                }
            } else {
                ?>

                <div class="co-12 d-flex justify-content-center">
                    <div class="row align-items-center">
                        <img src="resource/out-of-stock.png" alt="empty address picture" style="width: 300px; margin-top: 50px; margin-bottom: 100px;">
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>