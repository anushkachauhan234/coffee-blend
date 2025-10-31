<?php
require "../../config/config.php";
require "../layouts/header.php";

if (!isset($_SESSION['admin_name'])) {
    header("Location: " . ADMINURL . "/admins/login-admins.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ✅ Select the product to get the image filename
    $select = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $select->execute([':id' => $id]);
    $product = $select->fetch(PDO::FETCH_OBJ);

    if ($product) {
        // ✅ Delete image file from folder if it exists
        $imagePath = "../../images/" . $product->image;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // ✅ Delete product from database
        $delete = $conn->prepare("DELETE FROM products WHERE id = :id");
        $delete->execute([':id' => $id]);

        echo "<script>
                alert('Product deleted successfully!');
                window.location.href = 'show-products.php';
              </script>";
        exit;
    } else {
        echo "<script>alert('Product not found!');</script>";
    }
}
?>
