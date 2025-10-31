<?php
session_start();
require '../config/config.php';
require 'layouts/header.php';

// ✅ Redirect if admin not logged in
if (!isset($_SESSION['admin_name'])) {
    header("Location: " . ADMINURL . "/admins/login-admins.php");
    exit;
}

// ✅ Count Products
$productsStmt = $conn->prepare("SELECT COUNT(*) AS total_products FROM products");
$productsStmt->execute();
$productsCount = $productsStmt->fetch(PDO::FETCH_OBJ)->total_products;

// ✅ Count Orders
$ordersStmt = $conn->prepare("SELECT COUNT(*) AS total_orders FROM orders");
$ordersStmt->execute();
$ordersCount = $ordersStmt->fetch(PDO::FETCH_OBJ)->total_orders;

// ✅ Count Bookings
$bookingsStmt = $conn->prepare("SELECT COUNT(*) AS total_bookings FROM bookings");
$bookingsStmt->execute();
$bookingsCount = $bookingsStmt->fetch(PDO::FETCH_OBJ)->total_bookings;

// ✅ Count Admins
$adminsStmt = $conn->prepare("SELECT COUNT(*) AS total_admins FROM admins");
$adminsStmt->execute();
$adminsCount = $adminsStmt->fetch(PDO::FETCH_OBJ)->total_admins;
?>

<div class="container mt-5">
  <div class="row">

    <!-- Products -->
    <div class="col-md-3">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">Products</h5>
          <p class="card-text">Number of products: <?php echo $productsCount; ?></p>
        </div>
      </div>
    </div>

    <!-- Orders -->
    <div class="col-md-3">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">Orders</h5>
          <p class="card-text">Number of orders: <?php echo $ordersCount; ?></p>
        </div>
      </div>
    </div>

    <!-- Bookings -->
    <div class="col-md-3">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">Bookings</h5>
          <p class="card-text">Number of bookings: <?php echo $bookingsCount; ?></p>
        </div>
      </div>
    </div>

    <!-- Admins -->
    <div class="col-md-3">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h5 class="card-title">Admins</h5>
          <p class="card-text">Number of admins: <?php echo $adminsCount; ?></p>
        </div>
      </div>
    </div>

  </div>
</div>

<?php require 'layouts/footer.php'; ?>
