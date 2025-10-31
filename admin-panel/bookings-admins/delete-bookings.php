<?php
session_start();
require '../../config/config.php';

// ✅ Check admin login
if (!isset($_SESSION['admin_name'])) {
    header("Location: " . ADMINURL . "admins/login-admins.php");
    exit;
}

// ✅ Delete booking safely
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $delete = $conn->prepare("DELETE FROM bookings WHERE id = :id");
    $delete->execute([':id' => $id]);

    if ($delete->rowCount() > 0) {
        echo "<script>
            alert('Booking deleted successfully!');
            window.location.href = 'show-bookings.php';
        </script>";
    } else {
        echo "<script>
            alert('Booking not found or already deleted.');
            window.location.href = 'show-bookings.php';
        </script>";
    }
} else {
    echo "<script>
        alert('Invalid booking ID!');
        window.location.href = 'show-bookings.php';
    </script>";
}
?>
