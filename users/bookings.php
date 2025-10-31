<?php 
require "../config/config.php";
require "../includes/header.php";

if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

// Fetch all bookings for the logged-in user
$bookings = $conn->prepare("SELECT * FROM bookings WHERE user_id = :user_id");
$bookings->execute([':user_id' => $_SESSION['user_id']]);
$allBookings = $bookings->fetchAll(PDO::FETCH_OBJ);
?>

<section class="home-slider owl-carousel">
  <div class="slider-item" style="background-image: url(<?php echo APPURL; ?>/images/bg_3.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text justify-content-center align-items-center">
        <div class="col-md-7 col-sm-12 text-center ftco-animate">
          <h1 class="mb-3 mt-5 bread">Bookings</h1>
          <p class="breadcrumbs">
            <span class="mr-2"><a href="<?php echo APPURL; ?>/index.php">Home</a></span> 
            <span>Bookings</span>
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
                <th>Product Name</th>
                <th>Description</th>
                <th>Date</th>
                <th>Time</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Status</th>
                <th>Write Review</th>
              </tr>
            </thead>
            <tbody>
              <?php if (count($allBookings) > 0): ?>
                <?php foreach ($allBookings as $booking): ?>
                  <tr class="text-center">
                    <td><?php echo htmlspecialchars($booking->first_name); ?></td>
                    <td><?php echo htmlspecialchars($booking->last_name); ?></td>
                    <td><?php echo htmlspecialchars($booking->product_name); ?></td>
                    <td><?php echo htmlspecialchars($booking->description); ?></td>
                    <td><?php echo htmlspecialchars($booking->date); ?></td>
                    <td><?php echo htmlspecialchars($booking->time); ?></td>
                    <td><?php echo htmlspecialchars($booking->phone); ?></td>
                    <td><?php echo htmlspecialchars($booking->message); ?></td>
                    <td>
                      <?php if ($booking->status == 'pending'): ?>
                        <span class="badge badge-warning">Pending</span>
                      <?php elseif ($booking->status == 'confirmed'): ?>
                        <span class="badge badge-success">Confirmed</span>
                      <?php elseif ($booking->status == 'done'): ?>
                        <span class="badge badge-primary">Done</span>
                      <?php else: ?>
                        <span class="badge badge-secondary">Unknown</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($booking->status == 'done'): ?>
                        <a href="<?php echo APPURL; ?>/reviews/write-review.php?booking_id=<?php echo $booking->id; ?>" 
                           class="btn btn-primary btn-sm">
                          Write Review
                        </a>
                      <?php else: ?>
                        <span class="text-muted">—</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="10" class="text-center">No bookings found</td>
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
