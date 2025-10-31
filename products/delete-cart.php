<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require "../config/config.php";
require "../includes/header.php";

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Delete all cart items for this user
    $deleteAll = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
    $deleteAll->execute([':user_id' => $user_id]);

    // Redirect back to cart page
    header("Location: cart.php");
    exit();
} else {
    echo "<p style='color:red;'>User not logged in!</p>";
}
?>
