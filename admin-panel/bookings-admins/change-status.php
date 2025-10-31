<?php
session_start();
require '../../config/config.php';
require '../layouts/header.php';

// ✅ Redirect if not logged in
if (!isset($_SESSION['admin_name'])) {
    header("Location: " . ADMINURL . "admins/login-admins.php");
    exit;
}

// ✅ Check if ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
        if (empty($_POST['status'])) {
            echo "<script>alert('Please select a status');</script>";
        } else {
            $status = $_POST['status'];

            try {
                // ✅ Use parameterized query for security
                $update = $conn->prepare("UPDATE bookings SET status = :status WHERE id = :id");
                $update->execute([
                    ':status' => $status,
                    ':id' => $id
                ]);

                echo "<script>
                        alert('Status updated successfully!');
                        window.location.href = 'show-bookings.php';
                      </script>";
                exit;
            } catch (PDOException $e) {
                echo "<script>alert('Database Error: " . $e->getMessage() . "');</script>";
            }
        }
    }
} else {
    echo "<script>
            alert('Invalid Request — No Booking ID Found!');
            window.location.href = 'show-bookings.php';
          </script>";
    exit;
}
?>

<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Update Booking Status</h5>

        <!-- ✅ Fixed action attribute syntax -->
        <form method="POST" action="change-status.php?id=<?php echo $id; ?>">
          
          <div class="form-outline mb-4 mt-4">
            <select name="status" class="form-select form-control" aria-label="Select booking status" required>
              <option value="" selected disabled>Choose Status</option>
              <option value="Pending">Pending</option>
              <option value="Delivered">Delivered</option>
            </select>
          </div>

          <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Update</button>
        </form>

      </div>
    </div>
  </div>
</div>

<?php require '../layouts/footer.php'; ?>
