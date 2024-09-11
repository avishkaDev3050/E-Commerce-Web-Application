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
    <div class="container-fluid">
        <div class="row">
            <!-- Header -->
        <header class="header col-12">
            <div class="menu-icon" onclick="openSidebar()">
            <span class="material-icons-outlined">menu</span>
            </div>
            <div class="header-right">
            <span class="material-icons-outlined">notifications</span>
            <span class="material-icons-outlined">email</span>
            <span class="material-icons-outlined">account_circle</span>
            </div>
        </header>
      <!-- End Header -->

      <!-- Sidebar -->
      <aside id="sidebar" class="bg-black col-12 col-md-6 col-lg-3">
        <div class="sidebar-title">
          <div class="sidebar-brand">
            <span class="material-icons-outlined">inventory</span> Neo's Inventory
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <a href="adminDashBoard.php" class="link-light text-decoration-none opacity-50">
            <li class="sidebar-list-item">
              <span class="material-icons-outlined">dashboard</span> Dashboard
            </li>
          </a>
          <a href="productList.php" class="link-light text-decoration-none opacity-50">
            <li class="sidebar-list-item">
              <span class="material-icons-outlined">inventory_2</span>Maage Products
            </li>
          </a>
          <a href="manageOrder.php" class="link-light text-decoration-none opacity-50">
            <li class="sidebar-list-item">
              <span class="material-icons-outlined">add_shopping_cart</span>Maage Orders
            </li>
          </a>
          <a href="searchInvoice.php" class="link-light text-decoration-none opacity-50">
            <li class="sidebar-list-item">
              <span class="material-icons-outlined">fact_check</span> Invoice History
            </li>
          </a>
          <a href="usersList.php" class="link-light text-decoration-none opacity-50">
            <li class="sidebar-list-item">
              <span class="material-icons-outlined">account_circle</span> Manage Users
            </li>
          </a>
          <a href="refunding.php" class="link-light text-decoration-none opacity-50">
            <li class="sidebar-list-item">
              <span class="material-icons-outlined">poll</span> Refunds
            </li>
          </a>
          <a href="promoList.php" class="link-light text-decoration-none opacity-50">
           <li class="sidebar-list-item">
              <span class="material-icons-outlined">poll</span> Manage Promo Code
            </li>
          </a>
          <a href="outOfStock.php" class="link-light text-decoration-none opacity-50">
           <li class="sidebar-list-item">
              <span class="material-icons-outlined">poll</span> Out Of Stock
            </li>
          </a>
          <a href="adminSignOut.php" class="link-light text-decoration-none opacity-50">
            <li class="sidebar-list-item">
              <span class="material-icons-outlined">poll</span> Sign Out
            </ul>
          </a>
        </li>
      </aside>
      <!-- End Sidebar -->

        </div>
    </div>
    <!-- header end -->


    <script src="bootstrap.bundle.js"></script>
</body>
</html>