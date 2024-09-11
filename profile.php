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

    <div class="container mb-5">
        <div class="row">

            <div class="col-12 mt-5">
                <div class="d-flex justify-content-center profile-pic">

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
                        ?>

                </div>

                <!-- profile modal -->
                <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile Picture</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="d-none" id="msg">
                                    <p class="text-white fw-bold" id="err"></p>
                                </div>

                                <input type="file" class="form-select" id="pro_pic">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-outline-info" onclick="uploadUserProfile();">Upload</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- profile modal -->

                <div class="d-flex justify-content-center mt-3">
                    <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#profileModal">Edit</button>
                </div>
                <h1 class="text-center mt-3">Hello <?php echo ($user['fname'] . ' ' . $user['lname']); ?> !</h1>
            </div>

            <div class="col-12 col-md-8 offset-md-2 p-3 p-md-3 card bg-dark-subtle rounded-5">
                <div class="row">

                    <div class="col-12 col-lg-2 offset-md-3 mt-5 mb-3">
                        <label class="form-label">Email Address</label> </br>
                        <label class="form-label"><?php echo ($user['email']); ?></label>
                    </div>

                    <div class="col-12 col-lg-2 offset-md-3 mt-5 mb-3">
                        <label class="form-label">Mobile Number</label> </br>
                        <label class="form-label"><?php echo ($user['mobile']); ?></label>
                    </div>

                    <div class="col-12 col-lg-2 offset-md-3 mt-5 mb-3">
                        <label class="form-label">First name</label> <br>
                        <label class="form-label"><?php echo ($user['fname']); ?></label>
                    </div>

                    <div class="col-12 col-lg-2 offset-md-3 mt-5 mb-3">
                        <label class="form-label">Last names</label> <br>
                        <label class="form-label"><?php echo ($user['lname']); ?></label>
                    </div>

                    <div class="d-flex justify-content-center mt-3 mb-4">
                        <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#dataModal" data-bs-whatever="@mdo">Edit</button>
                    </div>

                    <!-- data modal -->
                    <div class="modal fade" id="dataModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="d-none" id="msg">
                                        <p class="text-white fw-bold" id="err"></p>
                                    </div>

                                    <form enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">First Name</label>
                                            <input type="text" class="form-control" id="fname" value="<?php echo ($user['fname']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lname" value="<?php echo ($user['lname']); ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Mobile</label>
                                            <input type="text" class="form-control" id="mobile" value="<?php echo ($user['mobile']); ?>">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-outline-info" onclick="editUserProfile();">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- data modal -->

                <?php
                    }
                ?>

                </div>
            </div>

        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>