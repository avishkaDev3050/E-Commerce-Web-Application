<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neo Mobile Home</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>

        <!-- header -->
        <div class="container">
          <!-- header top -->
          <div class="row">
            <div class="col-6 col-lg-4 p-2">
                <h5 class="fw-bold text-center opacity-50">Free Shopping</h5>
            </div>
            <div class="col-6 col-lg-4 p-2">
                <h5 class="fw-bold text-center opacity-50">Fast Delivery</h5>
            </div>
            <div class="col-12 col-md-12 col-lg-4 p-2">
                <h5 class="fw-bold text-center opacity-50"><a class="text-decoration-none link-light" href="mailto:neowaveinovations@gmail.com">neowaveinovations@gmail.com</a></h5>
            </div>
          </div>
        </div>
        <!-- header top -->

        
    
    <div class="container-fluid">
      <div class="row">
        <!-- header bottom -->
        <nav class="navbar mt-3 p-3 bg-secondary">
            <div class="container-fluid">
              <a class="navbar-brand fw-bold text-white text-uppercase" href="#">neo mobile</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <img src="resource/menu.png" alt="">
              </button>
              <div class="offcanvas offcanvas-end bg-secondary" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title fw-bold text-white text-uppercase" id="offcanvasNavbarLabel">neo mobile</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body bg-secondary">
                  <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <?php

                      session_start();
                      if (isset($_SESSION['u'])) {
                    ?>
                        <li class="nav-item">
                          <a class="nav-link fw-bold text-white active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link fw-bold text-white active" aria-current="page" href="userAccount.php">My Account</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link fw-bold text-white active" aria-current="page" href="cart.php">Cart</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link fw-bold text-white active" aria-current="page" href="wishList.php">Wish Listt</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link fw-bold text-white active" aria-current="page" href="signOut.php">Sign Out</a>
                        </li>
                    <?php
                      } else {
                    ?>
                        <li class="nav-item">
                          <a class="nav-link fw-bold text-white active" aria-current="page" href="index.php">Home</a>
                        </li> 
                        <li class="nav-item">
                          <a class="nav-link fw-bold text-white active" aria-current="page" href="signIn.php">Sign In / Sign Up</a>
                        </li>
                        <?php
                      }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
          </nav>
        <!-- header bottom -->
      </div>
    </div>

    <!-- header end -->


    <script src="bootstrap.bundle.js"></script>
</body>
</html>