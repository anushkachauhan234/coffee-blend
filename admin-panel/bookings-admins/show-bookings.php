<?php
session_start();
require '../../config/config.php';
require '../layouts/header.php';

// ✅ Redirect if admin not logged in
if (!isset($_SESSION['admin_name'])) {
    header("Location: " . ADMINURL . "admins/login-admins.php");
    exit;
}

// ✅ Fetch all bookings from the database
$bookings = $conn->prepare("SELECT * FROM bookings");
$bookings->execute();
$allBookings = $bookings->fetchAll(PDO::FETCH_OBJ);
?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-4 d-inline">Bookings</h5>

        <table class="table table-bordered table-striped">
          <thead class="table-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Phone</th>
              <th scope="col">Message</th>
              <th scope="col">Status</th>
              <th scope="col">Change Status</th>
              <th scope="col">Created At</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($allBookings as $booking): ?>
              <tr>
                <th scope="row"><?php echo $booking->id; ?></th>
                <td><?php echo htmlspecialchars($booking->first_name); ?></td>
                <td><?php echo htmlspecialchars($booking->last_name); ?></td>
                <td><?php echo htmlspecialchars($booking->date); ?></td>
                <td><?php echo htmlspecialchars($booking->time); ?></td>
                <td><?php echo htmlspecialchars($booking->phone); ?></td>
                <td><?php echo htmlspecialchars($booking->message); ?></td>
                <td><?php echo htmlspecialchars($booking->status); ?></td>
                <td>
                  <a href="change-status.php?id=<?php echo $booking->id; ?>" 
                     class="btn btn-warning btn-sm text-white"
                     onclick="return confirm('Are you sure you want to change the status?');">
                     Change Status
                  </a>
                </td>
                <td><?php echo htmlspecialchars($booking->created_at); ?></td>
                <td>
                  <a href="delete-bookings.php?id=<?php echo $booking->id; ?>" 
                     class="btn btn-danger btn-sm"
                     onclick="return confirm('Are you sure you want to delete this booking?');">
                     Delete
                  </a>
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
