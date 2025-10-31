<?php
require "../config/config.php";
require "../../layouts/header.php";


if (!isset($_SESSION['admin_name'])) {
    header("Location: " . ADMINURL . "admins/login-admins.php");
    exit;


}

// to delete the product in the cart
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ✅ Use prepared statement for safety
    $delete = $conn->prepare("DELETE FROM orders WHERE id = :id");
    $delete->execute([':id' => $id]);

    if ($delete) {
        echo "<script>
            alert('Product deleted successfully!');
            window.location.href = 'show-orders.php';
        </script>";
        exit;
    } else {
        echo "<script>alert('Failed to delete product!');</script>";
    }
}
?>