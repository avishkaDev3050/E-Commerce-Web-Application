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

    <link rel="stylesheet" href="../bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

    <div class="container">
        <div class="row">

            <div class="col-12">
            <h1 class="text-lg-center mt-5">Neo Mobiles Kandy (Pvt), Ltd</h1>
                <p class="text-center">No 04 Raja Weediya, Kandy</p>
                <p class="text-center">All Users</p>
                <p class="text-center mb-5">
                    <?php
                    $d = new DateTime();
                    echo $d->format('Y-M-d');
                    ?>
                </p>
                <div class="mt-5 col-12">

                    <table class="table table-hover">
                        <thead>
                            <tr class="border-black border-light fs-4 text-center">
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
                                            <td><a href="deactiveUser.php?em=<?php echo($user_data['email']); ?>" class="btn link-success">Active</a></td>
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

                    <div class="col-12" style="margin-top: 100px;">
                        <p class="text-center opacity-75" style="font-size: 18px;">&copy; 2024 Neo Mobile Kandy (Pvt), Ltd || All right recieved</p>
                    </div>

                </div>
            </div>

        </div>
    </div>

    
    <script>
        window.print();
    </script>
</body>
</html>