<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zeus | Login</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
</head>
<body>

    <!-- header -->
    <?php include "header.php"; ?>
    <!-- header -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 offset-md-4" style="margin-top: 150px;">
                
                <div class="mb-3">
                    <h1 class="font-weight-bold">Admin Sign In</h1>
                </div>

                <div class="d-none" id="msg">
                    <p class="text-white fw-bold" id="err"></p>
                </div>
                
                <div class="mb-3" id="em-box">
                    <label class="col-form-label font-weight-bold">Username</label>
                    <input id="adminEmail" class="form-control font-weight-bold" type="email" id="uname" placeholder="example@gmail.com">
                </div>

                <div class="mb-3 d-none" id="pwd-box">
                    <label class="col-form-label font-weight-bold">Password</label>
                    <input id="password" class="form-control font-weight-bold" type="password" placeholder="examPl#$123.">
                </div>

                <div class="mb-5 mt-4">
                    <button id="signInBtn" class="btn-signIn col-12 font-weight-bold" type="submit" onclick="adminSignIn();">Sign In</button>
                    <button id="passwordCheckBtn" class="btn-signIn d-none col-12 font-weight-bold" type="submit" onclick="passwordChecker();">Sign In</button>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require 'footer.php'; ?>
    <!-- footer -->

    <script src="script.js"></script>
</body>
</html>