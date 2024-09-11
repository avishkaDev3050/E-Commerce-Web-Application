<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Neo Mobile || Sign Up</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="bootstrap.css" />
</head>

<body>
  <!-- header -->
  <?php include "header.php"; ?>
  <!-- header -->

  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-4 offset-md-4 card bg-dark-subtle rounded-4 p-4" style="margin-top: 150px;">
        <div class="mb-3">
          <h1 class="font-weight-bold">Sign Up</h1>
        </div>

        <div class="d-none" id="msg">
          <p class="text-white fw-bold" id="err"></p>
        </div>

        <div class="mb-2">
          <label class="col-form-label font-weight-bold">Email Address</label>
          <input class="form-control fw-bold" type="email" id="e" placeholder="Enter your email." />
        </div>

        <div class="mb-2">
          <label class="col-form-label fw-bold">First Name</label>
          <input class="form-control font-weight-bold" type="text" id="f" placeholder="Enter your first name." />
        </div>

        <div class="mb-2">
          <label class="col-form-label fw-bold">Last Name</label>
          <input class="form-control font-weight-bold" type="email" id="l" placeholder="Enter last name." />
        </div>

        <div class="mb-2">
          <label class="col-form-label fw-bold">Mobile Number</label>
          <input class="form-control font-weight-bold" type="number" id="m" placeholder="Enter mobile number." />
        </div>

        <div class="mb-3">
          <label class="col-form-label fw-bold">Password</label>
          <input class="form-control font-weight-bold" type="Password" id="p" placeholder="Enter your passwordc." />
        </div>

        <div class="mb-3">
          <button class="btn btn-secondary col-12" type="submit" onclick="signUp();">
            Sign Up
          </button>
          <p class="fw-bold text-center mt-3">
            <a href="signIn.php" class="text-decoration-none link-light opacity-50">I have an account.</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php require 'footer.php'; ?>
  <!-- footer -->

  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>