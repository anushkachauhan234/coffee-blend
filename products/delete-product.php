<?php
require "../config/config.php";
require "../includes/header.php";



// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); // Redirect to home page
    exit(); // Stop further execution
}






// to delete the product in the cart
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ✅ Use prepared statement for safety
    $delete = $conn->prepare("DELETE FROM cart WHERE id = :id");
    $delete->execute([':id' => $id]);

    if ($delete) {
        echo "<script>
            alert('Product deleted successfully!');
            window.location.href = 'cart.php';
        </script>";
        exit;
    } else {
        echo "<script>alert('Failed to delete product!');</script>";
    }
}
?>