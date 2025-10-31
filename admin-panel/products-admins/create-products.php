<?php
require "../../config/config.php";
require "../layouts/header.php";

if (!isset($_SESSION['admin_name'])) {
    header("Location: " . ADMINURL . "/admins/login-admins.php");
    exit;
}

if (isset($_POST['submit'])) {
    // Validate empty fields
    if (empty($_POST['name']) || empty($_POST['price']) || empty($_POST['description']) || empty($_POST['type'])) {
        echo "<script>alert('One or more fields are empty');</script>";
    } else {
        $name = trim($_POST['name']);
        $price = trim($_POST['price']);
        $description = trim($_POST['description']);
        $type = trim($_POST['type']);
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        $dir = "../../images/" . basename($image);

        try {
            // Insert product into DB
            $stmt = $conn->prepare("INSERT INTO products (name, price, description, type, image)
                                    VALUES (:name, :price, :description, :type, :image)");

            $stmt->execute([
                ':name' => $name,
                ':price' => $price,
                ':description' => $description,
                ':type' => $type,
                ':image' => $image
            ]);

            // Move uploaded image to images folder
            if (move_uploaded_file($image_tmp, $dir)) {
                echo "<script>alert('Product added successfully!');</script>";
                header("Location: products.php");
                exit;
            } else {
                echo "<script>alert('Failed to upload image');</script>";
            }

        } catch (PDOException $e) {
            echo "<script>alert('Database Error: " . $e->getMessage() . "');</script>";
        }
    }
}
?>


<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Create Product</h5>

        <form method="POST" action="create-products.php" enctype="multipart/form-data">
          <div class="form-outline mb-4 mt-4">
            <input type="text" name="name" class="form-control" placeholder="Product Name" />
          </div>

          <div class="form-outline mb-4 mt-4">
            <input type="text" name="price" class="form-control" placeholder="Price" />
          </div>

          <div class="form-outline mb-4 mt-4">
            <input type="file" name="image" class="form-control" />
          </div>

          <div class="form-group mb-4">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

          <div class="form-outline mb-4 mt-4">
            <select name="type" class="form-select form-control">
              <option selected disabled>Choose Type</option>
              <option value="drink">Drink</option>
              <option value="dessert">Dessert</option>
            </select>
          </div>

          <button type="submit" name="submit" class="btn btn-primary mb-4 text-center">Create</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require "../layouts/footer.php"; ?>
