<?php 
require "../config/config.php";
require "../includes/header.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

// Fetch all orders for the logged-in user
$orders = $conn->prepare("SELECT * FROM orders WHERE user_id = :user_id");
$orders->execute([':user_id' => $_SESSION['user_id']]);
$allOrders = $orders->fetchAll(PDO::FETCH_OBJ);
?>

<section class="home-slider owl-carousel">
  <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center">
        <div class="col-md-7 col-sm-12 text-center ftco-animate">
          <h1 class="mb-3 mt-5 bread">Orders</h1>
          <p class="breadcrumbs">
            <span class="mr-2"><a href="<?php echo APPURL; ?>/index.php">Home</a></span> 
            <span>Orders</span>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section ftco-cart">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <div class="cart-list">
          <table class="table">
            <thead class="thead-primary">
              <tr class="text-center">
                <th>First Name</th>
                <th>Last Name</th>
                <th>Street Address</th>
                <th>State</th>
                <th>Town</th>
                <th>Zip Code</th>
                <th>Phone</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Write Review</th>
              </tr>
            </thead>
            <tbody>
              <?php if (count($allOrders) > 0): ?>
                <?php foreach ($allOrders as $order): ?>
                  <tr class="text-center">
                    <td><?php echo htmlspecialchars($order->first_name); ?></td>
                    <td><?php echo htmlspecialchars($order->last_name); ?></td>
                    <td><?php echo htmlspecialchars($order->street_address); ?></td>
                    <td><?php echo htmlspecialchars($order->state); ?></td>
                    <td><?php echo htmlspecialchars($order->town); ?></td>
                    <td><?php echo htmlspecialchars($order->zip_code); ?></td>
                    <td><?php echo htmlspecialchars($order->phone); ?></td>
                    <td>₹<?php echo htmlspecialchars($order->total_price); ?></td>
                    <td>
                      <?php if ($order->status == 'pending'): ?>
                        <span class="badge badge-warning">Pending</span>
                      <?php elseif ($order->status == 'confirmed'): ?>
                        <span class="badge badge-info">Confirmed</span>
                      <?php elseif ($order->status == 'delivered'): ?>
                        <span class="badge badge-success">Delivered</span>
                      <?php else: ?>
                        <span class="badge badge-secondary"><?php echo htmlspecialchars($order->status); ?></span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($order->status == 'delivered'): ?>
                        <a href="<?php echo APPURL; ?>/reviews/write-review.php?order_id=<?php echo $order->id; ?>" class="btn btn-primary btn-sm">
                          Write Review
                        </a>
                      <?php else: ?>
                        <span class="text-muted">N/A</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="10" class="text-center">No orders found</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?php 
require "../includes/footer.php";
?>
