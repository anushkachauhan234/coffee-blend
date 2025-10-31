<?php
require '../../config/config.php';
require '../layouts/header.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header("Location: " . ADMINURL . "admins/login-admins.php");
    exit;
}

$orders = $conn->prepare("SELECT * FROM orders");
$orders->execute();
$allOrders = $orders->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Orders</h5>

        <table class="table">
          <thead>
            <tr>
              <th>First Name</th>
              <!-- <th>Last Name</th> -->
              <th>Town</th>
              <th>State</th>
              <th>Zip Code</th>
              <th>Phone</th>
              <th>Street Address</th>
              <th>Total Price</th>
              <th>Status</th>
              <th>change</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($allOrders as $order): ?>
              <tr>
      
                <td><?= $order->first_name; ?></td>
                <!-- <td><?= $order->last_name; ?></td> -->
                <td><?= $order->town; ?></td>
                <td><?= $order->state; ?></td>
                <td><?= $order->zip_code; ?></td>
                <td><?= $order->phone; ?></td>
                <td><?= $order->street_address; ?></td>
                <td><?= $order->total_price; ?></td>
                <td><?= $order->status; ?></td>
                <td><?= $order->status; ?></td>
                <td>
                  <a href="change-status.php?id=<?= $order->id; ?>" 
                     class="btn btn-warning text-white text-center">update</a>
                </td>
                <td>
                  <a href="delete-orders.php?id=<?= $order->id; ?>" 
                     class="btn btn-danger text-center">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<?php require '../layouts/footer.php'; ?>